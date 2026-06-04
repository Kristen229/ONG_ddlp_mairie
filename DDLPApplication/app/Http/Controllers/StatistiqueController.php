<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Activity;
use App\Models\Requests;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;

use Barryvdh\DomPDF\Facade\Pdf;

class StatistiqueController extends Controller
{
    public function getStats(\App\Services\StatsService $statsService)
    {
        $data = $statsService->getAdminDashboardData();
        return view('admin', $data);
    }
    
    public function download($id)
    {
        $user = User::findOrFail($id);

        $pdf = Pdf::loadView('pdf.association', compact('user'));

        return $pdf->download('Association_' . $user->nom . '.pdf');
    }
}
