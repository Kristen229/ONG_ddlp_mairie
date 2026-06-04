<?php

namespace App\Services;

use App\Models\User;
use App\Models\Domaine;
use App\Models\AssociationRequest;
use App\Models\Activity;
use App\Models\Notification;
use App\Models\Review;
use App\Enums\RequestStatus;
use Illuminate\Support\Facades\DB;

class StatsService
{
    public function getAdminDashboardData(?string $search = null): array
    {
        $year = now()->year;

        $userCount = User::where('is_approved', true)->count();
        $ongCount = User::where('groupe', 'ong')->where('is_approved', true)->count();
        $associationCount = User::where('groupe', 'association')->where('is_approved', true)->count();

        $requestCount = AssociationRequest::count();
        $requestaCount = AssociationRequest::where('statut', RequestStatus::APPROVED)->count();
        $requestrCount = AssociationRequest::where('statut', RequestStatus::REJECTED)->count();
        $requesteCount = AssociationRequest::where('statut', RequestStatus::PENDING)->count();
        $requesttCount = $requestaCount + $requestrCount;

        $activityCount = Activity::count();
        $activitysCount = Activity::whereHas('user', fn($q) => $q->where('groupe', 'ong')->where('is_approved', true))->count();
        $activityseCount = Activity::whereHas('user', fn($q) => $q->where('groupe', 'association')->where('is_approved', true))->count();

        $reviewCount = Review::count();

        $countsByMonth = $this->monthly('users', ['is_approved' => true], $year);
        $countsAssociations = $this->monthly('users', ['groupe' => 'association', 'is_approved' => true], $year);
        $countsOng = $this->monthly('users', ['groupe' => 'ong', 'is_approved' => true], $year);
        $requestCounts = $this->monthly('association_requests', null, $year);

        $requestTypes = DB::table('association_requests')
            ->select('type', DB::raw('COUNT(*) as count'))
            ->whereYear('created_at', $year)->groupBy('type')->pluck('count', 'type');
        $labels = $requestTypes->keys()->toArray();
        $data = $requestTypes->values()->toArray();

        $statsTotal = []; $statsAsso = []; $statsONG = [];
        for ($m = 1; $m <= 12; $m++) {
            $statsTotal[] = Activity::whereYear('created_at', $year)->whereMonth('created_at', $m)->count();
            $statsAsso[] = Activity::whereYear('created_at', $year)->whereMonth('created_at', $m)->whereHas('user', fn($q) => $q->where('groupe', 'association')->where('is_approved', true))->count();
            $statsONG[] = Activity::whereYear('created_at', $year)->whereMonth('created_at', $m)->whereHas('user', fn($q) => $q->where('groupe', 'ong')->where('is_approved', true))->count();
        }

        $lastUsers = User::where('is_approved', true)->with('domaines')->latest()->take(8)->get();
        $associations = User::where('is_approved', true)->with('domaines')->get();
        $userAssociations = User::where('created_by', 'user')->where('is_approved', true)->with('domaines')->get();
        $adminAssociations = User::where('created_by', 'admin')->where('is_approved', true)->with('domaines')->get();
        $requests = AssociationRequest::with('user')->get();
        $pendingRequestsCount = AssociationRequest::countPending();
        $notifications = Notification::latest()->take(5)->get();
        $allNotifications = Notification::latest()->skip(5)->take(100)->get();
        $activities = Activity::when($search, fn($q, $s) => $q->whereHas('user', fn($u) => $u->where('name', 'like', "%{$s}%")->where('is_approved', true)))->with('user.domaines')->get();
        $users = User::where('is_approved', true)->with('domaines')->paginate(10);
        $pendingCandidatesCount = User::where('is_approved', false)->count();

        // NOUVELLES STATISTIQUES AVANCÉES (PHASE 6)
        
        // Top 5 Domaines d'intervention
        $topDomaines = Domaine::whereHas('users', fn ($query) => $query->where('is_approved', true))
            ->withCount(['users as total' => fn ($query) => $query->where('is_approved', true)])
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Répartition Géographique (par arrondissement)
        $repartitionGeo = User::where('is_approved', true)
            ->whereNotNull('arrondissement')
            ->groupBy('arrondissement')
            ->select('arrondissement', DB::raw('count(*) as total'))
            ->orderByDesc('total')
            ->get();

        // Bénéficiaires touchés (total annuel)
        $totalBeneficiaries = Activity::whereYear('created_at', $year)
            ->where('is_visible', true)
            ->sum('beneficiaries_actual');

        // Taux de résolution des courriers
        $resolvedRequests = AssociationRequest::whereIn('statut', [RequestStatus::APPROVED, RequestStatus::REJECTED])->count();
        $totalRequests = AssociationRequest::count();
        $resolutionRate = $totalRequests > 0 ? round(($resolvedRequests / $totalRequests) * 100) : 0;

        return compact(
            'userCount', 'ongCount', 'associationCount',
            'requestCount', 'requestaCount', 'requestrCount', 'requesteCount', 'requesttCount',
            'activityCount', 'activitysCount', 'activityseCount', 'reviewCount',
            'countsByMonth', 'countsAssociations', 'countsOng', 'requestCounts',
            'labels', 'data', 'statsTotal', 'statsAsso', 'statsONG',
            'lastUsers', 'associations', 'userAssociations', 'adminAssociations',
            'requests', 'pendingRequestsCount', 'notifications', 'allNotifications',
            'activities', 'users', 'pendingCandidatesCount',
            'topDomaines', 'repartitionGeo', 'totalBeneficiaries', 'resolvedRequests', 'totalRequests', 'resolutionRate'
        );
    }

    private function monthly(string $table, ?array $where, int $year): array
    {
        $query = DB::table($table)->select(DB::raw('MONTH(created_at) as month'), DB::raw('COUNT(*) as count'))->whereYear('created_at', $year);
        if ($where) { foreach ($where as $col => $val) { $query->where($col, $val); } }
        $monthly = $query->groupBy('month')->orderBy('month')->pluck('count', 'month');
        $counts = [];
        for ($m = 1; $m <= 12; $m++) { $counts[] = $monthly->get($m, 0); }
        return $counts;
    }
}
