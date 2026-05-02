@extends('layouts.admin')

@section('content')
<div class="space-y-6" x-data="{ showModal: false, selectedAct: null }">
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
                
                <p class="text-sm text-slate-600 line-clamp-3 mb-4 flex-grow">{{ $act->description }}</p>
                
                <button type="button" 
                        data-activity="{{ json_encode(['titre' => $act->titre, 'description' => $act->description, 'lieu' => $act->lieu, 'date' => $act->date ? $act->date->format('d/m/Y') : null, 'beneficiaries_expected' => $act->beneficiaries_expected, 'budget_expected' => $act->budget_expected, 'created_at' => $act->created_at->format('d/m/Y H:i'), 'user_name' => $act->user->name ?? 'Inconnu']) }}"
                        @click.prevent="selectedAct = JSON.parse($el.dataset.activity); showModal = true;" 
                        class="text-xs font-bold text-teal-600 mb-4 flex items-center gap-1 hover:text-teal-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                    Voir les détails
                </button>
                
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
                    <form method="POST" action="{{ route('activites.warn', $act->id) }}" class="{{ !$act->is_visible ? 'w-auto' : 'w-1/2' }}" onsubmit="return confirm('Êtes-vous sûr de vouloir envoyer un avertissement par email à cette ONG ?');">
                        @csrf 
                        <button type="submit" title="Envoyer un email d'avertissement" class="w-full bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 py-2 rounded-xl text-xs font-black transition-colors flex justify-center items-center gap-1 px-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            @if($act->is_visible) Avertir ONG @endif
                        </button>
                    </form>
                    <form method="POST" action="{{ route('activites.destroy', $act->id) }}" onsubmit="return confirm('Retirer définitivement cette activité ?');" class="{{ !$act->is_visible ? 'w-auto' : 'w-1/2' }}">
                        @csrf @method('DELETE')
                        <button type="submit" title="Supprimer" class="w-full bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 py-2 rounded-xl text-xs font-black transition-colors flex justify-center items-center gap-1 px-2">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            @if($act->is_visible) Del @endif
                        </button>
                    </form>
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
    <div x-show="showModal" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <!-- Overlay -->
            <div x-show="showModal" x-transition.opacity class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <!-- Modal Panel -->
            <div x-show="showModal" 
                 x-transition:enter="ease-out duration-300" 
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave="ease-in duration-200" 
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" 
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" 
                 class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-2xl w-full border border-gray-100">
                
                <div class="bg-white px-4 pt-5 pb-4 sm:p-8">
                    <div class="flex justify-between items-start mb-6">
                        <h3 class="text-2xl font-bold text-gray-900" x-text="selectedAct?.titre"></h3>
                        <button @click="showModal = false" class="text-gray-400 hover:text-gray-500 focus:outline-none bg-gray-100 hover:bg-gray-200 p-2 rounded-full transition-colors">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-xs text-slate-500 font-bold uppercase mb-1">Association / ONG</p>
                            <p class="text-slate-800 font-medium" x-text="selectedAct?.user_name"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-xs text-slate-500 font-bold uppercase mb-1">Date soumission</p>
                            <p class="text-slate-800 font-medium" x-text="selectedAct?.created_at"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-xs text-slate-500 font-bold uppercase mb-1">Lieu prévu</p>
                            <p class="text-slate-800 font-medium" x-text="selectedAct?.lieu"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-xs text-slate-500 font-bold uppercase mb-1">Date prévue</p>
                            <p class="text-slate-800 font-medium" x-text="selectedAct?.date"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-xs text-slate-500 font-bold uppercase mb-1">Budget prévisionnel</p>
                            <p class="text-slate-800 font-medium font-mono" x-text="(selectedAct?.budget_expected || 0) + ' XOF'"></p>
                        </div>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100">
                            <p class="text-xs text-slate-500 font-bold uppercase mb-1">Bénéficiaires ciblés</p>
                            <p class="text-slate-800 font-medium" x-text="selectedAct?.beneficiaries_expected + ' personnes'"></p>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs text-slate-500 font-bold uppercase mb-2">Description de l'activité</p>
                        <div class="bg-gray-50 p-5 rounded-xl border border-gray-100 text-gray-700 text-sm leading-relaxed whitespace-pre-wrap" x-text="selectedAct?.description"></div>
                    </div>
                </div>
                
                <div class="bg-gray-50 px-4 py-4 sm:px-8 flex justify-end">
                    <button type="button" @click="showModal = false" class="inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-6 py-2.5 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none transition-colors">
                        Fermer
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
