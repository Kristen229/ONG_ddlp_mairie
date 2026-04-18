<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Demande;
use App\Models\Activity;
use App\Models\Requests;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;

class StatistiqueController extends Controller
{
    public function getStats()
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
        $notifications = Notification::latest()->take(5)->get(); // 5 dernières
        $allNotifications = Notification::latest()->skip(5)->take(1000000)->get();


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

        return view('admin', [
            'associations' =>$associations,
            'userAssociations' => $userAssociations,
            'adminAssociations' => $adminAssociations,
            'pendingRequestsCount' => $pendingRequestsCount,
            'requests' => $requests, // Assurez-vous que cette ligne passe bien la variable requests
            'notifications' => $notifications,
            'allNotifications' => $allNotifications,
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
    
    public function download($id)
    {
        $stats = $this->getStats(); // tu récupères toutes les stats

        $user = User::findOrFail($id);

        $pdf = Pdf::loadView('pdf.association', compact('user'));

        return $pdf->download('Association_' . $user->nom . '.pdf');
    }
}
