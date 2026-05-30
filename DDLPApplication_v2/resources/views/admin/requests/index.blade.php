@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- En-tête -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center bg-white p-4 lg:p-6 rounded-2xl shadow-sm border border-gray-200 gap-4">
        <div>
            <div class="flex items-center gap-3">
                <h1 class="text-2xl font-black text-slate-800">Courriers & Demandes</h1>
                @if($pendingRequestsCount > 0)
                <span class="bg-red-100 text-red-700 text-xs font-black px-2.5 py-0.5 rounded-full border border-red-200">{{ $pendingRequestsCount }} en attente</span>
                @endif
            </div>
            <p class="text-sm text-slate-500 mt-1">Gérez les correspondances et demandes d'accompagnement envoyées par les structures.</p>
        </div>
    </div>

    <!-- Tableau -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Auteur</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Objet de la demande</th>
                        <th class="px-6 py-4 text-center text-xs font-black text-slate-500 uppercase tracking-wider">Document lié</th>
                        <th class="px-6 py-4 text-center text-xs font-black text-slate-500 uppercase tracking-wider">Statut</th>
                        <th class="px-6 py-4 text-right text-xs font-black text-slate-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($requests as $req)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-bold text-lg border border-indigo-100">
                                    {{ substr($req->user->name ?? 'A', 0, 1) }}
                                </div>
                                <div class="w-32 xl:w-48">
                                    <p class="text-sm font-bold text-slate-900 truncate" title="{{ $req->user->name ?? 'ONG Inconnue' }}">{{ $req->user->name ?? 'ONG Inconnue' }}</p>
                                    <p class="text-xs text-slate-500">{{ $req->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-slate-700 max-w-xs truncate" title="{{ $req->objet }}">
                            {{ $req->objet }}
                        </td>
                        <td class="px-6 py-4 text-center whitespace-nowrap">
                            @if($req->attachment)
                                <a href="{{ asset('storage/'.$req->attachment) }}" target="_blank" class="inline-flex items-center justify-center bg-blue-50 text-blue-700 hover:bg-blue-100 px-3 py-1.5 rounded-lg text-sm font-bold border border-blue-100 transition-colors gap-2">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                                    Ouvrir PDF
                                </a>
                            @else
                                <span class="text-xs text-slate-400 font-medium">Aucun doc</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            @if($req->statut === \App\Enums\RequestStatus::PENDING)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-black rounded-lg bg-amber-100 text-amber-800 border border-amber-200">En Attente</span>
                            @elseif($req->statut === \App\Enums\RequestStatus::APPROVED)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-black rounded-lg bg-emerald-100 text-emerald-800 border border-emerald-200">Approuvé</span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-black rounded-lg bg-rose-100 text-rose-800 border border-rose-200">Rejeté</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            @if($req->statut === \App\Enums\RequestStatus::PENDING)
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('requests.show', $req->id) }}" class="inline-flex items-center gap-2 bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded-lg transition-colors text-sm font-bold shadow-md">
                                        Traiter
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                </div>
                            @else
                                <a href="{{ route('requests.show', $req->id) }}" class="text-xs font-bold text-teal-600 hover:underline">Voir détails</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-12 text-center text-slate-500 font-medium">Aucun courrier disponible pour le moment.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($requests->hasPages())
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $requests->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
