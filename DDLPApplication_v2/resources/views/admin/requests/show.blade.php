@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between bg-white p-4 lg:p-6 rounded-2xl shadow-sm border border-gray-200">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.requests.index') }}" class="text-slate-400 hover:text-slate-600 transition-colors">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-black text-slate-800">Détails du Courrier</h1>
                <p class="text-sm text-slate-500 mt-1">Soumis par <span class="font-bold text-slate-700">{{ $assocRequest->user->name ?? 'ONG Inconnue' }}</span> le {{ $assocRequest->created_at->format('d/m/Y à H:i') }}</p>
            </div>
        </div>
        <div>
            @if($assocRequest->statut === \App\Enums\RequestStatus::PENDING)
                <span class="px-4 py-2 inline-flex text-sm leading-5 font-black rounded-xl bg-amber-100 text-amber-800 border border-amber-200">En Attente de Traitement</span>
            @elseif($assocRequest->statut === \App\Enums\RequestStatus::APPROVED)
                <span class="px-4 py-2 inline-flex text-sm leading-5 font-black rounded-xl bg-emerald-100 text-emerald-800 border border-emerald-200">Approuvé</span>
            @else
                <span class="px-4 py-2 inline-flex text-sm leading-5 font-black rounded-xl bg-rose-100 text-rose-800 border border-rose-200">Rejeté</span>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Colonne Gauche : Détails de la demande -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-black text-slate-800 mb-4 border-b border-gray-100 pb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Contenu du courrier
                </h2>
                
                <div class="space-y-4">
                    <div>
                        <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Objet</span>
                        <p class="text-slate-800 font-medium text-lg">{{ $assocRequest->objet ?? $assocRequest->title }}</p>
                    </div>
                    
                    @if($assocRequest->description)
                    <div>
                        <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Description initiale</span>
                        <div class="bg-slate-50 p-4 rounded-xl border border-slate-100 text-slate-700 whitespace-pre-wrap">{{ $assocRequest->description }}</div>
                    </div>
                    @endif

                    @if($assocRequest->attachment)
                    <div>
                        <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Fichier joint par l'ONG</span>
                        <a href="{{ asset('storage/' . $assocRequest->attachment) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors border border-slate-200">
                            <svg class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                            Consulter le document PDF
                        </a>
                    </div>
                    @elseif($assocRequest->pdf_path)
                    <div>
                        <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Ancien format (Généré)</span>
                        <a href="{{ asset('storage/' . $assocRequest->pdf_path) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors border border-slate-200">
                            Consulter le PDF généré
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            @if($assocRequest->statut !== \App\Enums\RequestStatus::PENDING)
            <!-- Réponse existante -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-black text-slate-800 mb-4 border-b border-gray-100 pb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path></svg>
                    Réponse de la Mairie
                </h2>
                <div class="space-y-4">
                    <div>
                        <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-1">Message de réponse</span>
                        <div class="bg-blue-50 p-4 rounded-xl border border-blue-100 text-blue-800 whitespace-pre-wrap">{{ $assocRequest->admin_response ?? $assocRequest->motif ?? 'Aucun message' }}</div>
                    </div>
                    @if($assocRequest->admin_attachment)
                    <div>
                        <span class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Fichier joint de la Mairie</span>
                        <a href="{{ asset('storage/' . $assocRequest->admin_attachment) }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 font-bold rounded-xl transition-colors">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Télécharger la pièce jointe
                        </a>
                    </div>
                    @endif
                </div>
            </div>
            @endif
        </div>

        <!-- Colonne Droite : Formulaire de traitement -->
        <div class="lg:col-span-1">
            @if($assocRequest->statut === \App\Enums\RequestStatus::PENDING)
            <div class="bg-white rounded-2xl shadow-lg border border-blue-100 p-6 sticky top-6">
                <h2 class="text-lg font-black text-slate-800 mb-4 border-b border-gray-100 pb-3 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Traiter le Courrier
                </h2>
                
                <form x-data="{ action: '' }" method="POST" :action="action === 'approve' ? '{{ route('admin.approve', $assocRequest->id) }}' : '{{ route('admin.reject', $assocRequest->id) }}'" enctype="multipart/form-data" id="processForm">
                    @csrf
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Message de réponse (Optionnel)</label>
                            <textarea name="admin_response" rows="4" class="w-full border border-slate-300 rounded-xl px-4 py-2 focus:ring-blue-500 focus:border-blue-500 text-sm" placeholder="Rédigez la réponse qui sera envoyée à l'ONG..."></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Joindre un document (Optionnel)</label>
                            <input type="file" name="admin_attachment" class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-colors">
                        </div>

                        <div class="pt-4 flex gap-3">
                            <button type="submit" @click="action = 'approve'" class="flex-1 bg-emerald-600 hover:bg-emerald-700 text-white py-2.5 rounded-xl font-bold shadow-md transition-colors flex justify-center items-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Approuver
                            </button>
                            <button type="submit" @click="action = 'reject'" class="flex-1 bg-rose-600 hover:bg-rose-700 text-white py-2.5 rounded-xl font-bold shadow-md transition-colors flex justify-center items-center gap-2">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Rejeter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
