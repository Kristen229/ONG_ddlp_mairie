<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\User;
use App\Models\Requests;
use App\Models\Activity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Enums\RequestStatus;

use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('conAdmin');
    }

    public function authenticate(Request $request)
    {
        // Valider les données de la requête
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Trouver l'utilisateur par email
        $admin = Admin::where('email', $request->email)->first();
    
        // Vérifier si l'utilisateur existe et si le mot de passe correspond
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Authentifier l'utilisateur
            Auth::guard('admin')->login($admin);
    
            return redirect()->route('admin', ['id' => $admin->id]);
        }
    
        // Si l'utilisateur n'existe pas ou le mot de passe est incorrect
        return back()->withErrors([
            'email' => 'Les informations de connexion ne correspondent pas.',
        ]);
    }

    public function createAdmin(Request $request)
    {
        
        // Create the admin
        try {

            // Validate the request data
            $validatedData = $request->validate([
                'email' => 'required|email|unique:admins,email',
                'password' => 'required|string|min:5',
            ]);

            Admin::create([
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
            ]);
            return redirect()->route('conAdmin')->with('success', 'Vous avez été enregistré avec succès!');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        
    }

    public function exportByDomaine(Request $request)
    {
        $request->validate([
            'domaine' => 'required|string'
        ]);

        $domaine = $request->domaine;

        $associations = User::where('domaine', 'LIKE', "%{$domaine}%")->get();

        if ($associations->isEmpty()) {
            return back()->with('error', 'Aucune association trouvée pour ce domaine.');
        }

        $pdf = Pdf::loadView('pdf.export-domaine', compact('associations', 'domaine'));

        return $pdf->download("associations_{$domaine}.pdf");
    }



public function exportStatsPdf(Request $request)
{
    // Récupération des images envoyées par JS
    $images = $request->input('images', []);

    // Ne garder que les images valides (Base64)
    $images = array_filter($images, fn($img) => !empty($img) && str_starts_with($img, 'data:image'));

    return Pdf::loadView('pdf.stats', [
        'userCount'        => User::count(),
        'associationCount' => User::where('groupe', 'association')->count(),
        'ongCount'         => User::where('groupe', 'ong')->count(),

        'requestCount'     => Requests::count(),
        'requestaCount'    => Requests::where('statut', RequestStatus::APPROVED->value)->count(),
        'requestrCount'    => Requests::where('statut', RequestStatus::REJECTED->value)->count(),
        'requesteCount'    => Requests::where('statut', RequestStatus::PENDING->value)->count(),

        'activityCount'    => Activity::count(),
        'activitysCount'   => Activity::whereHas('user', fn($q)=>$q->where('groupe','ONG'))->count(),
        'activityseCount'  => Activity::whereHas('user', fn($q)=>$q->where('groupe','association'))->count(),

        'images'           => $images
    ])
    ->setPaper('A4', 'portrait')
    ->download('statistiques_mairie.pdf');
}





}
