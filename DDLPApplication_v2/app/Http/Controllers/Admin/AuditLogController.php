<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = $this->filteredQuery($request);
        $logs = $query->latest()->paginate(30)->appends($request->query());

        return view('admin.audit-logs.index', compact('logs'));
    }

    public function export(Request $request): StreamedResponse
    {
        $format = $request->query('format', 'csv') === 'excel' ? 'excel' : 'csv';
        $extension = $format === 'excel' ? 'xls' : 'csv';
        $contentType = $format === 'excel' ? 'application/vnd.ms-excel' : 'text/csv';
        $filename = 'audit_logs_' . now()->format('Ymd_His') . '.' . $extension;

        AuditLog::record('audit_logs.export', "Export des logs d'audit au format {$extension}");

        return response()->streamDownload(function () use ($request) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Date', 'Acteur', 'Type', 'Action', 'Description', 'IP']);

            $this->filteredQuery($request)->orderByDesc('created_at')->chunk(200, function ($logs) use ($handle) {
                foreach ($logs as $log) {
                    fputcsv($handle, [
                        $log->created_at->format('d/m/Y H:i:s'),
                        $log->actor_name,
                        $log->actor_type,
                        $log->action,
                        $log->description,
                        $log->ip_address,
                    ]);
                }
            });

            fclose($handle);
        }, $filename, ['Content-Type' => $contentType]);
    }

    private function filteredQuery(Request $request)
    {
        return AuditLog::query()
            ->when($request->filled('from'), fn ($query) => $query->whereDate('created_at', '>=', $request->from))
            ->when($request->filled('to'), fn ($query) => $query->whereDate('created_at', '<=', $request->to))
            ->when($request->filled('action'), fn ($query) => $query->where('action', 'like', '%' . $request->action . '%'));
    }
}
