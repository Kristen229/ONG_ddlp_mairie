@extends('layouts.admin')

@section('content')
<div class="space-y-6" x-data="{ 
    showModal: false, 
    showWarningModal: false, 
    showDeleteModal: false, 
    selectedAct: null 
}">
    <!-- En-tête -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center bg-white p-4 lg:p-6 rounded-2xl shadow-sm border border-gray-200 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Galerie des Activités</h1>
            <p class="text-sm text-slate-500">Examinez le rapport photographique et l'historique des actions de terrain.</p>
        </div>
    </div>

    <!-- Grille des activités -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($activities as $act)
        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-lg transition-shadow duration-300 relative group flex flex-col h-full">
            <!-- Visuel -->
            <div class="h-56 bg-slate-100 relative w-full overflow-hidden shrink-0">
                <img src="{{ asset('storage/'.$act->attachment) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <!-- Badges Status (Evaluation) sur l'image -->
                <div class="absolute top-3 left-3 flex flex-col gap-2">
                    @if(!$act->is_visible)
                        <span class="bg-blue-600/90 backdrop-blur-sm text-white text-xs font-black px-2.5 py-1 rounded-lg shadow-sm">À valider</span>
                    @endif
                    @if($act->evaluation_status === \App\Enums\EvaluationStatus::COMPLIANT)
                        <span class="bg-emerald-500/90 backdrop-blur-sm text-white text-xs font-black px-2.5 py-1 rounded-lg shadow-sm">Conforme ({{ $act->score }}%)</span>
                    @elseif($act->evaluation_status === \App\Enums\EvaluationStatus::WARNING)
                        <span class="bg-amber-500/90 backdrop-blur-sm text-white text-xs font-black px-2.5 py-1 rounded-lg shadow-sm">À suivre ({{ $act->score }}%)</span>
                    @elseif($act->evaluation_status === \App\Enums\EvaluationStatus::NON_COMPLIANT)
                        <span class="bg-rose-500/90 backdrop-blur-sm text-white text-xs font-black px-2.5 py-1 rounded-lg shadow-sm">Non Conforme</span>
                    @else
                        <span class="bg-slate-900/80 backdrop-blur-sm text-white text-xs font-black px-2.5 py-1 rounded-lg shadow-sm">Non évalué</span>
                    @endif
                </div>
            </div>
            
            <div class="p-5 flex-grow flex flex-col">
                <div class="flex items-center gap-3 mb-3">
                    <div class="h-8 w-8 rounded-lg bg-teal-50 text-teal-700 flex items-center justify-center text-xs font-black shrink-0 border border-teal-100">
                        {{ substr($act->user->name ?? 'A', 0, 1) }}
                    </div>
                    <p class="text-xs font-black text-slate-600 truncate w-full uppercase tracking-wider">{{ $act->user->name ?? 'Inconnue' }}</p>
                </div>
                <h3 class="font-black text-slate-800 text-lg leading-tight mb-2 line-clamp-2" title="{{ $act->titre }}">{{ $act->titre }}</h3>
                
                <div class="flex items-center gap-4 text-xs font-medium text-slate-500 mb-3">
                    <div class="flex items-center gap-1">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ $act->created_at->format('d M. Y') }}
                    </div>
                    <div class="flex items-center gap-1 truncate">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span class="truncate">{{ $act->lieu }}</span>
                    </div>
                </div>
                
                <div class="mt-auto">
                    <button type="button" 
                            data-activity="{{ json_encode(['titre' => $act->titre, 'description' => $act->description, 'lieu' => $act->lieu, 'date' => $act->date ? $act->date->format('d/m/Y') : null, 'beneficiaries_expected' => $act->beneficiaries_expected, 'budget_expected' => $act->budget_expected, 'created_at' => $act->created_at->format('d/m/Y H:i'), 'user_name' => $act->user->name ?? 'Inconnu', 'image' => asset('storage/'.$act->attachment)]) }}"
                            @click.prevent.stop="selectedAct = JSON.parse($el.dataset.activity); showModal = true;" 
                            class="w-full text-sm font-bold bg-slate-100 hover:bg-slate-200 text-slate-700 py-2.5 rounded-xl transition-colors flex justify-center items-center gap-2 mb-4">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        Voir les détails
                    </button>
                </div>
                
                <!-- Actions -->
                <div class="pt-4 border-t border-gray-100 flex justify-between gap-2 mt-auto">
                    @if(!$act->is_visible)
                    <form method="POST" action="{{ route('activites.publish', $act->id) }}" class="flex-grow">
                        @csrf 
                        <button type="submit" title="Publier l'activité" class="w-full bg-blue-50 hover:bg-blue-100 text-blue-700 border border-blue-200 py-2 rounded-xl text-xs font-black transition-colors flex justify-center items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Publier
                        </button>
                    </form>
                    @endif
                    <button type="button" title="Envoyer un avertissement" 
                            @click.prevent.stop="selectedAct = JSON.parse($el.closest('.mt-auto').previousElementSibling.querySelector('button[data-activity]').dataset.activity); selectedAct.id = {{ $act->id }}; showWarningModal = true;" 
                            class="w-10 h-10 bg-amber-50 hover:bg-amber-100 text-amber-600 border border-amber-200 rounded-xl flex justify-center items-center transition-colors flex-shrink-0">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </button>
                    <button type="button" title="Supprimer" 
                            @click.prevent.stop="selectedAct = JSON.parse($el.closest('.mt-auto').previousElementSibling.querySelector('button[data-activity]').dataset.activity); selectedAct.id = {{ $act->id }}; showDeleteModal = true;" 
                            class="w-full bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 py-2 rounded-xl text-xs font-black transition-colors flex justify-center items-center gap-1 px-2 flex-grow">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        Supprimer
                    </button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-16 flex flex-col items-center justify-center text-slate-400 bg-white rounded-2xl border border-dashed border-gray-300">
            <svg class="h-16 w-16 mb-4 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            <p class="font-medium text-lg text-slate-600">Aucune activité</p>
            <p class="text-sm">Aucune association n'a publié d'activité.</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($activities->hasPages())
    <div class="mt-8">
        {{ $activities->links() }}
    </div>
    @endif

    <!-- Modale de Détails -->
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
            <!-- Overlay -->
            <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click.stop="showModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Panel -->
            <div x-show="showModal" 
                 @click.stop
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="relative inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-3xl w-full border border-slate-200">
                
                <!-- Header Image -->
                <div class="h-64 w-full bg-slate-200 relative">
                    <img :src="selectedAct?.image" class="w-full h-full object-cover" alt="Image de l'activité">
                    <button @click.prevent.stop="showModal = false" class="absolute top-4 right-4 text-white bg-black/40 hover:bg-black/60 backdrop-blur p-2 rounded-full transition-colors">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                    <!-- Gradient overlay -->
                    <div class="absolute bottom-0 inset-x-0 h-32 bg-gradient-to-t from-black/80 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6">
                        <h3 class="text-3xl font-black text-white leading-tight drop-shadow-md" x-text="selectedAct?.titre"></h3>
                    </div>
                </div>

                <div class="bg-white px-6 pt-6 pb-8 sm:px-8">
                    <div class="flex items-center gap-3 mb-8 pb-6 border-b border-slate-100">
                        <div class="h-12 w-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-lg font-black border border-teal-100">
                            <span x-text="(selectedAct?.user_name || 'A').substring(0, 1)"></span>
                        </div>
                        <div>
                            <p class="text-sm font-bold text-slate-500 uppercase tracking-wide">Soumis par</p>
                            <p class="text-lg font-black text-slate-800" x-text="selectedAct?.user_name"></p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 flex flex-col justify-center">
                            <div class="flex items-center gap-2 mb-1 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span class="text-xs font-bold uppercase">Date prévue</span>
                            </div>
                            <p class="text-slate-800 font-bold" x-text="selectedAct?.date"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 flex flex-col justify-center">
                            <div class="flex items-center gap-2 mb-1 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <span class="text-xs font-bold uppercase">Lieu</span>
                            </div>
                            <p class="text-slate-800 font-bold" x-text="selectedAct?.lieu"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 flex flex-col justify-center">
                            <div class="flex items-center gap-2 mb-1 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <span class="text-xs font-bold uppercase">Budget</span>
                            </div>
                            <p class="text-teal-600 font-black font-mono text-lg" x-text="(selectedAct?.budget_expected || 0) + ' XOF'"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100 flex flex-col justify-center">
                            <div class="flex items-center gap-2 mb-1 text-slate-500">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <span class="text-xs font-bold uppercase">Public cible</span>
                            </div>
                            <p class="text-slate-800 font-bold" x-text="selectedAct?.beneficiaries_expected + ' pers.'"></p>
                        </div>
                    </div>

                    <div>
                        <h4 class="text-sm font-black text-slate-800 uppercase tracking-wide mb-3 flex items-center gap-2">
                            <svg class="h-5 w-5 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            Description
                        </h4>
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 text-slate-700 leading-relaxed whitespace-pre-wrap shadow-inner" x-text="selectedAct?.description"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modale d'Avertissement -->
    <div x-show="showWarningModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
            <div x-show="showWarningModal" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click.stop="showWarningModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showWarningModal" 
                 @click.stop
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="relative inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200">
                <form :action="`/admin/activites/${selectedAct?.id}/warn`" method="POST">
                    @csrf
                    <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
                        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                            <div class="w-12 h-12 rounded-full bg-amber-50 flex items-center justify-center text-amber-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">Avertir l'ONG</h3>
                        </div>
                        <div class="space-y-4">
                            <p class="text-sm text-slate-600">Vous êtes sur le point d'envoyer un avertissement concernant l'activité <strong class="text-slate-900" x-text="selectedAct?.titre"></strong> organisée par <strong class="text-slate-900" x-text="selectedAct?.user_name"></strong>.</p>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Motif de l'avertissement <span class="text-red-500">*</span></label>
                                <textarea name="motif" rows="3" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-amber-500 focus:border-amber-500 transition-colors" placeholder="Veuillez expliquer pourquoi cette activité pose problème..."></textarea>
                            </div>
                            <p class="text-xs text-amber-600 font-medium">Ce motif sera envoyé par email à l'ONG et consigné dans ses notifications.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:px-8 border-t border-gray-100 flex justify-end gap-3">
                        <button type="button" @click="showWarningModal = false" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">Annuler</button>
                        <button type="submit" class="px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl shadow-md transition-colors">Envoyer l'avertissement</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modale de Suppression -->
    <div x-show="showDeleteModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
            <div x-show="showDeleteModal" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click.stop="showDeleteModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showDeleteModal" 
                 @click.stop
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="relative inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-slate-200">
                <form :action="`/admin/activites/${selectedAct?.id}`" method="POST">
                    @csrf @method('DELETE')
                    <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
                        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                            <div class="w-12 h-12 rounded-full bg-rose-50 flex items-center justify-center text-rose-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">Retirer l'activité</h3>
                        </div>
                        <div class="space-y-4">
                            <p class="text-sm text-slate-600">Vous êtes sur le point de supprimer définitivement l'activité <strong class="text-slate-900" x-text="selectedAct?.titre"></strong>.</p>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Raison de la suppression <span class="text-red-500">*</span></label>
                                <textarea name="motif" rows="3" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-rose-500 focus:border-rose-500 transition-colors" placeholder="Veuillez justifier cette suppression..."></textarea>
                            </div>
                            <p class="text-xs text-rose-600 font-medium">Ce motif sera envoyé par email à l'ONG et consigné dans ses notifications.</p>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:px-8 border-t border-gray-100 flex justify-end gap-3">
                        <button type="button" @click="showDeleteModal = false" class="px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">Annuler</button>
                        <button type="submit" class="px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl shadow-md transition-colors">Confirmer la suppression</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
@endsection
