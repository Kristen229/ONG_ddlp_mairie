@extends('layouts.admin')

@section('content')
<!-- Conteneur principal avec Alpine.js pour la gestion des onglets -->
<div x-data="{ tab: 'overview' }" class="space-y-6">

    <!-- En-tête et Navigation des Onglets -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center bg-white p-4 lg:p-6 rounded-2xl shadow-sm border border-gray-200 gap-4">
        <div>
            <h1 class="text-2xl font-black text-slate-800">Vue Globale</h1>
            <p class="text-sm text-slate-500">Gérez l'ensemble des structures et activités de la commune.</p>
        </div>
        
        <div class="flex overflow-x-auto w-full lg:w-auto bg-gray-100 p-1.5 rounded-xl space-x-1">
            <button @click="tab = 'overview'" :class="tab === 'overview' ? 'bg-white shadow-sm text-teal-700' : 'text-slate-600 hover:text-slate-900 hover:bg-gray-200'" class="whitespace-nowrap px-5 py-2.5 rounded-lg text-sm font-bold transition-all">
                Vue d'ensemble
            </button>
            <button @click="tab = 'associations'" :class="tab === 'associations' ? 'bg-white shadow-sm text-teal-700' : 'text-slate-600 hover:text-slate-900 hover:bg-gray-200'" class="whitespace-nowrap px-5 py-2.5 rounded-lg text-sm font-bold transition-all flex items-center gap-2">
                Structures <span class="bg-teal-100 text-teal-800 py-0.5 px-2 rounded-full text-xs">{{ $userCount }}</span>
            </button>
            <button @click="tab = 'demandes'" :class="tab === 'demandes' ? 'bg-white shadow-sm text-teal-700' : 'text-slate-600 hover:text-slate-900 hover:bg-gray-200'" class="whitespace-nowrap px-5 py-2.5 rounded-lg text-sm font-bold transition-all flex items-center gap-2">
                Courriers <span class="bg-yellow-100 text-yellow-800 py-0.5 px-2 rounded-full text-xs">{{ $pendingRequestsCount }}</span>
            </button>
            <button @click="tab = 'activites'" :class="tab === 'activites' ? 'bg-white shadow-sm text-teal-700' : 'text-slate-600 hover:text-slate-900 hover:bg-gray-200'" class="whitespace-nowrap px-5 py-2.5 rounded-lg text-sm font-bold transition-all flex items-center gap-2">
                Activités <span class="bg-blue-100 text-blue-800 py-0.5 px-2 rounded-full text-xs">{{ $activityCount }}</span>
            </button>
        </div>
    </div>

    <!-- ==========================================
         ONGLET 1 : VUE D'ENSEMBLE (STATS)
    =========================================== -->
    <div x-show="tab === 'overview'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="space-y-6">
        
        <!-- Cartes Statistiques KPI -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total ONG/Assoc -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="h-14 w-14 bg-teal-50 text-teal-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Inscrits au total</p>
                    <p class="text-3xl font-black text-slate-800">{{ $userCount }}</p>
                </div>
            </div>

            <!-- Total Demandes -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="h-14 w-14 bg-yellow-50 text-yellow-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Courriers total</p>
                    <p class="text-3xl font-black text-slate-800">{{ $requestCount }}</p>
                </div>
            </div>

            <!-- Demandes en attente -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="h-14 w-14 bg-red-50 text-red-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">En attente de réponse</p>
                    <p class="text-3xl font-black text-red-600">{{ $pendingRequestsCount }}</p>
                </div>
            </div>

            <!-- Activités publiées -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:shadow-md transition-shadow">
                <div class="h-14 w-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
                <div>
                    <p class="text-sm font-medium text-slate-500">Activités Réalisées</p>
                    <p class="text-3xl font-black text-slate-800">{{ $activityCount }}</p>
                </div>
            </div>
        </div>

        <!-- Section Listes Rapides (Mini table) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Dernières inscriptions -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-slate-800">Dernières inscriptions</h2>
                    <button @click="tab = 'associations'" class="text-sm font-medium text-teal-600 hover:text-teal-800">Voir tout →</button>
                </div>
                <div class="space-y-4">
                    @foreach($lastUsers as $u)
                    <div class="flex items-center gap-4 p-3 hover:bg-gray-50 rounded-xl transition-colors border border-transparent hover:border-gray-100">
                        <div class="h-10 w-10 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center font-bold text-sm shrink-0">
                            {{ substr($u->name, 0, 2) }}
                        </div>
                        <div class="flex-grow min-w-0">
                            <p class="font-bold text-sm text-slate-900 truncate">{{ $u->name }}</p>
                            <p class="text-xs text-slate-500 truncate">{{ $u->email }}</p>
                        </div>
                        <div class="shrink-0 text-xs font-semibold px-2 py-1 bg-gray-100 text-gray-600 rounded-lg">
                            {{ $u->groupe ? Str::upper($u->groupe->value) : '-' }}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Dernières Notifs / Alertes -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-lg font-bold text-slate-800">Récentes Notifications</h2>
                </div>
                <div class="space-y-4">
                    @forelse($notifications as $notif)
                    <div class="flex items-start gap-4 p-3 bg-gray-50 rounded-xl border border-gray-100">
                        <div class="mt-1 flex-shrink-0 text-teal-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-800">{{ $notif->data['message'] ?? 'Notification' }}</p>
                            <p class="text-xs text-slate-500 mt-1">{{ $notif->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @empty
                    <p class="text-sm text-gray-500 italic text-center py-8">Aucune notification pour le moment.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>


    <!-- ==========================================
         ONGLET 2 : LISTE DES ASSOCIATIONS
    =========================================== -->
    <div x-show="tab === 'associations'" style="display: none;" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 flex justify-between items-center bg-gray-50">
            <h2 class="text-xl font-bold text-slate-800">Toutes les structures</h2>
            <a href="{{ route('admin.createForm1') }}" class="bg-slate-900 hover:bg-slate-800 text-white px-4 py-2 rounded-xl text-sm font-bold shadow-sm transition-colors">
                + Ajouter manuellement
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Logo & Nom</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Domaine</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Téléphone</th>
                        <th class="px-6 py-4 text-right text-xs font-black text-slate-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @foreach($users as $u)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="h-10 w-10 rounded-full bg-gray-200 overflow-hidden shrink-0 border border-gray-200">
                                    @if($u->attachment5) <img src="{{ asset('storage/' . $u->attachment5) }}" class="w-full h-full object-cover"> @endif
                                </div>
                                <div class="w-48 xl:w-64"> <!-- Coupe le texte si trop long -->
                                    <p class="text-sm font-bold text-slate-900 truncate" title="{{ $u->name }}">{{ $u->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $u->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-3 py-1 text-xs font-bold rounded-lg bg-slate-100 text-slate-700">{{ $u->groupe ? Str::upper($u->groupe->value) : '-' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm text-slate-600 truncate max-w-[150px] inline-block" title="{{ $u->domaine }}">{{ $u->domaine }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">
                            {{ $u->number1 }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium flex justify-end gap-2">
                            <a href="{{ route('account.show', $u->id) }}" class="text-teal-600 hover:text-teal-900 bg-teal-50 px-3 py-1.5 rounded-lg transition-colors">Gérer</a>
                            <form method="POST" action="{{ route('admin.delete', $u->id) }}" onsubmit="return confirm('Supprimer définitivement cette structure ?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 px-3 py-1.5 rounded-lg transition-colors">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t border-gray-200">
            {{ $users->links() }}
        </div>
    </div>


    <!-- ==========================================
         ONGLET 3 : COURRIERS ET DEMANDES
    =========================================== -->
    <div x-show="tab === 'demandes'" style="display: none;" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 bg-gray-50 flex items-center gap-3">
            <h2 class="text-xl font-bold text-slate-800">Gestion des Courriers Administratifs</h2>
            <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-lg">{{ $pendingRequestsCount }} urgents</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase">Auteur</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase">Objet</th>
                        <th class="px-6 py-4 text-center text-xs font-black text-slate-500 uppercase">Pièce jointe</th>
                        <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase">Statut</th>
                        <th class="px-6 py-4 text-right text-xs font-black text-slate-500 uppercase">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 bg-white">
                    @forelse($requests as $req)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm font-bold text-slate-800">{{ $req->user->name ?? 'ONG Inconnue' }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600 max-w-[200px] truncate" title="{{ $req->objet }}">{{ $req->objet }}</td>
                        <td class="px-6 py-4 text-center">
                            @if($req->attachment)
                                <a href="{{ asset('storage/'.$req->attachment) }}" target="_blank" class="text-teal-600 hover:text-teal-800 font-bold text-sm bg-teal-50 px-3 py-1.5 rounded-lg inline-block">📋 Ouvrir PDF</a>
                            @else
                                <span class="text-xs text-gray-400">Aucun</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($req->status === \App\Enums\RequestStatus::PENDING)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-yellow-100 text-yellow-800">En Attente</span>
                            @elseif($req->status === \App\Enums\RequestStatus::APPROVED)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-green-100 text-green-800">Vu et Approuvé</span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg bg-red-100 text-red-800">Rejeté</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-right whitespace-nowrap">
                            <!-- Boutons Accepter / Refuser -->
                            @if($req->status === \App\Enums\RequestStatus::PENDING)
                                <div class="flex justify-end gap-2">
                                    <form method="POST" action="{{ route('admin.approve', $req->id) }}">
                                        @csrf <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-3 py-1.5 rounded-lg text-sm font-bold transition-colors">Approuver</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.reject', $req->id) }}">
                                        @csrf <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-lg text-sm font-bold transition-colors">Rejeter</button>
                                    </form>
                                </div>
                            @else
                                <span class="text-xs text-gray-400">Déjà traité</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="py-8 text-center text-gray-500 text-sm">Aucun courrier disponible.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- ==========================================
         ONGLET 4 : ACTIVITÉS
    =========================================== -->
    <div x-show="tab === 'activites'" style="display: none;" class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="p-6 border-b border-gray-200 bg-gray-50">
            <h2 class="text-xl font-bold text-slate-800">Galerie des Activités</h2>
        </div>
        
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($activities as $act)
            <div class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition-shadow relative">
                <!-- Visuel -->
                <div class="h-48 bg-gray-100 relative group">
                    <img src="{{ asset('storage/'.$act->attachment) }}" class="w-full h-full object-cover">
                    <!-- Overlay suppression (Survol) -->
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <form method="POST" action="{{ route('activites.destroy', $act->id) }}" onsubmit="return confirm('Supprimer l\'activité ?');">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-bold">🗑️ Supprimer</button>
                        </form>
                    </div>
                </div>
                
                <div class="p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <div class="h-6 w-6 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center text-xs font-bold shrink-0">
                            {{ substr($act->user->name ?? 'A', 0, 1) }}
                        </div>
                        <p class="text-xs font-bold text-teal-700 truncate w-full">{{ $act->user->name ?? 'Inconnue' }}</p>
                    </div>
                    <h3 class="font-bold text-slate-900 leading-tight mb-1 truncate" title="{{ $act->titre }}">{{ $act->titre }}</h3>
                    <p class="text-xs text-gray-500 mb-2">{{ $act->created_at->format('d/m/Y') }}</p>
                    <p class="text-sm text-gray-600 line-clamp-2">{{ $act->description }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full py-12 text-center text-gray-500 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                Aucune activité publiée.
            </div>
            @endforelse
        </div>
    </div>

</div>
@endsection
