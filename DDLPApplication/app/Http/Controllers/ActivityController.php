<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Carbon\Carbon;
use App\Models\Activity;
use App\Models\Notification;
use App\Models\Requests;
use App\Models\User;

use Illuminate\Support\Facades\Mail; 
use App\Mail\WarningMail;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'lieu' => 'required|string',
            'date' => 'required|date',
            'attachment' => 'required|file|mimes:jpg,jpeg,png,pdf,docx',
        ]);

        // Sauvegarder l'activité
        $activity = new Activity();
        $activity->titre = $request->titre;
        $activity->description = $request->description;
        $activity->lieu = $request->lieu;
        $activity->date = $request->date; 
        $activity->beneficiaries_expected = $request->beneficiaries_expected;
        $activity->budget_expected = $request->budget_expected;
        $activity->user_id = Auth::id(); // Assurez-vous que l'utilisateur est authentifié

        // Gérer la pièce jointe
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $activity->attachment = basename($path); // Sauvegarde du nom du fichier dans la colonne 'attachment'
        }

        $activity->save();

        // Rediriger vers la page des activités après la publication
        return redirect()->route('user.show', ['id' => $activity->user_id])->with('success', 'Activité créée avec succès');

    }

    public function validatActivity($id)
    {
        $activity = Activity::findOrFail($id);

        // ===== SCORE CALCUL =====

        $beneficiaryScore = 0;

        if ($activity->beneficiaries_expected > 0 &&
            $activity->beneficiaries_actual !== null) {

            $beneficiaryScore =
            ($activity->beneficiaries_actual /
            $activity->beneficiaries_expected) * 100;

            $beneficiaryScore = min($beneficiaryScore, 100);
        }

        $budgetScore = 0;

        if ($activity->budget_expected !== null &&
            $activity->budget_actual !== null) {

            $budgetScore =
            ($activity->budget_actual <= $activity->budget_expected)
            ? 100 : 50;
        }

        $delayScore = 0;

        if ($activity->planned_date && $activity->actual_date) {

            $delayScore =
            ($activity->actual_date <= $activity->planned_date)
            ? 100 : 50;
        }

        $finalScore =
        ($beneficiaryScore * 0.4) +
        ($budgetScore * 0.3) +
        ($delayScore * 0.3);

        // ===== SAUVEGARDE =====

        $activity->score = $finalScore;
        $activity->evaluation_status = 'conforme';
        $activity->is_visible = true;

        $activity->save();

        return back()->with('success','Activité validée et score calculé.');
    }

    public function destroy($id)
    {
        $activity = Activity::findOrFail($id);

        // Masquer l'activité
        $activity->is_visible = false;

        // Mettre statut rejeté (très important pour l'évaluation)
        $activity->evaluation_status = 'non_conforme';

        $activity->save();

        return back()->with('success','Activité retirée de l’interface.');
    }

    public function update(Request $request, $id)
    {
        $activity = Activity::findOrFail($id);
    
        // Validation des données
        $validatedData = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'attachment' => 'nullable|image|max:2048',
            'beneficiaries_actual' => 'required|integer',
            'budget_actual' => 'required|numeric',
            'actual_date' => 'required|date'
        ]);
    
        // Mise à jour des champs
        $activity->titre = $validatedData['titre'];
        $activity->description = $validatedData['description'];
        $activity->beneficiaries_actual = $validatedData['beneficiaries_actual'];
        $activity->budget_actual = $validatedData['budget_actual'];
        $activity->actual_date = $validatedData['actual_date'];

    
        // Gestion de l'image si elle est fournie
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('attachments', 'public');
            $activity->attachment = $path;
        }
    
        // Enregistrement des modifications
        $activity->save();
    
        // Redirection ou retour de réponse
        return redirect()->back()->with('success', 'Activité modifiée avec succès.');
    }

    public function index(Request $request)
    {
        
        // Compter le nombre d'association et ong enregistrés
        $userCount = User::count();
        
        $ongCount = User::where('groupe', 'ong')->count();

        $associationCount = User::where('groupe', 'association')->count();

        $requestCount = Requests::count();

        $requesttCount = Requests::whereIn('statut', ['Acceptée', 'Rejetée'])->count();
        
        $requesteCount = Requests::where('statut', 'En attente')->count();

        $requestaCount = Requests::where('statut', 'Acceptée')->count();

        $requestrCount = Requests::where('statut', 'Rejetée')->count();

        $activityCount = Activity::count();
        
        $activitysCount = Activity::whereHas('user', function ($query) {
            $query->where('groupe', 'ONG');
        })->count();

        $activityseCount = Activity::whereHas('user', function ($query) {
            $query->where('groupe', 'association');
        })->count();

        $requests = Requests::with('user')->paginate(10); // Vous pouvez aussi paginer les demandes
        
        $associations = User::all();

        // Assurez-vous de récupérer les associations correctement
        $userAssociations = User::where('created_by', 'user')->get();  // Les associations créées par l'utilisateur
        $adminAssociations = User::where('created_by', 'admin')->get();  // Les associations créées par l'administrateur

        // Récupérer les notifications paginées
        $notifications = Notification::latest()->paginate(5);

        // Compter les demandes en attente
        $pendingRequestsCount = Requests::where('statut', 'En attente')->count();

        $activities = Activity::where('is_visible', true)->get();

        $lastUsers = User::latest()->take(8)->get();

        $monthlyCounts = DB::table('users')  // ici DB::table, pas User::table
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->whereYear('created_at', now()->year) // année dynamique
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        // Pour avoir un tableau de 12 mois rempli à zéro par défaut
        $countsByMonth = [];
        for ($m = 1; $m <= 12; $m++) {
            $countsByMonth[$m] = $monthlyCounts->get($m, 0);
        }

        $monthlyAssociations = DB::table('users')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->where('groupe', 'association')
        ->whereYear('created_at', now()->year) // année dynamique
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        $countsAssociations = [];
        for ($m = 1; $m <= 12; $m++) {
            $countsAssociations[] = $monthlyAssociations->get($m, 0); // tableau indexé
        }


        $monthlyOng = DB::table('users')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->where('groupe', 'ong')
        ->whereYear('created_at', now()->year) // année dynamique
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        $countsOng = [];
        for ($m = 1; $m <= 12; $m++) {
            $countsOng[] = $monthlyOng->get($m, 0); // tableau indexé
        }

        $monthlyRequests = DB::table('requests')
        ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
        ->whereYear('created_at', now()->year) // année dynamique
        ->groupBy('month')
        ->orderBy('month')
        ->pluck('count', 'month');

        $requestCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $requestCounts[] = $monthlyRequests->get($i, 0); // valeurs indexées de janvier à décembre
        }

        $requestTypes = DB::table('requests')
        ->select('type', DB::raw('COUNT(*) as count'))
        ->whereYear('created_at', now()->year) // année dynamique
        ->groupBy('type')
        ->pluck('count', 'type');

        // Préparation des données
        $labels = $requestTypes->keys()->toArray();
        $data = $requestTypes->values()->toArray();

        $year = now()->year; // année en cours
        $months = range(1, 12);

        $statsTotal = [];
        $statsAsso = [];
        $statsONG = [];

        foreach ($months as $month) {
            $statsTotal[] = Activity::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $statsAsso[] = Activity::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereHas('user', fn($q) => $q->where('groupe', 'association'))
                ->count();

            $statsONG[] = Activity::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->whereHas('user', fn($q) => $q->where('groupe', 'ONG'))
                ->count();
        }

        // Fetch requests with the user relationship
        $requests = Requests::with('user')->get();
    
        // Count pending requests
        $pendingRequestsCount = $requests->where('statut', 'pending')->count();
    
        $notifications = Notification::latest()->paginate(5);

        $user = Auth::user();  // Get the currently authenticated user


        // Fetch recent activities (if needed)
        $activities = Activity::orderBy('created_at', 'desc')->get();
        $activities = Activity::where('is_visible', true)->get();
        $activities = Activity::with('user')->get();
        
        // Récupère tous les utilisateurs (associations)
        $users = User::paginate(10); // Paginer avec 10 utilisateurs par page
    
        $search = $request->input('search');

        // Filtrer les activités selon le nom de l'association/ONG
        $activities = Activity::when($search, function ($query, $search) {
            return $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        })->with('user')->get();

        return view('admin', [
            'requests' => $requests,
            'pendingRequestsCount' => $pendingRequestsCount,
            'activities' => $activities,
            'notifications' => $notifications,
            'user' => $user,
            'users' => $users,
           'associations' =>$associations,
            'userAssociations' => $userAssociations,
            'adminAssociations' => $adminAssociations,
            'pendingRequestsCount' => $pendingRequestsCount,
            'requests' => $requests, // Assurez-vous que cette ligne passe bien la variable requests
            'notifications' => $notifications,
            'activities'=> $activities,
            'userCount' => $userCount,
            'ongCount' => $ongCount,
            'associationCount' => $associationCount,
            'requestCount' => $requestCount,
            'requesttCount' => $requesttCount,
            'requestaCount' => $requestaCount,
            'requestrCount' => $requestrCount,
            'activityCount' => $activityCount,
            'activitysCount' => $activitysCount,
            'activityseCount' => $activityseCount,
            'lastUsers' => $lastUsers,
            'countsByMonth' => $countsByMonth,
            'countsAssociations' => $countsAssociations,
            'countsOng' => $countsOng,
            'requesteCount' => $requesteCount,
            'requestCounts' => $requestCounts,
            'labels' => $labels,
            'data' => $data,
            'statsTotal' => $statsTotal,
            'statsAsso' => $statsAsso,
            'statsONG' => $statsONG,
            'users' => User::all(),
        ]);
    }

    public function sendWarning($id)
    {
        $activity = Activity::findOrFail($id);

        $user = $activity->user;

        // Mise à jour statut
        $activity->evaluation_status = 'avertissement';
        $activity->save();

        // Email avertissement
        Mail::to($user->email)->send(new WarningMail($activity));

        return back()->with('success', "Avertissement envoyé.");
    }

    public function createAdmin()
    {
        // On récupère toutes les associations/ONG
        $users = User::whereIn('groupe', ['association', 'ong'])->get();

        return view('admin.activities.create', compact('users'));
    }

    public function storeAdmin(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'titre' => 'required|string|max:255',
            'description' => 'required',
            'attachment' => 'required|image',
            'lieu' => 'required|string|max:255',
            'date' => 'required|string|max:255',
        ]);

        // Sauver l'image
        $filePath = $request->file('attachment')->store('attachments', 'public');

        Activity::create([
            'user_id' => $request->user_id,
            'titre' => $request->titre,
            'description' => $request->description,
            'attachment' => $filePath,
            'lieu' => $request->lieu,
            'date' => $request->date,
        ]);

        return redirect()->route('activities.index')->with('success', 'Activité ajoutée avec succès.');
    }

    public function validateActivity($id)
    {
        $activity = Activity::findOrFail($id);

        // 1️⃣ Taux bénéficiaires
        $beneficiaryScore = 0;

        if ($activity->beneficiaries_expected > 0 && 
            $activity->beneficiaries_actual !== null) {

            $beneficiaryScore = 
            ($activity->beneficiaries_actual / 
            $activity->beneficiaries_expected) * 100;

            $beneficiaryScore = min($beneficiaryScore, 100);
        }

        // 2️⃣ Respect budget
        $budgetScore = 0;

        if ($activity->budget_expected !== null &&
            $activity->budget_actual !== null) {

            if ($activity->budget_actual <= $activity->budget_expected) {
                $budgetScore = 100;
            } else {
                $budgetScore = 50;
            }
        }

        // 3️⃣ Respect délai
        $delayScore = 0;

        if ($activity->date && $activity->actual_date) {

            if ($activity->actual_date <= $activity->date) {
                $delayScore = 100;
            } else {
                $delayScore = 50;
            }
        }

        // 🎯 Score final
        $finalScore = ($beneficiaryScore * 0.4) +
                    ($budgetScore * 0.3) +
                    ($delayScore * 0.3);

        $activity->score = $finalScore;
        $activity->evaluation_status = 'conforme';
        $activity->save();

        return back()->with('success', 'Activité validée et score calculé.');
    }
}
