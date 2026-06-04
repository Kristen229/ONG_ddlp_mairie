<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StatsService;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(protected StatsService $statsService) {}

    public function index(Request $request)
    {
        $data = $this->statsService->getAdminDashboardData($request->search);
        return view('admin.dashboard', $data);
    }
}
