@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto space-y-6">

    <!-- Bouton Retour -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.associations.index') }}" class="text-slate-500 hover:text-teal-600 transition-colors flex items-center gap-2 font-medium bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Retour aux structures
        </a>
    </div>

    <!-- EN-TETE / PROFIL GENERAL -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden relative">
        <!-- Bannière décorative -->
        <div class="h-32 bg-gradient-to-r from-teal-500 to-emerald-400"></div>

        <div class="px-6 lg:px-10 pb-8 flex flex-col md:flex-row items-center md:items-end justify-between gap-6 -mt-16 relative">
            <div class="flex flex-col md:flex-row items-center gap-6">
                <!-- Logo -->
                <div class="h-32 w-32 rounded-2xl bg-white p-2 shadow-lg shrink-0 border border-gray-100 flex items-center justify-center overflow-hidden">
                    @if($user->attachment5)
                        <img src="{{ asset('storage/' . $user->attachment5) }}" alt="Logo de {{ $user->name }}" class="w-full h-full object-cover rounded-xl">
                    @else
                        <span class="text-4xl font-black text-slate-300">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    @endif
                </div>

                <!-- Info Titre -->
                <div class="text-center md:text-left mt-4 md:mt-0">
                    <div class="flex flex-col md:flex-row md:items-center gap-3">
                        <h1 class="text-3xl font-black text-slate-800">{{ $user->name }}</h1>
                        <div>
                            @if($user->groupe && strtolower($user->groupe->value) === 'ong')
                                <span class="px-3 py-1 text-xs font-black rounded-lg bg-blue-100 text-blue-800 border border-blue-200">ONG</span>
                            @elseif($user->groupe && strtolower($user->groupe->value) === 'association')
                                <span class="px-3 py-1 text-xs font-black rounded-lg bg-emerald-100 text-emerald-800 border border-emerald-200">ASSO</span>
                            @else
                                <span class="px-3 py-1 text-xs font-black rounded-lg bg-slate-100 text-slate-600 border border-slate-200">Non défini</span>
                            @endif
                        </div>
                    </div>
                    <p class="text-slate-500 font-medium mt-1">{{ $user->domaine ?: 'Domaine d\'intervention non spécifié' }}</p>
                </div>
            </div>

            <!-- Actions Rapides -->
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('pdf.download', $user->id) }}" class="flex-1 md:flex-none flex justify-center items-center gap-2 bg-indigo-50 text-indigo-700 hover:bg-indigo-100 border border-indigo-100 font-bold px-5 py-2.5 rounded-xl transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Fiche PDF
                </a>
                <a href="{{ route('admin.edit', $user->id) }}" class="flex-1 md:flex-none flex justify-center items-center gap-2 bg-teal-600 text-white hover:bg-teal-700 font-bold px-5 py-2.5 rounded-xl shadow-md transition-colors">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Modifier
                </a>
            </div>
        </div>
    </div>

    <!-- DOUBLE COLONNE : INFO ET BUREAU -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- COLONNE GAUCHE (Infos Générales) -->
        <div class="xl:col-span-1 space-y-6">
            <!-- Carte Coordonnées -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Coordonnées et Immatriculation</h3>
                
                <div class="space-y-4">
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Identifiant Unique</p>
                        <p class="font-bold text-slate-800">{{ $user->identifiant ?: 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Dénomination complète</p>
                        <p class="font-bold text-slate-800">{{ $user->denomination ?: 'N/A' }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Siège Social</p>
                        <p class="font-bold text-slate-800 flex items-start gap-1">
                            <svg class="h-4 w-4 mt-0.5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                            {{ $user->siege ?: 'Non renseigné' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Email Officiel</p>
                        <a href="mailto:{{ $user->email }}" class="font-bold text-teal-600 hover:underline">{{ $user->email }}</a>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Téléphones</p>
                        <p class="font-bold text-slate-800">{{ $user->number1 }} @if($user->number2) • {{ $user->number2 }} @endif</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Création / Récépissé</p>
                        <p class="font-bold text-slate-800">{{ $user->date ? \Carbon\Carbon::parse($user->date)->format('d M. Y') : 'Non renseignée' }}</p>
                    </div>
                    @if($user->lien)
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Site Web</p>
                        <a href="{{ $user->lien }}" target="_blank" class="font-bold text-teal-600 hover:underline flex items-center gap-1">
                            {{ $user->lien }}
                            <svg class="h-3 w-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Documents joints -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Documents Officiels</h3>
                <div class="space-y-3">
                    @if($user->attachment)
                    <a href="{{ asset('storage/' . $user->attachment) }}" target="_blank" class="flex items-center gap-3 p-3 bg-slate-50 hover:bg-teal-50 border border-slate-200 hover:border-teal-200 rounded-xl transition-colors group">
                        <div class="h-10 w-10 bg-white shadow-sm flex items-center justify-center rounded-lg text-teal-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-sm text-slate-800 group-hover:text-teal-700">Arrêté / Récépissé</p>
                            <p class="text-xs text-slate-500">Document légal</p>
                        </div>
                    </a>
                    @endif
                    
                    <div class="grid grid-cols-2 gap-3 mt-4">
                        @if($user->signature_data)
                        <div class="border border-gray-200 rounded-xl p-2 text-center h-24 flex flex-col justify-between">
                            <img src="{{ asset('storage/' . $user->signature_data) }}" class="h-12 w-full object-contain mix-blend-multiply">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Signature</p>
                        </div>
                        @endif
                        @if($user->cachet)
                        <div class="border border-gray-200 rounded-xl p-2 text-center h-24 flex flex-col justify-between">
                            <img src="{{ asset('storage/' . $user->cachet) }}" class="h-12 w-full object-contain mix-blend-multiply">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Cachet</p>
                        </div>
                        @else
                        <!-- Stub si vide -->
                        <div class="border border-dashed border-gray-300 rounded-xl p-2 text-center h-24 flex flex-col justify-center items-center bg-gray-50">
                            <p class="text-[10px] font-bold text-slate-400 uppercase">Aucun Cachet</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- COLONNE DROITE (Objectifs & Bureau) -->
        <div class="xl:col-span-2 space-y-6">
            
            <!-- Objectifs -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-4 border-b border-gray-100 pb-2">Objectifs de la structure</h3>
                <ul class="space-y-4">
                    @for($i = 1; $i <= 3; $i++)
                        @php $obj = "objectif$i"; @endphp
                        @if($user->$obj)
                        <li class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl border border-gray-100">
                            <div class="h-8 w-8 bg-teal-100 text-teal-600 rounded-lg flex items-center justify-center font-black shrink-0">
                                {{ $i }}
                            </div>
                            <p class="text-sm font-medium text-slate-700 mt-1 leading-relaxed">{{ $user->$obj }}</p>
                        </li>
                        @endif
                    @endfor
                </ul>
            </div>

            <!-- Membres du Bureau -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-sm font-black text-slate-400 uppercase tracking-wider mb-6 border-b border-gray-100 pb-2">Membres du Bureau</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Président -->
                    <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100 hover:border-teal-200 transition-colors">
                        <div class="h-16 w-16 bg-gray-200 rounded-xl overflow-hidden shrink-0 shadow-sm border border-white">
                            @if($user->attachment1)
                                <img src="{{ asset('storage/' . $user->attachment1) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg></div>
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-teal-600 uppercase tracking-wider mb-0.5">Président(e)</p>
                            <p class="font-bold text-slate-900 text-sm">{{ $user->name_president ?: 'N/A' }} {{ $user->last_name_president ?: '' }}</p>
                        </div>
                    </div>

                    <!-- Vice Président -->
                    <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100 hover:border-teal-200 transition-colors">
                        <div class="h-16 w-16 bg-gray-200 rounded-xl overflow-hidden shrink-0 shadow-sm border border-white">
                            @if($user->attachment2)
                                <img src="{{ asset('storage/' . $user->attachment2) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg></div>
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-teal-600 uppercase tracking-wider mb-0.5">Vice Président(e)</p>
                            <p class="font-bold text-slate-900 text-sm">{{ $user->name_vice_president ?: 'N/A' }} {{ $user->last_name_vice_president ?: '' }}</p>
                        </div>
                    </div>

                    <!-- Secrétaire -->
                    <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100 hover:border-teal-200 transition-colors">
                        <div class="h-16 w-16 bg-gray-200 rounded-xl overflow-hidden shrink-0 shadow-sm border border-white">
                            @if($user->attachment3)
                                <img src="{{ asset('storage/' . $user->attachment3) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg></div>
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-teal-600 uppercase tracking-wider mb-0.5">Secrétaire Général(e)</p>
                            <p class="font-bold text-slate-900 text-sm">{{ $user->name_secretaire_general ?: 'N/A' }} {{ $user->last_name_secretaire_general ?: '' }}</p>
                        </div>
                    </div>

                    <!-- Trésorier -->
                    <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100 hover:border-teal-200 transition-colors">
                        <div class="h-16 w-16 bg-gray-200 rounded-xl overflow-hidden shrink-0 shadow-sm border border-white">
                            @if($user->attachment4)
                                <img src="{{ asset('storage/' . $user->attachment4) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400"><svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" /></svg></div>
                            @endif
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-teal-600 uppercase tracking-wider mb-0.5">Trésorier(e) Général(e)</p>
                            <p class="font-bold text-slate-900 text-sm">{{ $user->name_tresorier_general ?: 'N/A' }} {{ $user->last_name_tresorier_general ?: '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
