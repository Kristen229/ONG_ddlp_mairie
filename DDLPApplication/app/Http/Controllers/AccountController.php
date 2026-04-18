<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Requests;
use App\Models\Activity;
use App\Models\Notification;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

use App\Models\User;

class AccountController extends Controller
{
    
    // ---------------- Formulaire 1 ----------------
    public function createUserPartie1(Request $request)
    {
        $request->validate([
            'groupe' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'domaine' => 'required|array',
            'denomination' => 'required|string|max:255',
            'date' => 'required|date',
            'objectif1' => 'required|string|max:255',
            'objectif2' => 'required|string|max:255',
            'objectif3' => 'required|string|max:255',
        ]);

        $user = User::create([
            'groupe' => $request->groupe,
            'name' => $request->name,
            'domaine' => implode(',', $request->domaine),
            'denomination' => $request->denomination,
            'date' => $request->date,
            'objectif1' => $request->objectif1,
            'objectif2' => $request->objectif2,
            'objectif3' => $request->objectif3,
        ]);

        // Stocker l'ID dans la session pour les étapes suivantes
        session(['user_id' => $user->id]);

        return redirect()->route('user.createForme2');
    }

    // ---------------- Formulaire 2 ----------------
    public function createUserPartie2(Request $request)
    {

        $request->validate([
            'siege'       => 'required|string|max:255',
            'email'       => 'required|email|max:255',
            'number1'     => 'required|string|max:20',
            'number2'     => 'nullable|string|max:20',
            'attachment'  => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'identifiant' => 'required|string|max:255',
            'password'    => 'required|string|min:6',
            'lien'        => 'required|url|max:255',
        ]);

        $userId = session('user_id');
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->withErrors('Utilisateur introuvable.');
        }

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public'); // Stocker dans "storage/app/public/attachments"
        } else {
            $path = $user->attachment; // Conserver l'image existante si aucune nouvelle n'est fournie
        }
        $user->update([
            'siege' => $request->siege,
            'email' => $request->email,
            'number1' => $request->number1,
            'number2' => $request->number2,
            'attachment' => $path,
            'identifiant' => $request->identifiant,
            'password' => Hash::make($request->password),
            'lien' => $request->lien,
        ]);

        return redirect()->route('user.createForme3')->with('success', 'Formulaire 2 enregistré.');
    }

    public function createUserPartie3(Request $request)
    {
        $user = User::latest()->first();

        $user->update([
            'namePresident' => $request->namePresident,
            'lastNamePresident' => $request->lastNamePresident,
            'attachment1' => $request->hasFile('attachment1') 
                ? $request->file('attachment1')->store('attachments', 'public') 
                : 'attachments/user.jpg',

            'nameVicePresident' => $request->nameVicePresident,
            'lastNameVicePresident' => $request->lastNameVicePresident,
            'attachment2' => $request->hasFile('attachment2') 
                ? $request->file('attachment2')->store('attachments', 'public') 
                : 'attachments/user.jpg',

            'nameSecretaireGeneral' => $request->nameSecretaireGeneral,
            'lastNameSecretaireGeneral' => $request->lastNameSecretaireGeneral,
            'attachment3' => $request->hasFile('attachment3') 
                ? $request->file('attachment3')->store('attachments', 'public') 
                : 'attachments/user.jpg',

            'nameTresorierGeneral' => $request->nameTresorierGeneral,
            'lastNameTresorierGeneral' => $request->lastNameTresorierGeneral,
            'attachment4' => $request->hasFile('attachment4') 
                ? $request->file('attachment4')->store('attachments', 'public') 
                : 'attachments/user.jpg',

            'attachment5' => $request->file('attachment5')->store('attachments', 'public'),

            'signature_data' => $request->hasFile('signature_data') 
                ? $request->file('signature_data')->store('attachments', 'public') 
                : null,            
                
            'cachet' => $request->hasFile('cachet') 
                ? $request->file('cachet')->store('attachments', 'public') 
                : null, 

            'created_by' => 'user',
        ]);

        return redirect()->route('connexion');
    }




    public function createUserType1(Request $request)
    {
        // Logique de validation et sauvegarde pour UserType1
        User::create([
            'groupe' => $request->groupe,
            'name' => $request->name,
            'domaine' => implode(',', $request->domaine),
            'denomination' => $request->denomination,
            'date' => $request->date,
            'objectif1' => $request->objectif1,
            'objectif2' => $request->objectif2,
            'objectif3' => $request->objectif3,
        ]);

        return redirect()->route('admin.createForm2');
    }

    public function createUserType2(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'siege' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'number1' => 'required|string|max:20',
            'number2'    => 'nullable|string|max:20',            
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Limiter aux formats d'image
            'identifiant' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'lien' => 'nullable|url|max:255',
        ]);

        // Hachage du mot de passe avant de l'enregistrer
        $password = Hash::make($request->password);
    
    
        // Récupérer le dernier utilisateur créé
        $user = User::latest()->first();
        if (!$user) {
            return redirect()->back()->withErrors('Aucun utilisateur trouvé pour mise à jour.');
        }
    
        // Gérer l'upload d'image si un fichier est présent
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public'); // Stocker dans "storage/app/public/attachments"
        } else {
            $path = $user->attachment; // Conserver l'image existante si aucune nouvelle n'est fournie
        }
    
        // Mettre à jour les informations de l'utilisateur
        $user->update([
            'siege' => $request->siege,
            'email' => $request->email,
            'number1' => $request->number1,
            'number2' => $request->number2,
            'attachment' => $path,
            'identifiant' => $request->identifiant,
            'password' => $password,  // ✅ Corrigé
            'lien' => $request->lien,
        ]);
    
        return redirect()->route('admin.createForm3')->with('success', 'Les informations ont été mises à jour avec succès.');
    }

    public function createUserType3(Request $request)
    {
        // Logique de validation et sauvegarde pour UserType3
        $user = User::latest()->first();
        $user->update([
            'namePresident' => $request->namePresident,
            'lastNamePresident' => $request->lastNamePresident,
            'attachment1' => $request->hasFile('attachment1') 
                ? $request->file('attachment1')->store('attachments', 'public') 
                : 'attachments/user.jpg',

            'nameVicePresident' => $request->nameVicePresident,
            'lastNameVicePresident' => $request->lastNameVicePresident,
            'attachment2' => $request->hasFile('attachment2') 
                ? $request->file('attachment2')->store('attachments', 'public') 
                : 'attachments/user.jpg',

            'nameSecretaireGeneral' => $request->nameSecretaireGeneral,
            'lastNameSecretaireGeneral' => $request->lastNameSecretaireGeneral,
            'attachment3' => $request->hasFile('attachment3') 
                ? $request->file('attachment3')->store('attachments', 'public') 
                : 'attachments/user.jpg',

            'nameTresorierGeneral' => $request->nameTresorierGeneral,
            'lastNameTresorierGeneral' => $request->lastNameTresorierGeneral,
            'attachment4' => $request->hasFile('attachment4') 
                ? $request->file('attachment4')->store('attachments', 'public') 
                : 'attachments/user.jpg',
            'attachment5' => $request->file('attachment5')->store('attachments', 'public'),
         
            'signature_data' => $request->hasFile('signature_data') 
                ? $request->file('signature_data')->store('attachments', 'public') 
                : null,            
                
            'cachet' => $request->hasFile('cachet') 
                ? $request->file('cachet')->store('attachments', 'public') 
                : null, 


            'created_by' => 'admin', // Marquer comme créé par un administrateur

        ]);

        return redirect()->route('admin');
 
    }

    public function checkRequestStatus(Request $request)
    {
        // Récupérer le nom de la demande depuis le formulaire
        $requestName = $request->input('request_name');

        // Rechercher la demande dans la base de données
        $requestData = Requests::where('title', $requestName)->first();

        if (!$requestData) {
            return back()->with('error', 'Demande introuvable.');
        }

        // Retourner une vue avec les données de la demande
        return view('request-status', ['request' => $requestData]);
    }

    public function showPage($id)
    {
        // Récupérer l'utilisateur par ID
        $user = User::find($id);

        // Vérifier si l'utilisateur existe
        if (!$user) {
            return redirect()->route('home')->with('error', 'Utilisateur non trouvé.');
        }

        // Passer les données à la vue
        return view('associationPage', compact('user'));
    }

    public function index()
    {
        // Assurez-vous de récupérer les associations correctement
        
        $associations = User::all();

        $userAsssociation = User::where('created_by', 'user')->get();  // Les associations créées par l'utilisateur
        $adminAssociations = User::where('created_by', 'admin')->get();  // Les associations créées par l'administrateur

        // Récupérer les demandes avec relations utilisateur
        $requests = Requests::with('user')->paginate(10); // Vous pouvez aussi paginer les demandes

        // Récupérer les notifications paginées
        $notifications = Notification::latest()->take(5)->get(); // 5 dernières
        $allNotifications = Notification::latest()->skip(5)->take(1000000)->get();

        // Compter les demandes en attente
        $pendingRequestsCount = Requests::where('statut', 'En attente')->count();
        $activities = Activity::where('is_visible', true)->get();

        // Retourner la vue avec les données
        return view('admin', [
            'associations' => $associations,
            'userAssociations' => $userAsssociation,
            'adminAssociations' => $adminAssociations,
            'pendingRequestsCount' => $pendingRequestsCount,
            'requests' => $requests, // Assurez-vous que cette ligne passe bien la variable requests
            'notifications' => $notifications,
            'allNotifications' => $allNotifications,
            'activities'=> $activities,
            
        ]);
    }

    public function edit($id)
    {
        // Chercher l'utilisateur avec l'ID donné
        $user = User::find($id);
        
        // Vérifier si l'utilisateur existe
        if (!$user) {
            return redirect()->route('admin.index')->with('error', 'Utilisateur non trouvé.');
        }
    
        return view('editAssociation', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validation des fichiers
        $validatedData = $request->validate([
            'attachment' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment1' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment2' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment3' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment4' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attachment5' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'signature_data' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cachet' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Mise à jour des autres champs
        $user->name = $request->input('name');
        $user->groupe = $request->input('groupe');

        // Domaine multi-select
        $user->domaine = is_array($request->input('domaine')) ? implode(',', $request->input('domaine')) : $request->input('domaine');

        $user->denomination = $request->input('denomination');
        $user->date = $request->input('date');
        $user->objectif1 = $request->input('objectif1');
        $user->objectif2 = $request->input('objectif2');
        $user->objectif3 = $request->input('objectif3');
        $user->siege = $request->input('siege');
        $user->email = $request->input('email');
        $user->number1 = $request->input('number1');
        $user->number2 = $request->input('number2');
        $user->identifiant = $request->input('identifiant');
        $user->lien = $request->input('lien');

        $user->namePresident = $request->input('namePresident');
        $user->lastNamePresident = $request->input('lastNamePresident');
        $user->nameVicePresident = $request->input('nameVicePresident');
        $user->lastNameVicePresident = $request->input('lastNameVicePresident');
        $user->nameSecretaireGeneral = $request->input('nameSecretaireGeneral');
        $user->lastNameSecretaireGeneral = $request->input('lastNameSecretaireGeneral');
        $user->nameTresorierGeneral = $request->input('nameTresorierGeneral');
        $user->lastNameTresorierGeneral = $request->input('lastNameTresorierGeneral');

        // Gestion du mot de passe : hachage seulement si changé
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Upload des fichiers
        foreach (['attachment', 'attachment1','attachment2','attachment3','attachment4','attachment5','signature_data','cachet'] as $file) {
            if ($request->hasFile($file)) {
                $user->$file = $request->file($file)->store('attachments', 'public');
            }
        }

        $user->save();

        return redirect()->route('admin')->with('success', 'Association mise à jour avec succès');
    }


    public function delete($id)
    {
        $user = User::find($id);  // Recherchez l'utilisateur avec l'ID passé en paramètre
        if ($user) {
            $user->delete();  // Supprimez l'utilisateur
            return redirect()->route('admin')->with('success', 'Utilisateur supprimé avec succès.');
        } else {
            return redirect()->route('admin')->with('error', 'Utilisateur non trouvé.');
        }
    }

    public function approve(Request $request, $id)
    {
        try {
            Log::info('Début de la méthode approve pour l\'ID: ' . $id);
    
            $validated = $request->validate([
                'motif' => 'required|string',
                'email' => 'required|email',
                'attachment' => 'nullable|file|mimes:pdf|max:2048', // Pièce jointe optionnelle
            ]);
    
            $requestToApprove = Requests::findOrFail($id);
    
            Log::info('Demande trouvée: ', ['id' => $requestToApprove->id]);
    
            $requestToApprove->statut = 'Acceptée';
            $requestToApprove->save();
    
            Log::info('Statut mis à jour pour la demande.');
    
            $motif = $request->input('motif', 'Aucun motif spécifié');
            $email = $request->input('email');
            
            // Gérer la pièce jointe
            $attachmentPath = null;
            if ($request->hasFile('attachment')) {
                $attachmentPath = $request->file('attachment')->store('attachments', 'public');
                Log::info('Pièce jointe sauvegardée : ' . $attachmentPath);
            } else {
                Log::info('Aucune pièce jointe fournie.');
            }
    
            $data = [
                'associationName' => $requestToApprove->association_name,
                'motif' => $motif,
                'attachment' => $attachmentPath ? asset('storage/' . $attachmentPath) : null,
            ];
    
            try {
                Mail::send('emails.approved', $data, function ($message) use ($email, $attachmentPath) {
                    $message->to($email)
                            ->from('ddlpmairie@gmail.com', 'DDLP')
                            ->subject('Demande approuvée');
                    if ($attachmentPath) {
                        $message->attach(storage_path('app/public/' . $attachmentPath));
                    }
                });
    
                Log::info('Email envoyé avec succès à ' . $email);
            } catch (\Exception $mailException) {
                Log::error('Erreur lors de l\'envoi de l\'email : ' . $mailException->getMessage());
                return response()->json(['success' => false, 'message' => 'Erreur lors de l\'envoi de l\'email.'], 500);
            }
    
            return response()->json(['success' => true, 'message' => 'Demande approuvée et email envoyé.']);
        } catch (\Exception $e) {
            Log::error('Erreur dans approve : ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Une erreur s\'est produite.'], 500);
        }
    }
    
   public function reject(Request $request, $id)
{
    try {
        // Validation
        $request->validate([
            'motif' => 'required|string',
            'email' => 'required|email',
        ]);

        // Récupérer la demande
        $requestToReject = Requests::findOrFail($id);

        // Mettre à jour le statut
        $requestToReject->statut = 'Refusée';
        $requestToReject->save();

        // Envoyer l'email
        $data = [
            'associationName' => $requestToReject->association_name,
            'motif' => $request->motif,
        ];

        Mail::send('emails.rejected', $data, function ($message) use ($request) {
            $message->to($request->email)
                    ->from('ddlpmairie@gmail.com', 'DDLP')
                    ->subject('Demande rejetée');
        });

        // ✅ Retour JSON pour AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Demande rejetée et email envoyé.',
                'request_id' => $id
            ]);
        }

        // Si ce n’est pas AJAX, rediriger normalement
        return redirect()->route('admin')->with('success', 'Demande rejetée et email envoyé.');

    } catch (\Exception $e) {
        // Retour JSON en cas d'erreur AJAX
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue : ' . $e->getMessage(),
            ], 500);
        }
    }
}



    public function show($id)
    {
        $request = Requests::with('user')->find($id);

        if (!$request) {
            return response()->json(['error' => 'Demande non trouvée'], 404);
        }

        return response()->json([
            'id' => $request->id,
            'user' => [
                'name' => $request->user->name,
            ],
            'type' => $request->type,
            'description' => $request->description ?? 'Non spécifié',
            'created_at' => $request->created_at,
            'statut' => $request->statut,
            // 🔹 Générer les liens corrects
            'pdf_path' => asset('storage/' . $request->pdf_path),
        ]);
    }
}
