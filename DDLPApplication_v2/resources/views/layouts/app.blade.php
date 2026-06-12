<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mairie de Cotonou - Mairie de Cotonou</title>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind et Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 text-gray-800 antialiased flex flex-col min-h-screen">

    <!-- Header / Navigation -->
    <header x-data="{ mobileMenuOpen: false }" class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" aria-label="Top">
            <div class="w-full py-4 flex items-center justify-between">
                <div class="flex items-center">
                    <a href="{{ route('accueil') }}" class="flex items-center gap-3">
                        <img src="{{ asset('build/assets/Logo_MCOT-2023-08_Final_qokf8t.png') }}" alt="Logo Mairie de Cotonou" class="h-10 w-auto">
                        <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-blue-500">
                            Mairie de Cotonou
                        </span>
                    </a>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('accueil') }}" class="text-base font-medium text-gray-700 hover:text-blue-600">Accueil</a>
                    <a href="{{ route('association-et-ong') }}" class="text-base font-medium text-gray-700 hover:text-blue-600">Associations et ONG</a>
                    <a href="{{ route('accueil') }}#activite" class="text-base font-medium text-gray-700 hover:text-blue-600">Activités</a>
                    
                    <!-- Dropdown "Plus" -->
                    <div x-data="{ open: false }" class="relative" @click.outside="open = false">
                        <button @click="open = !open" class="text-base font-medium text-gray-700 hover:text-blue-600 flex items-center gap-1 group">
                            Plus
                            <svg class="h-4 w-4 text-gray-400 group-hover:text-blue-500 transition-transform" :class="{'rotate-180': open}" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div x-show="open" style="display: none;" class="absolute z-10 -ml-4 mt-3 w-screen max-w-sm">
                            <div class="rounded-xl shadow-lg ring-1 ring-black ring-opacity-5 overflow-hidden bg-white">
                                <div class="px-5 py-6 sm:p-6 space-y-4">
                                    <a href="{{ route('apropos') }}" class="group flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50">
                                        <div>
                                            <p class="text-base font-medium text-gray-900 group-hover:text-blue-600">À Propos</p>
                                            <p class="mt-1 text-sm text-gray-600">Mission de la Mairie et engagement.</p>
                                        </div>
                                    </a>
                                    <a href="{{ route('faq') }}" class="group flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50">
                                        <div>
                                            <p class="text-base font-medium text-gray-900 group-hover:text-blue-600">FAQ</p>
                                            <p class="mt-1 text-sm text-gray-600">Réponses aux questions fréquentes.</p>
                                        </div>
                                    </a>
                                    <a href="{{ route('contact') }}" class="group flex items-start gap-3 p-2 rounded-lg hover:bg-gray-50">
                                        <div>
                                            <p class="text-base font-medium text-gray-900 group-hover:text-blue-600">Contact</p>
                                            <p class="mt-1 text-sm text-gray-600">Contactez la Mairie de Cotonou.</p>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hidden lg:flex items-center space-x-4">
                    @auth('web')
                        <a href="{{ route('user.show', Auth::id()) }}" class="bg-blue-600 py-2 px-4 rounded-full text-sm font-medium text-white hover:bg-blue-700">Mon Espace</a>
                    @else
                        <a href="{{ route('connexion') }}" class="bg-blue-600 py-2 px-4 rounded-full text-sm font-medium text-white hover:bg-blue-700">Connexion membre</a>
                    @endauth
                </div>

                <!-- Bouton Mobile Menu -->
                <div class="flex items-center lg:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="bg-gray-50 rounded-md p-2 text-gray-400 hover:bg-gray-100">
                        <svg class="h-6 w-6" x-show="!mobileMenuOpen" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                        <svg class="h-6 w-6" x-show="mobileMenuOpen" style="display: none;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" class="lg:hidden pb-4" style="display: none;">
                <a href="{{ route('accueil') }}" class="block px-3 py-2 rounded-md font-medium text-gray-900 hover:bg-gray-50">Accueil</a>
                <a href="{{ route('association-et-ong') }}" class="block px-3 py-2 rounded-md font-medium text-gray-900 hover:bg-gray-50">Associations et ONG</a>
                <a href="{{ route('accueil') }}#activite" class="block px-3 py-2 rounded-md font-medium text-gray-900 hover:bg-gray-50">Activités</a>
                <a href="{{ route('apropos') }}" class="block px-3 py-2 rounded-md font-medium text-gray-900 hover:bg-gray-50">À Propos</a>
                <a href="{{ route('faq') }}" class="block px-3 py-2 rounded-md font-medium text-gray-900 hover:bg-gray-50">FAQ</a>
                <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md font-medium text-gray-900 hover:bg-gray-50">Contact</a>
                <div class="mt-4">
                     @auth('web')
                        <a href="{{ route('user.show', Auth::id()) }}" class="w-full inline-block text-center bg-blue-600 py-3 px-4 rounded-full text-white">Mon Espace</a>
                    @else
                        <a href="{{ route('connexion') }}" class="w-full inline-block text-center bg-blue-600 py-3 px-4 rounded-full text-white">Connexion membre</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 mt-16 py-12 text-white text-sm">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <span class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-blue-400">Mairie de Cotonou</span>
                <p class="mt-4 text-gray-400">Plateforme municipale des associations et ONG de Cotonou.</p>
            </div>
            <div>
                <h3 class="font-bold uppercase tracking-wider mb-4">Liens Rapides</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('association-et-ong') }}" class="hover:text-white">Associations & ONG</a></li>
                    <li><a href="{{ route('apropos') }}" class="hover:text-white">À Propos</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-white">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
            <div>
                <h3 class="font-bold uppercase tracking-wider mb-4">Légal</h3>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('confidentialite') }}" class="hover:text-white">Politique de Confidentialité</a></li>
                    <li><a href="{{ route('conditions') }}" class="hover:text-white">Conditions d'Utilisation</a></li>
                </ul>
            </div>
        </div>
        <div class="mt-12 text-center text-gray-500 border-t border-gray-800 pt-8">
            &copy; {{ date('Y') }} Mairie de Cotonou - Mairie de Cotonou. Tous droits réservés.
        </div>
    </footer>

</body>
</html>
