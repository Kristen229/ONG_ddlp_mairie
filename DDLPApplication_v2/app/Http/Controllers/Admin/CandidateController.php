<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CandidateController extends Controller
{
    public function index()
    {
        $pendingUsers = User::where('is_approved', false)->with('domaines')->orderBy('created_at', 'desc')->get();
        return view('admin.candidates.index', compact('pendingUsers'));
    }

    public function show($id)
    {
        $candidate = User::where('is_approved', false)
            ->with(['domaines', 'boardMembers'])
            ->findOrFail($id);

        return view('admin.candidates.show', compact('candidate'));
    }

    public function approve($id)
    {
        $user = User::where('is_approved', false)->findOrFail($id);

        // Générer un mot de passe aléatoire
        $plainPassword = Str::random(10);

        $user->update([
            'is_approved' => true,
            'must_change_password' => true,
            'password' => Hash::make($plainPassword),
        ]);

        // Créer une notification interne pour l'ONG
        Notification::create([
            'user_id' => $user->id,
            'title' => 'Inscription validée',
            'message' => "Bienvenue ! Votre inscription a été approuvée par la Mairie. Vous pouvez désormais vous connecter avec le mot de passe temporaire reçu par email. N'oubliez pas de le changer lors de votre première connexion.",
            'recipient_name' => $user->name,
            'recipient_email' => $user->email,
        ]);

        // Envoyer l'email avec le mot de passe
        if ($user->email) {
            $loginUrl = route('connexion');
            Mail::raw(
                "Bonjour {$user->name},\n\n" .
                "Nous avons le plaisir de vous informer que votre inscription sur la plateforme de la Mairie a été validée.\n\n" .
                "Voici vos identifiants de connexion :\n" .
                "Email : {$user->email}\n" .
                "Mot de passe temporaire : {$plainPassword}\n\n" .
                "Connectez-vous ici : {$loginUrl}\n\n" .
                "Important : Vous devrez changer votre mot de passe lors de votre première connexion.\n\n" .
                "Cordialement,\nLa Mairie",
                function ($msg) use ($user) {
                    $msg->to($user->email)->subject("Inscription validée - Bienvenue sur la plateforme");
                }
            );
        }

        AuditLog::record('candidate.approve', "Candidature approuvée: {$user->name}", ['user_id' => $user->id]);

        return redirect()->route('admin.dashboard')->with('success', "L'inscription de {$user->name} a été approuvée. Un email avec le mot de passe a été envoyé.");
    }

    public function reject(Request $request, $id)
    {
        $user = User::where('is_approved', false)->findOrFail($id);
        $motif = $request->input('motif', 'Votre candidature ne correspond pas aux critères requis.');

        // Envoyer l'email de rejet avant suppression
        if ($user->email) {
            Mail::raw(
                "Bonjour {$user->name},\n\n" .
                "Nous avons le regret de vous informer que votre demande d'inscription sur la plateforme de la Mairie n'a pas été validée.\n\n" .
                "Motif du rejet : {$motif}\n\n" .
                "Vous pouvez nous contacter pour plus d'informations.\n\n" .
                "Cordialement,\nLa Mairie",
                function ($msg) use ($user) {
                    $msg->to($user->email)->subject("Inscription refusée");
                }
            );
        }

        $userName = $user->name;
        AuditLog::record('candidate.reject', "Candidature rejetée: {$userName}", ['user_id' => $user->id, 'motif' => $motif]);
        $user->delete();

        return redirect()->route('admin.dashboard')->with('success', "La candidature de {$userName} a été rejetée et le compte supprimé. Un email a été envoyé.");
    }
}
