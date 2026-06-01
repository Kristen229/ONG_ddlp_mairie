@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center bg-white p-4 lg:p-6 rounded-2xl shadow-sm border border-gray-200 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Candidatures en attente</h1>
            <p class="text-sm text-slate-500">Ouvrez chaque dossier pour examiner les informations, objectifs, membres et documents.</p>
        </div>
        @if($pendingUsers->count() > 0)
            <span class="bg-amber-100 text-amber-800 text-sm font-black px-4 py-2 rounded-xl border border-amber-200">{{ $pendingUsers->count() }} en attente</span>
        @endif
    </div>

    @if(session('success'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-6 py-4 rounded-2xl font-medium">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-2xl font-medium">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        @if($pendingUsers->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-slate-500">Structure</th>
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-slate-500">Type</th>
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-slate-500">Domaines</th>
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-slate-500">Contact</th>
                            <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider text-slate-500">Soumission</th>
                            <th class="px-6 py-4 text-right text-xs font-black uppercase tracking-wider text-slate-500">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white">
                        @foreach($pendingUsers as $candidate)
                            <tr class="hover:bg-slate-50/70 transition-colors">
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-12 rounded-xl bg-teal-50 text-teal-700 flex items-center justify-center text-lg font-black border border-teal-100 shrink-0">
                                            {{ strtoupper(substr($candidate->name, 0, 1)) }}
                                        </div>
                                        <div class="min-w-0">
                                            <a href="{{ route('admin.candidates.show', $candidate->id) }}" class="font-black text-slate-800 hover:text-teal-700 transition-colors">
                                                {{ $candidate->name }}
                                            </a>
                                            <p class="text-xs text-slate-500 mt-1 truncate max-w-xs">{{ $candidate->denomination ?: 'Sigle non renseigne' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <span class="text-xs font-black uppercase tracking-wider px-2.5 py-1 rounded-lg {{ $candidate->groupe?->value === 'ong' ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'bg-emerald-50 text-emerald-700 border border-emerald-100' }}">
                                        {{ $candidate->groupe?->value ?? 'Non specifie' }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-sm font-medium text-slate-700 max-w-md line-clamp-2">{{ $candidate->domaine ?: 'Non renseigne' }}</p>
                                </td>
                                <td class="px-6 py-5">
                                    <p class="text-sm font-bold text-slate-800">{{ $candidate->email }}</p>
                                    <p class="text-xs text-slate-500 mt-1">{{ $candidate->number1 ?: 'Telephone non renseigne' }}</p>
                                </td>
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <p class="text-sm font-bold text-slate-700">{{ $candidate->created_at->format('d/m/Y') }}</p>
                                    <p class="text-xs text-slate-500 mt-1">{{ $candidate->created_at->diffForHumans() }}</p>
                                </td>
                                <td class="px-6 py-5 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.candidates.show', $candidate->id) }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold rounded-xl shadow-sm transition-colors">
                                        Examiner
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-16 flex flex-col items-center justify-center text-slate-400">
                <svg class="h-16 w-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <p class="font-bold text-lg text-slate-600">Aucune candidature en attente</p>
                <p class="text-sm">Toutes les inscriptions ont ete traitees.</p>
            </div>
        @endif
    </div>
</div>
@endsection
