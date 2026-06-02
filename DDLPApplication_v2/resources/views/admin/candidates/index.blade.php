@extends('layouts.admin')

@section('content')
<div class="space-y-6" x-data="{ showRejectModal: false, selectedCandidate: null }">
    <!-- En-tête -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center bg-white p-4 lg:p-6 rounded-2xl shadow-sm border border-gray-200 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Candidatures en attente</h1>
            <p class="text-sm text-slate-500">Examinez et validez les inscriptions des nouvelles associations et ONG.</p>
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

    <!-- Liste des candidatures -->
    @forelse($pendingUsers as $candidate)
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <!-- Header candidature -->
        <div class="bg-slate-50 border-b border-gray-200 p-6 flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
            <div class="flex items-center gap-4">
                <div class="h-14 w-14 rounded-2xl bg-blue-50 text-blue-700 flex items-center justify-center text-xl font-black border border-blue-100 shrink-0">
                    {{ substr($candidate->name, 0, 1) }}
                </div>
                <div>
                    <h2 class="text-xl font-black text-slate-800">{{ $candidate->name }}</h2>
                    <div class="flex flex-wrap items-center gap-3 mt-1">
                        <span class="text-xs font-bold uppercase tracking-wider px-2.5 py-1 rounded-lg {{ $candidate->groupe?->value === 'ong' ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'bg-purple-50 text-purple-700 border border-purple-100' }}">
                            {{ $candidate->groupe?->value ?? 'Non spécifié' }}
                        </span>
                        <span class="text-sm text-slate-500">{{ $candidate->email }}</span>
                        <span class="text-xs text-slate-400">Soumis {{ $candidate->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <form method="POST" action="{{ route('admin.candidates.approve', $candidate->id) }}">
                    @csrf
                    <button type="submit" class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl transition-colors shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Approuver
                    </button>
                </form>
                <button type="button" 
                        @click="selectedCandidate = { id: {{ $candidate->id }}, name: '{{ addslashes($candidate->name) }}' }; showRejectModal = true;"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-sm font-bold rounded-xl transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    Rejeter
                </button>
            </div>
        </div>

        <!-- Détails du dossier -->
        <div class="p-6 space-y-6">
            <!-- Informations générales -->
            <div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Informations générales
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <span class="text-xs font-bold text-slate-500 uppercase">Dénomination</span>
                        <p class="text-slate-800 font-bold mt-1">{{ $candidate->denomination ?: 'Non spécifié' }}</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <span class="text-xs font-bold text-slate-500 uppercase">Domaine</span>
                        <p class="text-slate-800 font-bold mt-1">{{ is_array($candidate->domaine) ? implode(', ', $candidate->domaine) : $candidate->domaine }}</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <span class="text-xs font-bold text-slate-500 uppercase">Date de création</span>
                        <p class="text-slate-800 font-bold mt-1">{{ $candidate->date ? $candidate->date->format('d/m/Y') : 'Non spécifié' }}</p>
                    </div>
                </div>
            </div>

            <!-- Objectifs -->
            <div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Objectifs déclarés
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    <div class="bg-blue-50/50 p-3 rounded-xl border border-blue-100 text-sm text-blue-800">1. {{ $candidate->objectif1 }}</div>
                    <div class="bg-blue-50/50 p-3 rounded-xl border border-blue-100 text-sm text-blue-800">2. {{ $candidate->objectif2 }}</div>
                    <div class="bg-blue-50/50 p-3 rounded-xl border border-blue-100 text-sm text-blue-800">3. {{ $candidate->objectif3 }}</div>
                </div>
            </div>

            <!-- Coordonnées -->
            <div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    Coordonnées
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <span class="text-xs font-bold text-slate-500 uppercase">Siège</span>
                        <p class="text-slate-800 font-bold mt-1">{{ $candidate->siege }}</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <span class="text-xs font-bold text-slate-500 uppercase">Email</span>
                        <p class="text-slate-800 font-bold mt-1">{{ $candidate->email }}</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <span class="text-xs font-bold text-slate-500 uppercase">Téléphone 1</span>
                        <p class="text-slate-800 font-bold mt-1">{{ $candidate->number1 }}</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                        <span class="text-xs font-bold text-slate-500 uppercase">Téléphone 2</span>
                        <p class="text-slate-800 font-bold mt-1">{{ $candidate->number2 }}</p>
                    </div>
                </div>
            </div>

            <!-- Bureau exécutif -->
            <div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    Bureau exécutif
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                        <span class="text-xs font-bold text-slate-500 uppercase">Président</span>
                        <p class="text-slate-800 font-bold mt-1">{{ $candidate->name_president }} {{ $candidate->last_name_president }}</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                        <span class="text-xs font-bold text-slate-500 uppercase">Vice-Président</span>
                        <p class="text-slate-800 font-bold mt-1">{{ $candidate->name_vice_president }} {{ $candidate->last_name_vice_president }}</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                        <span class="text-xs font-bold text-slate-500 uppercase">Secrétaire Général</span>
                        <p class="text-slate-800 font-bold mt-1">{{ $candidate->name_secretaire_general }} {{ $candidate->last_name_secretaire_general }}</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-center">
                        <span class="text-xs font-bold text-slate-500 uppercase">Trésorier Général</span>
                        <p class="text-slate-800 font-bold mt-1">{{ $candidate->name_tresorier_general }} {{ $candidate->last_name_tresorier_general }}</p>
                    </div>
                </div>
            </div>

            <!-- Pièces jointes -->
            @if($candidate->attachment && $candidate->attachment !== 'Non spécifié')
            <div>
                <h3 class="text-sm font-black text-slate-800 uppercase tracking-wider mb-3 flex items-center gap-2">
                    <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                    Pièces jointes
                </h3>
                <div class="flex flex-wrap gap-3">
                    @if($candidate->attachment && $candidate->attachment !== 'Non spécifié')
                        <a href="{{ asset('storage/'.$candidate->attachment) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-xl text-sm font-bold hover:bg-blue-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Logo
                        </a>
                    @endif
                    @if($candidate->attachment5 && $candidate->attachment5 !== 'Non spécifié')
                        <a href="{{ asset('storage/'.$candidate->attachment5) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-700 border border-blue-200 rounded-xl text-sm font-bold hover:bg-blue-100 transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            Couverture
                        </a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>
    @empty
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 py-16 flex flex-col items-center justify-center text-slate-400">
        <svg class="h-16 w-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <p class="font-bold text-lg text-slate-600">Aucune candidature en attente</p>
        <p class="text-sm">Toutes les inscriptions ont été traitées.</p>
    </div>
    @endforelse

    <!-- Modale de Rejet -->
    <div x-show="showRejectModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
            <div x-show="showRejectModal" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click.stop="showRejectModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
            <div x-show="showRejectModal" @click.stop
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 class="relative inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200">
                <form :action="`/admin/candidates/${selectedCandidate?.id}/reject`" method="POST">
                    @csrf
                    <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
                        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                            <div class="w-12 h-12 rounded-full bg-rose-50 flex items-center justify-center text-rose-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">Rejeter la candidature</h3>
                        </div>
                        <div class="space-y-4">
                            <p class="text-sm text-slate-600">Vous êtes sur le point de rejeter la candidature de <strong class="text-slate-900" x-text="selectedCandidate?.name"></strong>. Le compte sera supprimé et un email de notification sera envoyé.</p>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Motif du rejet <span class="text-red-500">*</span></label>
                                <textarea name="motif" rows="3" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-rose-500 focus:border-rose-500 transition-colors" placeholder="Veuillez justifier ce rejet..."></textarea>
                            </div>
                            <p class="text-xs text-rose-600 font-medium">Ce motif sera envoyé par email à l'association.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:px-8 border-t border-gray-100 flex justify-end gap-3">
                        <button type="button" @click="showRejectModal = false" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">Annuler</button>
                        <button type="submit" class="px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl shadow-md transition-colors">Confirmer le rejet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
