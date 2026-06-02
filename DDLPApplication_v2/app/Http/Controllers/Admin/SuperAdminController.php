<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class SuperAdminController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        return view('admin.super-admin.index', compact('admins'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'is_super_admin' => 'boolean',
        ]);

        $plainPassword = Str::random(10);
        $admin = Admin::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'password' => Hash::make($plainPassword),
            'is_super_admin' => $request->boolean('is_super_admin', false),
            'must_change_password' => true,
        ]);

        $loginUrl = route('conAdmin');
        Mail::raw(
            "Bonjour {$admin->prenom} {$admin->nom},\n\n" .
            "Un compte administrateur a été créé pour vous sur la plateforme de la Mairie.\n\n" .
            "Voici vos identifiants de connexion :\n" .
            "Email : {$admin->email}\n" .
            "Mot de passe temporaire : {$plainPassword}\n\n" .
            "Connectez-vous ici : {$loginUrl}\n\n" .
            "Important : Vous devrez changer votre mot de passe lors de votre première connexion.\n\n" .
            "Cordialement,\nLa Mairie",
            function ($msg) use ($admin) {
                $msg->to($admin->email)->subject("Vos accès Administrateur - Mairie");
            }
        );

        AuditLog::record('admin.create', "Administrateur créé: {$admin->email}", ['admin_id' => $admin->id]);

        return redirect()->route('admin.superadmin.index')->with('success', 'Administrateur créé avec succès. Un email avec le mot de passe a été envoyé.');
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $rules = [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'is_super_admin' => 'boolean',
        ];

        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
        }

        $request->validate($rules);

        $isSuperAdmin = $admin->id === auth('admin')->id()
            ? $admin->is_super_admin
            : $request->boolean('is_super_admin', false);

        if ($admin->is_super_admin && !$isSuperAdmin && Admin::where('is_super_admin', true)->count() <= 1) {
            return back()->withErrors('Impossible de retirer le rôle du dernier super admin.');
        }

        $data = [
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'email' => $request->email,
            'is_super_admin' => $isSuperAdmin,
        ];

        // Generate a random password ONLY if explicitly requested (e.g. by a reset password button)
        // Wait, the user said "si le superadmi modifie le mot de passe d'un admin, ce dernier doit recevoir une notification ou un mail".
        // The old code had a password field. Let's keep the ability to manually set a password or just let the system generate one?
        // Let's modify the UI so that there's a "Réinitialiser le mot de passe" button or checkbox instead of a text input.
        // Actually, the old update had a `password` text field "laisser vide pour ne pas modifier".
        // If it's filled, we use that password, but we email it to them? No, if it's filled, they type it. But they can't type a secure password for someone else easily.
        // Usually, the best is "Generate a new password and email it".
        // Let's assume if the password field is filled, we use it, BUT we email them saying "Your password was changed to: X". Or we just change it to a random one.
        // Let's stick to the existing form: if password is provided, we use it, send email, and force change.
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
            $data['must_change_password'] = true;

            $loginUrl = route('conAdmin');
            Mail::raw(
                "Bonjour {$admin->prenom} {$admin->nom},\n\n" .
                "Votre mot de passe administrateur a été modifié par un Super Administrateur.\n\n" .
                "Voici vos nouveaux identifiants :\n" .
                "Email : {$admin->email}\n" .
                "Nouveau mot de passe : {$request->password}\n\n" .
                "Connectez-vous ici : {$loginUrl}\n\n" .
                "Important : Vous devrez changer votre mot de passe lors de votre prochaine connexion.\n\n" .
                "Cordialement,\nLa Mairie",
                function ($msg) use ($admin) {
                    $msg->to($admin->email)->subject("Modification de votre mot de passe Administrateur");
                }
            );
        }

        $admin->update($data);

        AuditLog::record('admin.update', "Administrateur modifié: {$admin->email}", ['admin_id' => $admin->id]);

        $msg = 'Administrateur mis à jour.';
        if ($request->filled('password')) {
            $msg .= ' Un email avec le nouveau mot de passe a été envoyé.';
        }

        return redirect()->route('admin.superadmin.index')->with('success', $msg);
    }

    public function destroy($id)
    {
        $admin = Admin::findOrFail($id);
        
        if ($admin->id === auth('admin')->id()) {
            return redirect()->back()->withErrors('Vous ne pouvez pas vous supprimer vous-même.');
        }

        if ($admin->is_super_admin && Admin::where('is_super_admin', true)->count() <= 1) {
            return redirect()->back()->withErrors('Impossible de supprimer le dernier super admin.');
        }

        AuditLog::record('admin.delete', "Administrateur supprimé: {$admin->email}", ['admin_id' => $admin->id]);

        $admin->delete();

        return redirect()->route('admin.superadmin.index')->with('success', 'Administrateur supprimé.');
    }
}
