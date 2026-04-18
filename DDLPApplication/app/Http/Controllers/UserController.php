<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Requests;
use App\Models\User;
use App\Models\Activity;
use App\Models\Notification;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;

/**
 * @param Request $request
 */

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('connexion');
    }

    public function authenticate(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Trouver l'utilisateur par email
        $user = User::where('email', $request->email)->first();
    
        // Vérifier si l'utilisateur existe et si le mot de passe correspond
        if ($user && Hash::check($request->password, $user->password)) {
            // Authentifier l'utilisateur
            Auth::login($user);
    
            return redirect()->route('user.show', ['id' => $user->id]);
        }
    

        // Si l'utilisateur n'existe pas ou le mot de passe est incorrect
        return back()->withErrors([
            'email' => 'Les informations de connexion ne correspondent pas.',
        ]);
    }

    public function indexe()
    {
        // Récupérer toutes les associations de la base de données
        $associations = User::paginate(3);  // Affiche 10 associations par page
        return view('association-et-ong', ['associations' => $associations]);
    }

    public function showAssociations()
    {
        $associations = User::all(); // Récupère toutes les associations
        $activities = Activity::all();
        $users = User::all(); // Si vous avez un modèle Association

        return view('accueil', [
            'users' => $users, // Si vous passez une collection d'utilisateurs
            'activities' => $activities,
            'associations' => $associations,
        ]);
    }

    public function showDetails($id)
    {
        $association = User::findOrFail($id); // Récupère l'utilisateur par ID
        return view('details', compact('association')); // Retourne la vue avec les données
    }

    public function shows()
    {
        // Récupérer un utilisateur spécifique (par exemple, l'utilisateur connecté)
        $user = Auth::user(); // Assurez-vous que l'utilisateur est connecté

        // Récupérer d'autres données nécessaires
        $users = User::all();
        $activities = Activity::where('user_id', $user->id)
        ->latest()
        ->get();
        $notifications = Notification::where('user_id', $user->id)
        ->latest()
        ->get();

        // Passer les données à la vue
        return view('user.show', compact('user', 'users', 'activities', 'notifications'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $user->namePresident = $request->input('namePresident');
        $user->lastNamePresident = $request->input('lastNamePresident');

        $user->nameVicePresident = $request->input('nameVicePresident');
        $user->lastNameVicePresident = $request->input('lastNameVicePresident');

        $user->nameSecretaireGeneral = $request->input('nameSecretaireGeneral');
        $user->lastNameSecretaireGeneral = $request->input('lastNameSecretaireGeneral');

        $user->nameTresorierGeneral = $request->input('nameTresorierGeneral');
        $user->lastNameTresorierGeneral = $request->input('lastNameTresorierGeneral');

        if ($request->hasFile('attachment1')) {
            $user->attachment1 = $request->file('attachment1')->store('attachments', 'public');
        }
        if ($request->hasFile('attachment2')) {
            $user->attachment2 = $request->file('attachment2')->store('attachments', 'public');
        }
        if ($request->hasFile('attachment3')) {
            $user->attachment3 = $request->file('attachment3')->store('attachments', 'public');
        }
        if ($request->hasFile('attachment4')) {
            $user->attachment4 = $request->file('attachment4')->store('attachments', 'public');
        }
    
        $user->save();
    
        return redirect()->route('user.show', ['id' => $user->id])->with('success', 'Informations mises à jour avec succès');
    }

    public function showAdminPage()
    {
        $users = User::all(); // Récupérer tous les utilisateurs
        $requests = Requests::all(); // Récupère toutes les demandes

        $pendingRequests = Requests::where('statut', 'En attente')->get();

        return view('admin', compact('users', 'requests', 'pendingRequests')); // Passer les variables $users et $requests à la vue

    }

    public function updateInfos(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validation des champs
        $data = $request->validate([
            'groupe'       => 'nullable|string|max:255',
            'name'         => 'nullable|string|max:255',
            'domaine'      => 'nullable|string|max:255',
            'denomination' => 'nullable|string|max:255',
            'date'         => 'nullable|date',
            'objectif1'    => 'nullable|string',
            'objectif2'    => 'nullable|string',
            'objectif3'    => 'nullable|string',
            'siege'        => 'nullable|string',
            'email'        => 'nullable|email',
            'number1'      => 'nullable|string',
            'number2'      => 'nullable|string',
            'attachment'   => 'nullable|image|max:2048',
            'attachment5'  => 'nullable|image|max:2048',
            'signature_data' => 'nullable|image|max:2048',
            'cachet' => 'nullable|image|max:2048',
        ]);

        // Gestion des fichiers
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $data['attachment'] = $file->store('attachments', 'public');
        }

        if ($request->hasFile('attachment5')) {
            $file = $request->file('attachment5');
            $data['attachment5'] = $file->store('attachments', 'public');
        }

        if ($request->hasFile('signature_data')) {
            $file = $request->file('signature_data');
            $data['signature_data'] = $file->store('attachments', 'public');
        }

        if ($request->hasFile('cachet')) {
            $file = $request->file('cachet');
            $data['cachet'] = $file->store('attachments', 'public');
        }

        // Mise à jour
        $user->update($data);

        return redirect()->back()->with('success', 'Informations mises à jour avec succès !');
    }

    public function calculateGlobalScore($userId)
    {
        $user = User::findOrFail($userId);

        $averageScore = $user->activities()
                        ->where('evaluation_status', 'conforme')
                        ->avg('score');

        return $averageScore;
    }

    
}
