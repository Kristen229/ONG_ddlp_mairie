<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AuditLog;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;

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

        $activity = Activity::create([
            'user_id' => $validated['user_id'],
            'titre' => $validated['titre'],
            'description' => $validated['description'],
            'lieu' => $validated['lieu'],
            'date' => $validated['date'],
            'attachment' => $path,
            'status' => Activity::STATUS_PENDING,
            'is_visible' => false,
        ]);

        AuditLog::record('activity.create_admin', "Activité créée par admin: {$activity->titre}", ['activity_id' => $activity->id, 'user_id' => $activity->user_id]);

        return redirect()->route('admin.dashboard')->with('success', 'Activité créée.');
    }

    public function validatActivity(Request $request, $id)
    {
        $activity = Activity::with('user')->findOrFail($id);

        $activity->update([
            'is_visible' => true,
            'status' => Activity::STATUS_PUBLISHED,
            'last_admin_feedback' => null,
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

        AuditLog::record('activity.validate', "Activité validée: {$activity->titre}", ['activity_id' => $activity->id, 'user_id' => $user?->id]);

        return redirect()->route('admin.dashboard')->with('success', "Activité validée avec succès.");
    }

    public function destroy(Request $request, $id)
    {
        $activity = Activity::with('user')->findOrFail($id);
        $user = $activity->user;

        $request->validate([
            'motif' => ['required', 'string', 'max:5000'],
        ]);

        if ($activity->correction_count >= 3) {
            return back()->withErrors(['motif' => "Cette activité a déjà atteint la limite de 3 rejets ou corrections."]);
        }

        $motif = $request->input('motif');

        $activity->update([
            'is_visible' => false,
            'status' => Activity::STATUS_REJECTED,
            'correction_count' => $activity->correction_count + 1,
            'last_admin_feedback' => $motif,
        ]);

        if ($user) {
            // Créer la notification
            Notification::create([
                'user_id' => $user->id,
                'title' => "Activité rejetée",
                'message' => "Votre activité '{$activity->titre}' a été rejetée. Motif : {$motif}",
                'recipient_name' => $user->name,
                'recipient_email' => $user->email,
            ]);
        }

        AuditLog::record('activity.reject', "Activité rejetée: {$activity->titre}", ['activity_id' => $activity->id, 'user_id' => $user?->id, 'motif' => $motif]);

        return back()->with('success', "Activité rejetée avec justification envoyée à l'ONG.");
    }

    public function publish($id)
    {
        $activity = Activity::with('user')->findOrFail($id);
        $activity->update([
            'is_visible' => true,
            'status' => Activity::STATUS_PUBLISHED,
            'last_admin_feedback' => null,
        ]);

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

        AuditLog::record('activity.publish', "Activité publiée: {$activity->titre}", ['activity_id' => $activity->id, 'user_id' => $user?->id]);

        return back()->with('success', "L'activité a été approuvée et publiée avec succès.");
    }

    public function sendWarning(Request $request, $id)
    {
        $activity = Activity::with('user')->findOrFail($id);
        $user = $activity->user;

        $request->validate([
            'motif' => ['required', 'string', 'max:5000'],
        ]);

        if ($activity->correction_count >= 3) {
            return back()->withErrors(['motif' => "Cette activité a déjà atteint la limite de 3 rejets ou corrections."]);
        }

        $motif = $request->input('motif');

        $activity->update([
            'is_visible' => false,
            'status' => Activity::STATUS_CORRECTION_REQUESTED,
            'correction_count' => $activity->correction_count + 1,
            'last_admin_feedback' => $motif,
        ]);

        if ($user) {
            // Créer la notification
            Notification::create([
                'user_id' => $user->id,
                'title' => "Correction demandée pour une activité",
                'message' => "La mairie demande une correction pour votre activité '{$activity->titre}'. Motif : {$motif}. Modifiez l'activité puis renvoyez-la pour validation.",
                'recipient_name' => $user->name,
                'recipient_email' => $user->email,
            ]);
        }

        AuditLog::record('activity.correction_requested', "Correction demandée: {$activity->titre}", ['activity_id' => $activity->id, 'user_id' => $user?->id, 'motif' => $motif]);

        return back()->with('success', "Demande de correction envoyée à l'ONG.");
    }
}
