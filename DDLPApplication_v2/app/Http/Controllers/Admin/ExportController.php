<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\User;
use App\Models\Activity;
use App\Services\StatsService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function downloadAssociationPdf($id)
    {
        $user = User::with('domaines')->findOrFail($id);
        AuditLog::record('export.association_pdf', "Export PDF association: {$user->name}", ['user_id' => $user->id]);
        $pdf = Pdf::loadView('pdf.association', compact('user'));
        return $pdf->download("association_{$user->name}.pdf");
    }

    public function exportByDomaine(Request $request)
    {
        $domaine = $request->query('domaine', 'all');
        $users = $domaine === 'all'
            ? User::with('domaines')->get()
            : User::whereHas('domaines', fn ($query) => $query->where('nom', $domaine))->with('domaines')->get();

        AuditLog::record('export.associations_by_domaine_pdf', "Export PDF associations par domaine: {$domaine}", ['domaine' => $domaine, 'count' => $users->count()]);

        $pdf = Pdf::loadView('pdf.export-domaine', compact('users', 'domaine'));
        return $pdf->download("associations_{$domaine}.pdf");
    }

    public function exportStatsPdf(Request $request)
    {
        abort_unless(auth('admin')->user()?->is_super_admin, 403);

        $statsService = app(StatsService::class);
        $data = $statsService->getAdminDashboardData();
        $data['chartRep'] = $request->input('chartRep');
        $data['chartIns'] = $request->input('chartIns');

        AuditLog::record('export.dashboard_pdf', 'Export PDF du tableau de bord');

        $pdf = Pdf::loadView('pdf.stats', $data);
        return $pdf->download('statistiques.pdf');
    }

    public function downloadDocumentationPdf()
    {
        abort_unless(auth('admin')->check(), 403);
        AuditLog::record('export.documentation_pdf', 'Export PDF de la documentation technique');
        $pdf = Pdf::loadView('pdf.documentation');
        return $pdf->download('documentation_technique_ddlp.pdf');
    }
}
