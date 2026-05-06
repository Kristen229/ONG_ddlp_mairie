<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use App\Enums\EvaluationStatus;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('user')->orderBy('created_at', 'desc')->paginate(15);
        return view('admin.activities.index', compact('activities'));
    }

    public function createAdmin()
    {
        $users = User::all();
        return view('admin.activities.create', compact('users'));
    }

    public function storeAdmin(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lieu' => 'required|string',
            'date' => 'required|date',
            'attachment' => 'required|file',
        ]);

        $path = $request->file('attachment')->store('activities', 'public');

        Activity::create([
            'user_id' => $validated['user_id'],
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'lieu' => $validated['lieu'],
            'date' => $validated['date'],
            'attachment' => $path,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Activité créée.');
    }

    public function validatActivity(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);

        $beneficiaryScore = 0;
        if ($activity->beneficiaries_expected > 0 && $activity->beneficiaries_actual > 0) {
            $ratio = $activity->beneficiaries_actual / $activity->beneficiaries_expected;
            $beneficiaryScore = min($ratio, 1) * 40;
        }

        $budgetScore = 0;
        if ($activity->budget_expected > 0 && $activity->budget_actual > 0) {
            $ratio = $activity->budget_actual / $activity->budget_expected;
            $budgetScore = ($ratio <= 1) ? 30 : max(0, 30 - (($ratio - 1) * 30));
        }

        $delayScore = 0;
        if ($activity->date && $activity->actual_date) {
            $diff = $activity->date->diffInDays($activity->actual_date, false);
            $delayScore = ($diff <= 0) ? 30 : max(0, 30 - ($diff * 2));
        }

        $totalScore = $beneficiaryScore + $budgetScore + $delayScore;

        $status = match (true) {
            $totalScore >= 70 => EvaluationStatus::COMPLIANT,
            $totalScore >= 40 => EvaluationStatus::WARNING,
            default => EvaluationStatus::NON_COMPLIANT,
        };

        $activity->update([
            'score' => $totalScore,
            'evaluation_status' => $status,
            'evaluation_comment' => $request->evaluation_comment,
            'is_visible' => true,
        ]);

        return redirect()->route('admin.dashboard')->with('success', "Activité évaluée : {$totalScore}/100");
    }

    public function destroy(Request $request, $id)
    {
        $activity = Activity::with('user')->findOrFail($id);
        $user = $activity->user;

        $motif = $request->input('motif', 'Non respect des règles de la plateforme.');

        if ($user) {
            // Créer la notification
            Notification::create([
                'user_id' => $user->id,
                'title' => "Suppression d'activité",
                'message' => "Votre activité '{$activity->titre}' a été supprimée. Motif : {$motif}",
                'recipient_name' => $user->name,
                'recipient_email' => $user->email,
            ]);

            // Envoyer l'email
            if ($user->email) {
                Mail::raw("Bonjour {$user->name},\n\nNous vous informons que votre activité intitulée '{$activity->titre}' a été supprimée de la plateforme.\n\nMotif de la suppression : {$motif}\n\nCordialement,\nLa Mairie", function ($msg) use ($user) {
                    $msg->to($user->email)->subject("Suppression de votre activité");
                });
            }
        }

        $activity->delete();
        return back()->with('success', "Activité retirée avec justification envoyée à l'ONG.");
    }

    public function publish($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update(['is_visible' => true]);

        return back()->with('success', "L'activité a été approuvée et publiée avec succès.");
    }

    public function sendWarning(Request $request, $id)
    {
        $activity = Activity::with('user')->findOrFail($id);
        $user = $activity->user;

        $motif = $request->input('motif', 'Veuillez revoir les informations de cette activité.');

        if ($user) {
            // Créer la notification
            Notification::create([
                'user_id' => $user->id,
                'title' => "Avertissement concernant une activité",
                'message' => "Un avertissement a été émis pour votre activité '{$activity->titre}'. Motif : {$motif}",
                'recipient_name' => $user->name,
                'recipient_email' => $user->email,
            ]);

            // Envoyer l'email
            if ($user->email) {
                Mail::raw("Bonjour {$user->name},\n\nNous vous adressons un avertissement concernant votre activité intitulée '{$activity->titre}'.\n\nMotif de l'avertissement : {$motif}\n\nMerci de faire le nécessaire.\n\nCordialement,\nLa Mairie", function ($msg) use ($user) {
                    $msg->to($user->email)->subject("Avertissement - Activité");
                });
            }
        }

        return back()->with('success', "Avertissement justifié envoyé à l'ONG.");
    }
}
