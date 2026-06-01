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
        $activity = Activity::with('user')->findOrFail($id);

        $activity->update([
            'is_visible' => true,
        ]);

        $user = $activity->user;
        if ($user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => "Activité validée",
                'message' => "Votre activité '{$activity->titre}' a été validée et est désormais publique.",
                'recipient_name' => $user->name,
                'recipient_email' => $user->email,
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', "Activité validée avec succès.");
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
        }

        $activity->delete();
        return back()->with('success', "Activité retirée avec justification envoyée à l'ONG.");
    }

    public function publish($id)
    {
        $activity = Activity::with('user')->findOrFail($id);
        $activity->update(['is_visible' => true]);

        $user = $activity->user;
        if ($user) {
            Notification::create([
                'user_id' => $user->id,
                'title' => "Activité publiée",
                'message' => "Félicitations, votre activité '{$activity->titre}' a été validée et est désormais visible par le public.",
                'recipient_name' => $user->name,
                'recipient_email' => $user->email,
            ]);
        }

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
        }

        return back()->with('success', "Avertissement justifié envoyé à l'ONG.");
    }
}
