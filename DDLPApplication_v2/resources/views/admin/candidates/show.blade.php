@extends('layouts.admin')

@section('content')
@php
    $objectifs = is_string($candidate->objectifs) ? json_decode($candidate->objectifs, true) : ($candidate->objectifs ?? []);
    $documents = [
        ['path' => $candidate->logo_path, 'label' => 'Logo de la structure', 'type' => 'image'],
        ['path' => $candidate->recepisse_path, 'label' => 'Recepisse de declaration', 'type' => 'pdf'],
        ['path' => $candidate->journal_officiel_path, 'label' => 'Extrait du Journal Officiel', 'type' => 'pdf'],
        ['path' => $candidate->attestation_path, 'label' => 'Attestation d\'enregistrement', 'type' => 'pdf'],
        ['path' => $candidate->reglement_path, 'label' => 'Statut et reglement interieur', 'type' => 'pdf'],
    ];
@endphp

<div class="max-w-7xl mx-auto space-y-6" x-data="{ showRejectModal: false }">
    <div class="flex items-center justify-between gap-4">
        <a href="{{ route('admin.candidates.index') }}" class="inline-flex items-center gap-2 text-slate-600 hover:text-teal-700 font-bold bg-white px-4 py-2.5 rounded-xl shadow-sm border border-gray-200 transition-colors">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Retour aux candidatures
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="h-32 bg-gradient-to-r from-slate-900 to-teal-700"></div>
        <div class="px-6 lg:px-8 pb-6 -mt-14 relative">
            <div class="flex flex-col xl:flex-row xl:items-end justify-between gap-6">
                <div class="flex flex-col md:flex-row md:items-end gap-5">
                    <div class="h-28 w-28 rounded-2xl bg-white p-2 shadow-lg border border-gray-100 overflow-hidden flex items-center justify-center">
                        @if($candidate->logo_path)
                            <img src="{{ asset('storage/' . $candidate->logo_path) }}" alt="Logo de {{ $candidate->name }}" class="w-full h-full object-cover rounded-xl">
                        @else
                            <span class="text-4xl font-black text-slate-300">{{ strtoupper(substr($candidate->name, 0, 1)) }}</span>
                        @endif
                    </div>
                    <div class="pt-14 md:pt-0">
                        <div class="flex flex-wrap items-center gap-3 mb-2">
                            <span class="text-xs font-black uppercase tracking-wider px-2.5 py-1 rounded-lg bg-amber-50 text-amber-700 border border-amber-100">En attente</span>
                            <span class="text-xs font-black uppercase tracking-wider px-2.5 py-1 rounded-lg {{ $candidate->groupe?->value === 'ong' ? 'bg-blue-50 text-blue-700 border border-blue-100' : 'bg-emerald-50 text-emerald-700 border border-emerald-100' }}">
                                {{ $candidate->groupe?->value ?? 'Non specifie' }}
                            </span>
                        </div>
                        <h1 class="text-3xl font-black text-slate-900">{{ $candidate->name }}</h1>
                        <p class="text-slate-500 font-medium mt-1">{{ $candidate->denomination ?: 'Sigle non renseigne' }}</p>
                        <p class="text-xs text-slate-400 mt-2">Soumis le {{ $candidate->created_at->format('d/m/Y a H:i') }}</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <form method="POST" action="{{ route('admin.candidates.approve', $candidate->id) }}" onsubmit="return confirm('Approuver cette candidature ?');">
                        @csrf
                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl shadow-sm transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Approuver
                        </button>
                    </form>
                    <button type="button" @click="showRejectModal = true" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-sm font-bold rounded-xl transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        Rejeter
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
        <div class="xl:col-span-1 space-y-6">
            <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Informations generales</h2>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase">Nom officiel</dt>
                        <dd class="font-bold text-slate-900 mt-1">{{ $candidate->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase">Domaine(s)</dt>
                        <dd class="font-bold text-slate-900 mt-1">{{ $candidate->domaine ?: 'Non renseigne' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase">Date de creation</dt>
                        <dd class="font-bold text-slate-900 mt-1">{{ $candidate->date ? $candidate->date->format('d/m/Y') : 'Non renseignee' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase">Identifiant</dt>
                        <dd class="font-bold text-slate-900 mt-1">{{ $candidate->identifiant ?: 'Non genere' }}</dd>
                    </div>
                </dl>
            </section>

            <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Coordonnees</h2>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase">Adresse complete</dt>
                        <dd class="font-bold text-slate-900 mt-1">
                            {{ $candidate->maison ?: 'Maison non renseignee' }},
                            {{ $candidate->quartier ?: 'quartier non renseigne' }},
                            {{ $candidate->arrondissement ?: 'arrondissement non renseigne' }},
                            {{ $candidate->commune ?: 'commune non renseignee' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase">Email</dt>
                        <dd class="font-bold text-teal-700 mt-1"><a href="mailto:{{ $candidate->email }}">{{ $candidate->email ?: 'Non renseigne' }}</a></dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase">Telephone principal</dt>
                        <dd class="font-bold text-slate-900 mt-1">{{ $candidate->number1 ?: 'Non renseigne' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold text-slate-500 uppercase">Telephone secondaire</dt>
                        <dd class="font-bold text-slate-900 mt-1">{{ $candidate->number2 ?: 'Non renseigne' }}</dd>
                    </div>
                    @if($candidate->lien)
                        <div>
                            <dt class="text-xs font-bold text-slate-500 uppercase">Lien web / reseau</dt>
                            <dd class="font-bold text-teal-700 mt-1 break-all"><a href="{{ $candidate->lien }}" target="_blank">{{ $candidate->lien }}</a></dd>
                        </div>
                    @endif
                </dl>
            </section>
        </div>

        <div class="xl:col-span-2 space-y-6">
            <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Objectifs declares</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($objectifs as $index => $objectif)
                        <div class="flex items-start gap-4 p-4 bg-teal-50/50 rounded-xl border border-teal-100">
                            <span class="h-8 w-8 rounded-lg bg-teal-100 text-teal-700 flex items-center justify-center font-black shrink-0">{{ $index + 1 }}</span>
                            <p class="text-sm font-medium text-slate-700 leading-relaxed mt-1">{{ $objectif }}</p>
                        </div>
                    @empty
                        <div class="md:col-span-2 text-sm text-slate-500 bg-slate-50 border border-dashed border-slate-200 rounded-xl p-4">Aucun objectif renseigne.</div>
                    @endforelse
                </div>
            </section>

            <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Membres du bureau</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($candidate->boardMembers as $member)
                        <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <div class="h-16 w-16 bg-gray-200 rounded-xl overflow-hidden shrink-0 shadow-sm border border-white">
                                @if($member->photo_path)
                                    <a href="{{ asset('storage/' . $member->photo_path) }}" target="_blank">
                                        <img src="{{ asset('storage/' . $member->photo_path) }}" alt="{{ $member->nom }} {{ $member->prenom }}" class="w-full h-full object-cover">
                                    </a>
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400 font-black">{{ strtoupper(substr($member->nom, 0, 1)) }}</div>
                                @endif
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-teal-600 uppercase tracking-wider mb-0.5">{{ $member->role }}</p>
                                <p class="font-bold text-slate-900 text-sm">{{ $member->nom }} {{ $member->prenom }}</p>
                                <p class="text-xs text-slate-500">{{ $member->telephone }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="md:col-span-2 text-sm text-slate-500 bg-slate-50 border border-dashed border-slate-200 rounded-xl p-4">Aucun membre du bureau enregistre.</div>
                    @endforelse
                </div>
            </section>

            <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h2 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Documents uploades</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($documents as $doc)
                        @if($doc['path'])
                            <a href="{{ asset('storage/' . $doc['path']) }}" target="_blank" class="flex items-center gap-4 p-4 bg-slate-50 hover:bg-teal-50 border border-slate-200 hover:border-teal-200 rounded-xl transition-colors group">
                                <div class="h-12 w-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-teal-700 shrink-0">
                                    @if($doc['type'] === 'image')
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    @else
                                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    @endif
                                </div>
                                <div>
                                    <p class="font-black text-sm text-slate-800 group-hover:text-teal-700">{{ $doc['label'] }}</p>
                                    <p class="text-xs text-slate-500 mt-1">Cliquer pour consulter</p>
                                </div>
                            </a>
                        @else
                            <div class="flex items-center gap-4 p-4 bg-gray-50 border border-dashed border-gray-300 rounded-xl">
                                <div class="h-12 w-12 rounded-xl bg-gray-100 flex items-center justify-center text-gray-400 shrink-0">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L21 21M5.636 5.636L3 3"></path></svg>
                                </div>
                                <div>
                                    <p class="font-black text-sm text-gray-500">{{ $doc['label'] }}</p>
                                    <p class="text-xs text-gray-400 mt-1">Document manquant</p>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>

            <section class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 flex flex-col sm:flex-row justify-end gap-3">
                <form method="POST" action="{{ route('admin.candidates.approve', $candidate->id) }}" onsubmit="return confirm('Approuver cette candidature ?');">
                    @csrf
                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold rounded-xl shadow-sm transition-colors">
                        Approuver la candidature
                    </button>
                </form>
                <button type="button" @click="showRejectModal = true" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-5 py-3 bg-rose-50 hover:bg-rose-100 text-rose-700 border border-rose-200 text-sm font-bold rounded-xl transition-colors">
                    Rejeter la candidature
                </button>
            </section>
        </div>
    </div>

    <div x-show="showRejectModal" style="display: none;" class="fixed inset-0 z-[100] overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <div x-show="showRejectModal" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click.stop="showRejectModal = false"></div>
            <div x-show="showRejectModal" @click.stop
                 x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                 class="relative inline-block bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:max-w-lg w-full border border-slate-200">
                <form action="{{ route('admin.candidates.reject', $candidate->id) }}" method="POST">
                    @csrf
                    <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
                        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                            <div class="w-12 h-12 rounded-full bg-rose-50 flex items-center justify-center text-rose-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900">Rejeter la candidature</h3>
                        </div>
                        <div class="space-y-4">
                            <p class="text-sm text-slate-600">Vous etes sur le point de rejeter la candidature de <strong class="text-slate-900">{{ $candidate->name }}</strong>. Le compte sera supprime et un email sera envoye.</p>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Motif du rejet <span class="text-red-500">*</span></label>
                                <textarea name="motif" rows="4" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-rose-500 focus:border-rose-500 transition-colors" placeholder="Veuillez justifier ce rejet..."></textarea>
                            </div>
                            <p class="text-xs text-rose-600 font-medium">Ce motif sera envoye par email a l'association.</p>
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
