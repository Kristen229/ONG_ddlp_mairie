@extends('layouts.app')

@section('content')
<div class="bg-gray-50 flex min-h-[calc(100vh-4rem)]" x-data="{ tab: '{{ $errors->any() ? 'activites' : 'profil' }}', showActivityModal: {{ $errors->any() ? 'true' : 'false' }}, showRequestModal: false, mobileSidebar: false }">

    <!-- OVERLAY POUR MOBILE -->
    <div x-show="mobileSidebar" class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden" @click="mobileSidebar = false" style="display: none;"></div>

    <!-- SIDEBAR ASSOCIATION -->
    <aside :class="mobileSidebar ? 'translate-x-0' : '-translate-x-full'" class="fixed lg:sticky top-16 h-[calc(100vh-4rem)] w-72 bg-white border-r border-gray-200 z-50 lg:translate-x-0 transition-transform duration-300 ease-in-out flex flex-col">
        <!-- En-tête Sidebar -->
        <div class="p-6 border-b border-gray-100 text-center">
            <div class="h-24 w-24 mx-auto rounded-full border-4 border-gray-50 bg-white shadow-sm overflow-hidden mb-3">
                @if($user->attachment5)
                    <img src="{{ asset('storage/' . $user->attachment5) }}" alt="Logo" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full bg-teal-50 flex items-center justify-center text-teal-600 font-bold text-2xl">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                @endif
            </div>
            <h2 class="font-black text-gray-900 text-lg leading-tight">{{ $user->name }}</h2>
            <p class="text-teal-600 text-xs font-bold mt-1 uppercase tracking-wider">{{ $user->groupe ? $user->groupe->value : 'ONG' }}</p>
        </div>

        <!-- Menu Navigation -->
        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <button @click="tab = 'profil'; mobileSidebar = false" :class="tab === 'profil' ? 'bg-teal-50 text-teal-700 font-bold shadow-sm' : 'text-gray-600 hover:bg-gray-50 font-medium'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-left">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                Mon Profil
            </button>
            <button @click="tab = 'activites'; mobileSidebar = false" :class="tab === 'activites' ? 'bg-teal-50 text-teal-700 font-bold shadow-sm' : 'text-gray-600 hover:bg-gray-50 font-medium'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-left">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Mes Activités
            </button>
            <button @click="tab = 'demandes'; mobileSidebar = false" :class="tab === 'demandes' ? 'bg-teal-50 text-teal-700 font-bold shadow-sm' : 'text-gray-600 hover:bg-gray-50 font-medium'" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl transition-all text-left">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Mes Demandes
            </button>
            <button @click="tab = 'notifications'; mobileSidebar = false" :class="tab === 'notifications' ? 'bg-teal-50 text-teal-700 font-bold shadow-sm' : 'text-gray-600 hover:bg-gray-50 font-medium'" class="w-full flex items-center justify-between px-4 py-3 rounded-xl transition-all text-left">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    Mes Notifications
                </div>
                @if($user->notifications && $user->notifications->count() > 0)
                    <span class="bg-red-500 text-white text-[10px] font-black px-2 py-0.5 rounded-full">{{ $user->notifications->count() }}</span>
                @endif
            </button>
        </nav>

        <!-- Bas Sidebar -->
        <div class="p-4 border-t border-gray-100">
            <form method="POST" action="{{ route('user.logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 text-red-600 font-bold px-4 py-3 bg-red-50 hover:bg-red-100 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Déconnexion
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 overflow-x-hidden min-w-0 bg-gray-50">
        <!-- Header Mobile pour Sidebar -->
        <div class="lg:hidden bg-white border-b border-gray-200 p-4 flex items-center gap-4">
            <button @click="mobileSidebar = true" class="p-2 bg-gray-100 rounded-lg text-gray-600">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            <h1 class="font-bold text-gray-800 text-lg">Espace ONG</h1>
        </div>

        <div class="p-6 md:p-8 lg:p-10 max-w-5xl mx-auto">
            
            <!-- ONGLET 1 : PROFIL -->
            <div x-show="tab === 'profil'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                <div>
                    <h2 class="text-3xl font-black text-gray-900">Vue d'ensemble</h2>
                    <p class="text-gray-500 mt-1">Consultez les informations de votre structure.</p>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Informations Générales</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">Domaine d'intervention</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-teal-50 text-teal-700 border border-teal-100">{{ $user->domaine }}</span>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">Email (Identifiant)</p>
                            <p class="font-medium text-gray-900 border border-gray-100 p-3 rounded-xl bg-gray-50">{{ $user->email }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">Siège / Localisation</p>
                            <p class="font-medium text-gray-900 border border-gray-100 p-3 rounded-xl bg-gray-50">{{ $user->siege }}</p>
                        </div>
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-wider mb-1">Téléphones</p>
                            <p class="font-medium text-gray-900 border border-gray-100 p-3 rounded-xl bg-gray-50 flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                                {{ $user->number1 }} @if($user->number2) / {{ $user->number2 }} @endif
                            </p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Membres du Bureau</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="bg-gradient-to-br from-teal-50 to-white p-5 rounded-2xl border border-teal-100 text-center">
                            <p class="text-xs font-bold text-teal-600 uppercase tracking-wider mb-3">Président</p>
                            <div class="w-12 h-12 bg-white rounded-full mx-auto mb-2 flex items-center justify-center font-bold text-teal-700 shadow-sm">{{ substr($user->name_president, 0, 1) }}</div>
                            <p class="font-bold text-gray-900 text-sm">{{ $user->name_president }} {{ $user->last_name_president }}</p>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 text-center">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Vice-Président</p>
                            <p class="font-bold text-gray-900 text-sm">{{ $user->name_vice_president ?: '-' }} <br/> {{ $user->last_name_vice_president ?: '' }}</p>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 text-center">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Secrétaire G.</p>
                            <p class="font-bold text-gray-900 text-sm">{{ $user->name_secretaire_general ?: '-' }} <br/> {{ $user->last_name_secretaire_general ?: '' }}</p>
                        </div>
                        <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100 text-center">
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Trésorier</p>
                            <p class="font-bold text-gray-900 text-sm">{{ $user->name_tresorier_general ?: '-' }} <br/> {{ $user->last_name_tresorier_general ?: '' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ONGLET 2 : ACTIVITÉS -->
            <div x-show="tab === 'activites'" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-3xl font-black text-gray-900">Mes Activités</h2>
                        <p class="text-gray-500 mt-1">Publiez vos actions pour qu'elles soient visibles de tous.</p>
                    </div>
                    <button type="button" @click.prevent.stop="showActivityModal = true" class="inline-flex items-center gap-2 px-5 py-3 bg-slate-900 hover:bg-slate-800 text-white text-sm font-bold rounded-xl shadow-lg transition-transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Nouvelle Activité
                    </button>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    @if($user->activities && $user->activities->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($user->activities as $activity)
                            <div class="group border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl transition-all flex flex-col bg-white hover:-translate-y-1">
                                <div class="relative h-48 overflow-hidden">
                                    <img src="{{ asset('storage/' . $activity->attachment) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute top-3 right-3">
                                        @if($activity->is_visible)
                                            <span class="px-3 py-1 text-xs font-black tracking-wider bg-green-500 text-white rounded-full shadow-md">Publié</span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-black tracking-wider bg-yellow-400 text-yellow-900 rounded-full shadow-md">Modération</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="p-5 flex-grow flex flex-col justify-between border-t border-gray-50">
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-lg leading-tight mb-2">{{ $activity->titre }}</h4>
                                        <p class="text-sm text-gray-500 line-clamp-3">{{ $activity->description }}</p>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-gray-50 flex justify-between items-center text-xs font-medium text-gray-400">
                                        <span>Ajouté le {{ $activity->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                            <div class="w-16 h-16 bg-white rounded-full mx-auto flex items-center justify-center shadow-sm mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Aucune activité enregistrée</h3>
                            <p class="text-gray-500">Commencez par ajouter votre première activité pour la rendre publique.</p>
                            <button type="button" @click.prevent.stop="showActivityModal = true" class="mt-6 inline-flex items-center gap-2 px-4 py-2 bg-white border border-gray-200 hover:border-teal-500 text-teal-600 text-sm font-bold rounded-xl transition-colors">
                                Ajouter une activité
                            </button>
                        </div>
                    @endif
                </div>
            </div>

            <!-- ONGLET 3 : DEMANDES -->
            <div x-show="tab === 'demandes'" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-3xl font-black text-gray-900">Demandes Officielles</h2>
                        <p class="text-gray-500 mt-1">Soumettez vos courriers et sollicitations à la Mairie.</p>
                    </div>
                    <button type="button" @click.prevent.stop="showRequestModal = true" class="inline-flex items-center gap-2 px-5 py-3 bg-teal-600 hover:bg-teal-700 text-white text-sm font-bold rounded-xl shadow-lg shadow-teal-200 transition-transform hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        Nouveau Courrier
                    </button>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        @if($user->requests && $user->requests->count() > 0)
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left font-bold text-gray-500 text-xs uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-4 text-left font-bold text-gray-500 text-xs uppercase tracking-wider">Objet du Courrier</th>
                                    <th class="px-6 py-4 text-left font-bold text-gray-500 text-xs uppercase tracking-wider">Fichier Joint</th>
                                    <th class="px-6 py-4 text-left font-bold text-gray-500 text-xs uppercase tracking-wider">Statut DDP</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @foreach($user->requests as $request)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500 font-medium">{{ $request->created_at->format('d/m/Y') }}</td>
                                    <td class="px-6 py-5">
                                        <p class="font-bold text-gray-900">{{ $request->objet }}</p>
                                    </td>
                                    <td class="px-6 py-5">
                                        <a href="{{ asset('storage/' . $request->attachment) }}" target="_blank" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition-colors">
                                            <svg class="w-4 h-4 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                            Ouvrir
                                        </a>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        @if($request->statut === \App\Enums\RequestStatus::PENDING)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500"></span> En instruction
                                            </span>
                                        @elseif($request->statut === \App\Enums\RequestStatus::APPROVED)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Approuvé
                                            </span>
                                        @elseif($request->statut === \App\Enums\RequestStatus::REJECTED)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Rejeté
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            <div class="text-center py-16 bg-gray-50 border-t border-gray-100">
                                <div class="w-16 h-16 bg-white rounded-full mx-auto flex items-center justify-center shadow-sm mb-4">
                                    <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Aucun courrier soumis</h3>
                                <p class="text-gray-500">Toutes vos correspondances s'afficheront ici.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- ONGLET 4 : NOTIFICATIONS -->
            <div x-show="tab === 'notifications'" style="display: none;" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-8">
                <div>
                    <h2 class="text-3xl font-black text-gray-900">Mes Notifications</h2>
                    <p class="text-gray-500 mt-1">Retrouvez ici toutes les communications importantes de la Mairie.</p>
                </div>

                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    @if($user->notifications && $user->notifications->count() > 0)
                        <div class="space-y-4">
                            @foreach($user->notifications->sortByDesc('created_at') as $notification)
                                <div class="p-5 border {{ str_contains(strtolower($notification->title), 'suppression') ? 'border-rose-100 bg-rose-50/30' : (str_contains(strtolower($notification->title), 'avertissement') ? 'border-amber-100 bg-amber-50/30' : 'border-gray-100 bg-gray-50') }} rounded-2xl flex gap-4">
                                    <div class="flex-shrink-0 mt-1">
                                        @if(str_contains(strtolower($notification->title), 'suppression'))
                                            <div class="w-10 h-10 rounded-full bg-rose-100 flex items-center justify-center text-rose-600">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </div>
                                        @elseif(str_contains(strtolower($notification->title), 'avertissement'))
                                            <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                            </div>
                                        @else
                                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-3 mb-1">
                                            <h4 class="font-bold text-gray-900">{{ $notification->title }}</h4>
                                            <span class="text-xs font-medium text-gray-400">{{ $notification->created_at->format('d/m/Y à H:i') }}</span>
                                        </div>
                                        <p class="text-sm text-gray-600 leading-relaxed">{{ $notification->message }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-16 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                            <div class="w-16 h-16 bg-white rounded-full mx-auto flex items-center justify-center shadow-sm mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Aucune notification</h3>
                            <p class="text-gray-500">Vous n'avez reçu aucun message ou avertissement de la Mairie.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </main>

    <!-- MODAL AJOUT ACTIVITÉ -->
    <div x-show="showActivityModal" style="display: none;" class="fixed z-[100] inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
            <div x-show="showActivityModal" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click.stop="showActivityModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showActivityModal" 
                 @click.stop
                 x-transition.scale class="relative z-10 inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-100">
                <form action="{{ route('activites.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
                        <h3 class="text-2xl font-black text-gray-900 mb-6" id="modal-title">Publier une Activité</h3>
                        
                        @if ($errors->any())
                            <div class="mb-4 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
                                <ul class="list-disc list-inside text-sm text-red-600 font-medium">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Titre de l'action <span class="text-red-500">*</span></label>
                                <input type="text" name="titre" value="{{ old('titre') }}" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors">
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Lieu <span class="text-red-500">*</span></label>
                                    <input type="text" name="lieu" value="{{ old('lieu') }}" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors" placeholder="Ex: Cotonou, Quartier X">
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Date prévue <span class="text-red-500">*</span></label>
                                    <input type="date" name="date" value="{{ old('date') }}" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Description détaillée <span class="text-red-500">*</span></label>
                                <textarea name="description" rows="4" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors placeholder-gray-400" placeholder="Décrivez l'impact de l'activité...">{{ old('description') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Photo d'illustration <span class="text-red-500">*</span></label>
                                <input type="file" name="attachment" accept="image/*" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:px-8 border-t border-gray-100 flex flex-col-reverse sm:flex-row justify-end gap-3">
                        <button type="button" @click="showActivityModal = false" class="w-full sm:w-auto px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                            Annuler
                        </button>
                        <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-teal-600 text-white font-bold rounded-xl shadow-md hover:bg-teal-700 transition-colors">
                            Publier
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- MODAL NOUVELLE DEMANDE (LETTRE) -->
    <div x-show="showRequestModal" style="display: none;" class="fixed z-[100] inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:p-0">
            <div x-show="showRequestModal" x-transition.opacity class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" @click.stop="showRequestModal = false"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="showRequestModal" 
                 @click.stop
                 x-transition.scale class="relative z-10 inline-block align-bottom bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full border border-gray-100">
                <form action="{{ route('courrier.generate') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
                        <div class="flex items-center gap-4 mb-6 pb-4 border-b border-gray-100">
                            <div class="w-12 h-12 rounded-full bg-teal-50 flex items-center justify-center text-teal-600">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black text-gray-900" id="modal-title">Nouveau Courrier</h3>
                        </div>
                        
                        <div class="space-y-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Objet officiel <span class="text-red-500">*</span></label>
                                <input type="text" name="objet" placeholder="Ex: Demande de subvention..." required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Fichier PDF (Signé) <span class="text-red-500">*</span></label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl bg-gray-50 hover:bg-teal-50 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label class="relative cursor-pointer bg-white rounded-md font-bold text-teal-600 hover:text-teal-500 focus-within:outline-none px-2">
                                                <span>Importer un fichier</span>
                                                <input type="file" name="attachment" accept="application/pdf" class="sr-only" required>
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">PDF uniquement jusqu'à 10MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:px-8 border-t border-gray-100 flex flex-col-reverse sm:flex-row justify-end gap-3">
                        <button type="button" @click="showRequestModal = false" class="w-full sm:w-auto px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                            Annuler
                        </button>
                        <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-3 bg-teal-600 text-white font-bold rounded-xl shadow-md hover:bg-teal-700 transition-colors">
                            Envoyer la demande
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
