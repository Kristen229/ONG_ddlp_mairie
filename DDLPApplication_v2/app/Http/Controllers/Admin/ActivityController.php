<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\User;
use App\Enums\EvaluationStatus;
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

    public function destroy($id)
    {
        Activity::findOrFail($id)->delete();
        return back()->with('success', "Activité retirée de l'interface.");
    }

    public function publish($id)
    {
        $activity = Activity::findOrFail($id);
        $activity->update(['is_visible' => true]);

        return back()->with('success', "L'activité a été approuvée et publiée avec succès.");
    }

    public function sendWarning($id)
    {
        $activity = Activity::with('user')->findOrFail($id);
        $user = $activity->user;

        if ($user && $user->email) {
            Mail::raw("Avertissement concernant votre activité : {$activity->titre}", function ($msg) use ($user) {
                $msg->to($user->email)->subject('Avertissement - Activité');
            });
        }

        return redirect()->route('admin.dashboard')->with('success', 'Avertissement envoyé.');
    }
}
