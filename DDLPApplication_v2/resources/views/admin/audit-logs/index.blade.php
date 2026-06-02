@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
        <h1 class="text-2xl font-black text-slate-900">Logs d'audit</h1>
        <p class="text-sm text-slate-500 mt-1">Suivi des actions importantes sur la plateforme.</p>
    </div>

    <form method="GET" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-4 grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Du</label>
            <input type="date" name="from" value="{{ request('from') }}" class="w-full rounded-xl border-gray-200 bg-gray-50">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Au</label>
            <input type="date" name="to" value="{{ request('to') }}" class="w-full rounded-xl border-gray-200 bg-gray-50">
        </div>
        <div>
            <label class="block text-xs font-bold uppercase text-slate-500 mb-1">Action</label>
            <input type="text" name="action" value="{{ request('action') }}" class="w-full rounded-xl border-gray-200 bg-gray-50" placeholder="approve, export...">
        </div>
        <div class="flex gap-2">
            <button type="submit" class="flex-1 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-bold text-white hover:bg-slate-800">Filtrer</button>
            <a href="{{ route('admin.audit-logs.export', array_merge(request()->query(), ['format' => 'csv'])) }}" class="rounded-xl border border-blue-100 bg-blue-50 px-4 py-2.5 text-sm font-bold text-blue-700 hover:bg-blue-100">CSV</a>
            <a href="{{ route('admin.audit-logs.export', array_merge(request()->query(), ['format' => 'excel'])) }}" class="rounded-xl border border-emerald-100 bg-emerald-50 px-4 py-2.5 text-sm font-bold text-emerald-700 hover:bg-emerald-100">Excel</a>
        </div>
    </form>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-left text-xs font-black uppercase text-slate-500">Date</th>
                        <th class="px-5 py-3 text-left text-xs font-black uppercase text-slate-500">Acteur</th>
                        <th class="px-5 py-3 text-left text-xs font-black uppercase text-slate-500">Action</th>
                        <th class="px-5 py-3 text-left text-xs font-black uppercase text-slate-500">Description</th>
                        <th class="px-5 py-3 text-left text-xs font-black uppercase text-slate-500">IP</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50">
                            <td class="px-5 py-4 text-sm text-slate-500 whitespace-nowrap">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-4 text-sm font-bold text-slate-800">{{ $log->actor_name ?: 'Système' }}<br><span class="text-xs text-slate-400">{{ $log->actor_type }}</span></td>
                            <td class="px-5 py-4 text-sm font-black text-blue-700">{{ $log->action }}</td>
                            <td class="px-5 py-4 text-sm text-slate-600">{{ $log->description }}</td>
                            <td class="px-5 py-4 text-sm text-slate-500">{{ $log->ip_address }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="px-5 py-10 text-center text-slate-500">Aucun log trouvé.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $logs->links() }}
</div>
@endsection
