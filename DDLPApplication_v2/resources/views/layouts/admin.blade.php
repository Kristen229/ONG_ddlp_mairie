<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - DDLP Mairie de Cotonou</title>
    <!-- Chargement Tailwind & Alpine -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.bunny.net/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 text-gray-900 flex min-h-screen overflow-hidden" x-data="{ sidebarOpen: true }">

    <!-- SIDEBAR (Barre latérale gauche) -->
    <aside :class="sidebarOpen ? 'w-64' : 'w-20'" class="bg-slate-900 flex-shrink-0 transition-all duration-300 ease-in-out flex flex-col shadow-2xl relative z-20 h-screen hidden md:flex">
        
        <!-- En-tête Sidebar -->
        <div class="h-20 flex items-center justify-center border-b border-slate-800 px-4">
            <span x-show="sidebarOpen" class="text-white font-black text-xl tracking-wider truncate flex items-center gap-2">
                <svg class="h-8 w-8 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                DDLP ADMIN
            </span>
            <span x-show="!sidebarOpen" class="text-white text-xl">
                <svg class="h-8 w-8 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
            </span>
        </div>

        <!-- Navigation Sidebar -->
        <nav class="flex-grow py-6 px-3 space-y-2 overflow-y-auto">
            
            <p x-show="sidebarOpen" class="px-3 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">Général</p>
            
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-3 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-teal-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}" title="Tableau de bord">
                <svg class="h-6 w-6 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span x-show="sidebarOpen" class="ml-3 font-medium text-sm">Tableau de bord</span>
            </a>

            <!-- L'administrateur aura ici les autres liens de gestion comme la V1 -->
            
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
                <!-- Notifications (statique) -->
                <button class="relative p-2 text-gray-400 hover:text-teal-600 transition-colors">
                    <span class="absolute top-1 right-1 h-2 w-2 bg-red-500 rounded-full"></span>
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </button>

                <!-- Menu Utilisateur -->
                <div x-data="{ userMenu: false }" class="relative">
                    <button @click="userMenu = !userMenu" @click.away="userMenu = false" class="flex items-center gap-3 focus:outline-none bg-gray-50 p-2 rounded-xl border border-gray-100 hover:bg-gray-100 transition-colors">
                        <div class="h-8 w-8 rounded-full bg-teal-600 text-white flex items-center justify-center font-bold">
                            A
                        </div>
                        <span class="text-sm font-bold text-gray-700 hidden md:block">Admin Mairie</span>
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    
                    <div x-show="userMenu" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 border border-gray-100">
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
