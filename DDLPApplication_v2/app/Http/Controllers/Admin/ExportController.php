<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Activity;
use App\Services\StatsService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function downloadAssociationPdf($id)
    {
        $user = User::findOrFail($id);
        $pdf = Pdf::loadView('pdf.association', compact('user'));
        return $pdf->download("association_{$user->name}.pdf");
    }

    public function exportByDomaine(Request $request)
    {
        $domaine = $request->query('domaine', 'all');
        $users = $domaine === 'all'
            ? User::all()
            : User::where('domaine', 'like', "%{$domaine}%")->get();

        $pdf = Pdf::loadView('pdf.export-domaine', compact('users', 'domaine'));
        return $pdf->download("associations_{$domaine}.pdf");
    }

    public function exportStatsPdf(Request $request)
    {
        $statsService = app(StatsService::class);
        $data = $statsService->getAdminDashboardData();
        $data['chartImage'] = $request->input('chartImage');

        $pdf = Pdf::loadView('pdf.stats', $data);
        return $pdf->download('statistiques.pdf');
    }
}
