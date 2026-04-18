@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-teal-700 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-4xl md:text-5xl font-black mb-6">À Propos de la DDLP</h1>
        <p class="text-xl text-teal-100 max-w-3xl mx-auto font-light">
            La Direction du Développement Local et de la Participation (DDLP) de la Mairie de Cotonou œuvre pour une commune plus inclusive et dynamique.
        </p>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            
            <!-- Context & Mission -->
            <div class="space-y-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Notre Mission</h2>
                    <div class="w-16 h-1 bg-teal-500 rounded-full mb-6"></div>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        La Plateforme de la **Mairie de Cotonou** est conçue pour faciliter les interactions entre l'administration locale et les organisations de la société civile (Associations, ONG, Fondations). Notre but est de digitaliser et simplifier la gouvernance participative.
                    </p>
                </div>
                
                <div class="bg-teal-50 p-6 rounded-2xl border border-teal-100">
                    <h3 class="text-xl font-bold text-teal-900 mb-3">Une collaboration transparente</h3>
                    <p class="text-teal-800">
                        Nous croyons que le développement de Cotonou passe par une collaboration étroite avec les acteurs du terrain. Cette plateforme permet de suivre les projets, de demander des accompagnements et d'assurer une visibilité maximale aux initiatives locales.
                    </p>
                </div>
            </div>

            <!-- Image/Illustration -->
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-teal-200 to-teal-50 rounded-3xl transform rotate-3 scale-105 -z-10"></div>
                <img src="{{ asset('/img1/4469bddf-fb4a-4003-9684-73ca66a47ad6-removebg-preview.png') }}" alt="Mairie de Cotonou" class="w-full h-auto rounded-3xl shadow-xl border border-white">
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="py-16 bg-gray-50 border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900">Nos Objectifs Clés</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <!-- Valor 1 -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-16 h-16 bg-teal-100 text-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform -rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Inclusion</h3>
                <p class="text-gray-600">Référencer tous les groupements actifs, sans exception, pour cartographier les forces de notre commune.</p>
            </div>
            
            <!-- Valor 2 -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-16 h-16 bg-teal-100 text-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Transparence</h3>
                <p class="text-gray-600">Rendre publiques les activités majeures validées, et suivre numériquement tous les dossiers déposés.</p>
            </div>

            <!-- Valor 3 -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="w-16 h-16 bg-teal-100 text-teal-600 rounded-2xl flex items-center justify-center mx-auto mb-6 transform -rotate-3">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">Dynamisme</h3>
                <p class="text-gray-600">Booster les partenariats via des demandes d'accompagnements simples et rapides en ligne.</p>
            </div>
        </div>
    </div>
</section>
@endsection
