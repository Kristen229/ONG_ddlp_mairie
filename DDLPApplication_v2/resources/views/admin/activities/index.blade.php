@extends('layouts.admin')

@section('content')
<div class="space-y-6">
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
                <div class="absolute top-3 left-3 flex gap-2">
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
                
                <!-- Actions -->
                <div class="pt-4 border-t border-gray-100 flex justify-between gap-2 mt-auto">
                    <form method="POST" action="{{ route('activites.warn', $act->id) }}" class="w-1/2">
                        @csrf 
                        <button type="submit" title="Envoyer avertissement" class="w-full bg-amber-50 hover:bg-amber-100 text-amber-700 border border-amber-200 py-2 rounded-xl text-xs font-black transition-colors flex justify-center items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                            Avis
                        </button>
                    </form>
                    <form method="POST" action="{{ route('activites.destroy', $act->id) }}" onsubmit="return confirm('Retirer définitivement cette activité ?');" class="w-1/2">
                        @csrf @method('DELETE')
                        <button type="submit" title="Supprimer" class="w-full bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 py-2 rounded-xl text-xs font-black transition-colors flex justify-center items-center gap-1">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Del
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
</div>
@endsection
