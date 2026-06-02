<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Mairie de Cotonou</title>
    <!-- Chargement Tailwind & Alpine -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.bunny.net/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 flex min-h-screen overflow-hidden" x-data="{ sidebarOpen: true }">
    @php
        $pendingCandidatesCount = \App\Models\User::where('is_approved', false)->count();
        $pendingRequestsCount = \App\Models\AssociationRequest::where('statut', \App\Enums\RequestStatus::PENDING)->count();
        $pendingActivitiesCount = \App\Models\Activity::where('status', \App\Models\Activity::STATUS_PENDING)->count();
        $totalPendingAdmin = $pendingCandidatesCount + $pendingRequestsCount + $pendingActivitiesCount;
    @endphp

    <!-- SIDEBAR (Barre latérale gauche) -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-slate-900 flex-shrink-0 transition-all duration-300 ease-in-out flex flex-col shadow-2xl relative z-20 h-screen hidden md:flex">
        
        <!-- En-tête Sidebar -->
        <div class="h-20 flex items-center justify-center border-b border-slate-800 px-4">
            <span x-show="sidebarOpen" class="text-white font-black text-xl tracking-wider truncate flex items-center gap-2">
                <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                MAIRIE ADMIN
            </span>
            <span x-show="!sidebarOpen" class="text-white text-xl">
                <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
            </span>
        </div>

        <!-- Navigation Sidebar -->
        <nav class="flex-grow py-6 px-3 space-y-2 overflow-y-auto">
            @if(auth('admin')->check() && auth('admin')->user()->must_change_password)
                <div class="px-3 py-4 text-sm text-slate-400 text-center">
                    Veuillez changer votre mot de passe pour accéder aux fonctionnalités.
                </div>
            @else
                <p x-show="sidebarOpen" class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Général</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Tableau de bord">
                    <svg class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span x-show="sidebarOpen" class="ml-3 font-medium text-sm">Tableau de bord</span>
                </a>

                <a href="{{ route('admin.associations.index') }}" class="flex items-center px-3 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.associations.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Structures et ONG">
                    <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    <span x-show="sidebarOpen" class="ml-3 font-medium text-sm">Structures & ONG</span>
                </a>

                <a href="{{ route('admin.candidates.index') }}" class="flex items-center px-3 py-3 rounded-xl transition-colors relative {{ request()->routeIs('admin.candidates.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Candidatures">
                    <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                    <span x-show="sidebarOpen" class="ml-3 font-medium text-sm">Candidatures</span>
                    @php $pendingCandidatesCount = \App\Models\User::where('is_approved', false)->count(); @endphp
                    @if($pendingCandidatesCount > 0)
                        <span class="absolute top-1 right-1 bg-red-500 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center">{{ $pendingCandidatesCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.requests.index') }}" class="flex items-center px-3 py-3 rounded-xl transition-colors relative {{ request()->routeIs('admin.requests.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Courriers & Demandes">
                    <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    <span x-show="sidebarOpen" class="ml-3 font-medium text-sm">Courriers & Demandes</span>
                    @if($pendingRequestsCount > 0)
                        <span class="absolute top-1 right-1 bg-red-500 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center">{{ $pendingRequestsCount }}</span>
                    @endif
                </a>

                <a href="{{ route('admin.activities.index') }}" class="flex items-center px-3 py-3 rounded-xl transition-colors relative {{ request()->routeIs('admin.activities.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Activités">
                    <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span x-show="sidebarOpen" class="ml-3 font-medium text-sm">Activités</span>
                    @if($pendingActivitiesCount > 0)
                        <span class="absolute top-1 right-1 bg-red-500 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center">{{ $pendingActivitiesCount }}</span>
                    @endif
                </a>

                @if(auth('admin')->check() && auth('admin')->user()->is_super_admin)
                <a href="{{ route('admin.superadmin.index') }}" class="flex items-center px-3 py-3 rounded-xl transition-colors relative {{ request()->routeIs('admin.superadmin.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Gestion Admins">
                    <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span x-show="sidebarOpen" class="ml-3 font-medium text-sm">Gestion Admins</span>
                </a>
                <a href="{{ route('admin.audit-logs.index') }}" class="flex items-center px-3 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.audit-logs.*') ? 'bg-blue-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Logs d'audit">
                    <svg class="h-6 w-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span x-show="sidebarOpen" class="ml-3 font-medium text-sm">Logs d'audit</span>
                </a>
                @endif
            @endif
            <button @click="sidebarOpen = !sidebarOpen" class="w-full flex items-center justify-center mt-8 py-3 text-slate-500 hover:text-white bg-slate-900 border border-slate-800 rounded-xl transition-colors">
                <svg x-show="sidebarOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
                <svg x-show="!sidebarOpen" class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"></path></svg>
            </button>
        </nav>
    </aside>

    <!-- ZONE PRINCIPALE (Header + Contenu) -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <!-- HEADER ADMIN -->
        <header class="h-20 bg-white border-b border-gray-200 flex items-center justify-between px-6 lg:px-10 z-10">
            <!-- Breadcrumbs ou Info globale -->
            <div class="flex items-center text-gray-500 font-medium text-sm">
                Administration Mairie
            </div>

            <!-- Boutons de droite -->
            <div class="flex items-center gap-6">
                @php 
                    $totalPendingAdmin = ($pendingCandidatesCount ?? 0) + ($pendingRequestsCount ?? 0) + ($pendingActivitiesCount ?? 0);
                @endphp
                <div x-data="{ notificationsOpen: false }" class="relative">
                    <button @click="notificationsOpen = !notificationsOpen" @click.away="notificationsOpen = false" class="relative p-2 text-gray-400 hover:text-blue-600 transition-colors">
                        @if($totalPendingAdmin > 0)
                            <span class="absolute -top-1 -right-1 min-w-5 h-5 px-1 bg-red-500 text-white text-[10px] font-black rounded-full flex items-center justify-center">{{ $totalPendingAdmin }}</span>
                        @endif
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    </button>

                    <div x-show="notificationsOpen" x-transition class="absolute right-0 mt-3 w-80 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50">
                        <div class="px-4 py-3 border-b border-gray-100">
                            <p class="text-sm font-black text-slate-900">Actions en attente</p>
                            <p class="text-xs text-slate-500">{{ $totalPendingAdmin }} élément(s) à traiter</p>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <a href="{{ route('admin.candidates.index') }}" class="flex items-center justify-between px-4 py-3 hover:bg-slate-50 transition-colors">
                                <span class="text-sm font-bold text-slate-700">Candidatures</span>
                                <span class="text-xs font-black px-2 py-1 rounded-full {{ ($pendingCandidatesCount ?? 0) > 0 ? 'bg-red-50 text-red-700' : 'bg-slate-100 text-slate-500' }}">{{ $pendingCandidatesCount ?? 0 }}</span>
                            </a>
                            <a href="{{ route('admin.requests.index') }}" class="flex items-center justify-between px-4 py-3 hover:bg-slate-50 transition-colors">
                                <span class="text-sm font-bold text-slate-700">Courriers</span>
                                <span class="text-xs font-black px-2 py-1 rounded-full {{ ($pendingRequestsCount ?? 0) > 0 ? 'bg-red-50 text-red-700' : 'bg-slate-100 text-slate-500' }}">{{ $pendingRequestsCount ?? 0 }}</span>
                            </a>
                            <a href="{{ route('admin.activities.index') }}" class="flex items-center justify-between px-4 py-3 hover:bg-slate-50 transition-colors">
                                <span class="text-sm font-bold text-slate-700">Activités à valider</span>
                                <span class="text-xs font-black px-2 py-1 rounded-full {{ ($pendingActivitiesCount ?? 0) > 0 ? 'bg-red-50 text-red-700' : 'bg-slate-100 text-slate-500' }}">{{ $pendingActivitiesCount ?? 0 }}</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Menu Utilisateur -->
                <div x-data="{ userMenu: false }" class="relative">
                    <button @click="userMenu = !userMenu" @click.away="userMenu = false" class="flex items-center gap-3 focus:outline-none bg-gray-50 p-2 rounded-xl border border-gray-100 hover:bg-gray-100 transition-colors">
                        <div class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold">
                            {{ auth('admin')->check() ? strtoupper(substr(auth('admin')->user()->prenom ?? auth('admin')->user()->email, 0, 1)) : 'A' }}
                        </div>
                        <span class="text-sm font-bold text-gray-700 hidden md:block">
                            @if(auth('admin')->check() && auth('admin')->user()->prenom)
                                {{ auth('admin')->user()->prenom }} {{ auth('admin')->user()->nom }}
                            @else
                                Admin Mairie
                            @endif
                        </span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
	                    <div x-show="userMenu" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 border border-gray-100">
	                        <a href="{{ route('admin.profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 font-bold transition-colors">
	                            Profil
	                        </a>
	                        <form method="POST" action="{{ route('admin.logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 font-bold transition-colors">
                                Déconnexion
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- CONTENU DYNAMIQUE -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50/50 p-6 lg:p-10">
            @yield('content')
        </main>
        
    </div>
</body>
</html>
