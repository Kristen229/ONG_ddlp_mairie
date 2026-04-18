<?php

namespace App\Services;

use App\Models\User;
use App\Models\Activity;
use App\Models\Requests;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Enums\RequestStatus;

class StatsService
{
    public function getAdminDashboardData()
    {
        // Compter le nombre d'association et ong enregistrés
        $userCount = User::count();
        $ongCount = User::where('groupe', 'ong')->count();
        $associationCount = User::where('groupe', 'association')->count();

        $requestCount = Requests::count();
        $requesttCount = Requests::whereIn('statut', [RequestStatus::APPROVED->value, RequestStatus::REJECTED->value])->count();
        $requesteCount = Requests::where('statut', RequestStatus::PENDING->value)->count();
        $requestaCount = Requests::where('statut', RequestStatus::APPROVED->value)->count();
        $requestrCount = Requests::where('statut', RequestStatus::REJECTED->value)->count();

        $activityCount = Activity::count();
        $activitysCount = Activity::whereHas('user', function ($query) {
            $query->where('groupe', 'ONG');
        })->count();

        $activityseCount = Activity::whereHas('user', function ($query) {
            $query->where('groupe', 'association');
        })->count();

        $requests = Requests::with('user')->paginate(10);
        $associations = User::all();

        $userAssociations = User::where('created_by', 'user')->get();
        $adminAssociations = User::where('created_by', 'admin')->get();

        $notifications = Notification::latest()->take(5)->get();
        $allNotifications = Notification::latest()->skip(5)->take(1000000)->get();

        $pendingRequestsCount = Requests::where('statut', RequestStatus::PENDING->value)->count();

        // Par defaut, retourner les non masquées. Certains controlleurs modifient cette variable.
        $activities = Activity::where('is_visible', true)->get();

        $lastUsers = User::latest()->take(8)->get();

        $monthlyCounts = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $countsByMonth = [];
        for ($m = 1; $m <= 12; $m++) {
            $countsByMonth[$m] = $monthlyCounts->get($m, 0);
        }

        $monthlyAssociations = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->where('groupe', 'association')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $countsAssociations = [];
        for ($m = 1; $m <= 12; $m++) {
            $countsAssociations[] = $monthlyAssociations->get($m, 0);
        }

        $monthlyOng = DB::table('users')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->where('groupe', 'ong')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $countsOng = [];
        for ($m = 1; $m <= 12; $m++) {
            $countsOng[] = $monthlyOng->get($m, 0);
        }

        $monthlyRequests = DB::table('requests')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('count', 'month');

        $requestCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $requestCounts[] = $monthlyRequests->get($i, 0);
        }

        $requestTypes = DB::table('requests')
            ->select('type', DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', now()->year)
            ->groupBy('type')
            ->pluck('count', 'type');

        $labels = $requestTypes->keys()->toArray();
        $data = $requestTypes->values()->toArray();

        $year = now()->year;
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

        return [
            'associations' => $associations,
            'userAssociations' => $userAssociations,
            'adminAssociations' => $adminAssociations,
            'pendingRequestsCount' => $pendingRequestsCount,
            'requests' => $requests,
            'notifications' => $notifications,
            'allNotifications' => $allNotifications,
            'activities' => $activities,
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
        ];
    }
}
