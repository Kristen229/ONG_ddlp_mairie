@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-b from-teal-50 to-white py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 tracking-tight leading-tight">
            Répertoire des <span class="bg-clip-text text-transparent bg-gradient-to-r from-teal-500 to-green-500">Associations et ONG</span>
            <br /> de Cotonou
        </h1>
        <p class="mt-6 text-lg md:text-xl text-gray-600 max-w-3xl mx-auto">
            Plusieurs associations et ONG interviennent activement dans la commune. Découvrez, suivez et participez aux initiatives locales pour un impact positif.
        </p>

        <!-- Stats Grid -->
        <div class="mt-16 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Stat 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="h-12 w-12 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">150+</h3>
                <p class="text-sm text-gray-500 mt-1 font-medium">Associations actives</p>
            </div>
            <!-- Stat 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="h-12 w-12 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path></svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">200+</h3>
                <p class="text-sm text-gray-500 mt-1 font-medium">Projets réalisés</p>
            </div>
            <!-- Stat 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="h-12 w-12 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5"></path></svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">10k+</h3>
                <p class="text-sm text-gray-500 mt-1 font-medium">Citoyens impactés</p>
            </div>
            <!-- Stat 4 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                <div class="h-12 w-12 bg-teal-100 text-teal-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <h3 class="text-3xl font-bold text-gray-900">20+</h3>
                <p class="text-sm text-gray-500 mt-1 font-medium">Domaines d'action</p>
            </div>
        </div>

        <!-- Call to Actions -->
        <div class="mt-12 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('association-et-ong') }}" class="inline-flex justify-center items-center px-8 py-4 text-base font-semibold text-white bg-teal-600 rounded-full hover:bg-teal-700 shadow-lg shadow-teal-200 transition-all">
                Consulter les Associations
            </a>
            <a href="{{ route('connexion') }}" class="inline-flex justify-center items-center px-8 py-4 text-base font-semibold text-teal-700 bg-teal-50 border-2 border-teal-100 rounded-full hover:bg-teal-100 hover:border-teal-200 transition-all">
                Espace Membre
            </a>
            <button type="button" x-data @click="$dispatch('open-review-modal')" class="inline-flex justify-center items-center px-8 py-4 text-base font-semibold text-white bg-slate-900 rounded-full hover:bg-slate-800 shadow-lg transition-all">
                Donnez votre avis
            </button>
        </div>
    </div>
</section>

<!-- À Propos Section -->
<section id="apropos" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 sm:text-4xl">Pourquoi cette Plateforme ?</h2>
            <div class="mt-4 w-24 h-1 bg-teal-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="rounded-2xl overflow-hidden shadow-xl border border-gray-100">
                <img src="{{ asset('/img1/4469bddf-fb4a-4003-9684-73ca66a47ad6-removebg-preview.png') }}" alt="Mairie de Cotonou" class="w-full h-auto object-cover" />
            </div>
            <div class="space-y-8">
                <!-- Feature 1 -->
                <div class="flex gap-4">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-xl bg-teal-100 text-teal-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Accès rapide aux informations</h3>
                        <p class="mt-2 text-gray-600">Retrouvez en un seul endroit toutes les associations actives, leurs projets, missions et événements passés.</p>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="flex gap-4">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-xl bg-teal-100 text-teal-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Suivi des initiatives locales</h3>
                        <p class="mt-2 text-gray-600">Suivez en temps réel l'évolution et l'impact des projets sur la communauté grâce aux évaluations.</p>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="flex gap-4">
                    <div class="flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-xl bg-teal-100 text-teal-600">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Démarches simplifiées</h3>
                        <p class="mt-2 text-gray-600">Un espace dédié pour soumettre des demandes à la mairie de façon digitalisée.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- À La Une Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-bold text-gray-900">À la Une</h2>
                <p class="mt-2 text-gray-600">Découvrez les associations qui brillent par leur impact.</p>
            </div>
            <a href="{{ route('association-et-ong') }}" class="hidden sm:flex text-teal-600 font-semibold hover:text-teal-700 items-center gap-2">
                Tout voir
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if(isset($users) && $users->count() > 0)
                @foreach ($users->take(3) as $user)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow border border-gray-100 flex flex-col h-full">
                    <img src="{{ $user->logo_path ? asset('storage/' . $user->logo_path) : asset('img/no-image.jpg') }}" alt="{{ $user->name }}" class="w-full h-48 object-cover">
                    <div class="p-6 flex-grow flex flex-col justify-between">
                        <div>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teal-100 text-teal-800 mb-2">
                                {{ Str::title($user->groupe?->value ?? 'structure') }}
                            </span>
                            <h3 class="text-xl font-bold text-gray-900 leading-tight">{{ $user->name }}</h3>
                        </div>
                        <a href="{{ route('association.details', $user->id) }}" class="mt-6 inline-flex w-full justify-center items-center px-4 py-2 border border-teal-600 text-teal-600 rounded-xl hover:bg-teal-50 transition-colors font-medium">
                            En savoir plus
                        </a>
                    </div>
                </div>
                @endforeach
            @else
                <p class="text-gray-500 italic col-span-full">Aucune association enregistrée pour le moment.</p>
            @endif
        </div>
        <div class="mt-8 sm:hidden text-center">
             <a href="{{ route('association-et-ong') }}" class="text-teal-600 font-semibold hover:text-teal-700">Consulter toutes les associations →</a>
        </div>
    </div>
</section>

<!-- Activités Récentes (Grille) -->
<section id="activite" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-12 flex flex-col sm:flex-row justify-between items-end gap-4">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Activités Récentes</h2>
            <p class="mt-2 text-gray-600">Découvrez les dernières actions menées sur le terrain par nos partenaires.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @php
            $visibleActivities = isset($users) ? collect($users)->flatMap->activities->where('is_visible', true)->sortByDesc('created_at')->take(6) : collect();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($visibleActivities as $activity)
            <a href="{{ route('activites.show', $activity->id) }}" class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-xl transition-all duration-300 group flex flex-col h-full cursor-pointer no-underline">
                <!-- Image en 16:9 -->
                <div class="relative w-full aspect-video overflow-hidden bg-gray-100">
                    <img src="{{ asset('storage/' . $activity->attachment) }}" alt="{{ $activity->titre }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 right-4 bg-white/95 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-bold text-teal-700 shadow-sm border border-white/20">
                        {{ $activity->created_at->format('d/m/Y') }}
                    </div>
                </div>
                
                <!-- Contenu de la carte -->
                <div class="p-6 flex flex-col flex-grow">
                    <!-- Auteur (ONG) -->
                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-50">
                        <img src="{{ $activity->user->logo_path ? asset('storage/' . $activity->user->logo_path) : asset('img/no-user.png') }}" class="w-10 h-10 rounded-full border-2 border-gray-100 object-cover">
                        <div class="text-xs">
                            <p class="font-bold text-gray-900 line-clamp-1 text-sm">{{ $activity->user->name }}</p>
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 leading-tight mb-3 group-hover:text-teal-600 transition-colors">{{ $activity->titre }}</h3>
                    <p class="text-sm text-gray-600 line-clamp-3 mb-4 flex-grow">{{ $activity->description }}</p>
                    
                    <!-- Bouton en bas -->
                    <div class="mt-auto pt-2">
                        <span class="text-sm font-bold text-teal-600 flex items-center gap-1 group-hover:text-teal-700">
                            Découvrir
                            <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </span>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                <div class="mx-auto w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <p class="text-gray-500 font-medium">Aucune activité publique pour le moment.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Derniers Avis du Public -->
<section class="py-20 bg-teal-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Derniers retours citoyens</h2>
            <p class="mt-2 text-gray-600">Ce que le public pense des initiatives locales.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestReviews as $review)
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col h-full">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <span class="font-bold text-gray-900 block">{{ $review->author_name }}</span>
                        <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                    </div>
                    <div class="flex">
                        @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                </div>
                
                <div class="mb-4 bg-gray-50 p-3 rounded-lg">
                    <span class="text-xs font-bold text-gray-400 uppercase tracking-wider block mb-1">Concerne</span>
                    <a href="{{ route('association.details', $review->user_id) }}" class="text-sm font-bold text-teal-700 hover:underline block">
                        {{ $review->user->name }}
                    </a>
                    @if($review->activity)
                        <span class="text-sm text-gray-600 block mt-1"><span class="font-medium text-gray-900">Activité :</span> {{ $review->activity->titre }}</span>
                    @else
                        <span class="text-sm text-gray-500 italic block mt-1">Avis général sur l'ONG</span>
                    @endif
                </div>

                <p class="text-gray-600 text-sm italic flex-grow">"{{ $review->comment }}"</p>
            </div>
            @empty
            <div class="col-span-full text-center py-8">
                <p class="text-gray-500 italic">Aucun avis publié pour le moment. Soyez le premier à partager votre expérience !</p>
                <button type="button" x-data @click="$dispatch('open-review-modal')" class="mt-4 px-6 py-2 bg-slate-900 text-white rounded-full font-semibold hover:bg-slate-800">Laisser un avis</button>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- FAQ Section avec Alpine.js -->
<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900">Questions Fréquentes</h2>
        </div>
        
        <div class="space-y-4">
            <!-- Item 1 -->
            <details class="group bg-white rounded-xl shadow-sm border border-gray-100 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between p-6 cursor-pointer font-medium text-gray-900">
                    <span>Comment consulter la liste des associations ?</span>
                    <span class="transition group-open:rotate-180">
                        <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-600">
                    Allez sur la page "Associations et ONG" via le menu. Vous y trouverez une barre de recherche pour filtrer par domaine ou nom.
                </div>
            </details>
            
            <!-- Item 2 -->
            <details class="group bg-white rounded-xl shadow-sm border border-gray-100 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between p-6 cursor-pointer font-medium text-gray-900">
                    <span>Comment s'enregistrer en tant qu'ONG ?</span>
                    <span class="transition group-open:rotate-180">
                        <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-600">
                    Cliquez sur "Connexion membre" puis sur le bouton "S'inscrire". Remplissez les formulaires étape par étape pour soumettre votre dossier à la Mairie.
                </div>
            </details>

            <!-- Item 3 -->
            <details class="group bg-white rounded-xl shadow-sm border border-gray-100 [&_summary::-webkit-details-marker]:hidden">
                <summary class="flex items-center justify-between p-6 cursor-pointer font-medium text-gray-900">
                    <span>Comment soumettre une demande d'accompagnement ?</span>
                    <span class="transition group-open:rotate-180">
                        <svg class="w-5 h-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </span>
                </summary>
                <div class="px-6 pb-6 text-gray-600">
                    Une fois connecté à votre espace membre, cliquez sur "Demande" dans le menu latéral et suivez les instructions.
                </div>
            </details>
        </div>
    </div>
</section>

<!-- Scroller CSS cache scrollbar horizontal -->
<style>
    .hide-scrollbars::-webkit-scrollbar { display: none; }
    .hide-scrollbars { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<!-- MODAL GLOBALE D'AVIS -->
<div 
    x-data="{ 
        show: false,
        selectedAssociation: '',
        activities: [],
        isLoading: false,
        
        init() {
            this.$watch('selectedAssociation', (value) => {
                this.activities = [];
                if (value) {
                    this.loadActivities(value);
                }
            });
        },
        
        async loadActivities(id) {
            this.isLoading = true;
            try {
                let response = await fetch('/api/associations/' + id + '/activities');
                this.activities = await response.json();
            } catch (e) {
                console.error(e);
            }
            this.isLoading = false;
        }
    }"
    @open-review-modal.window="show = true"
>
    <div x-show="show" style="display: none;" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div @click.away="show = false" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-xl border border-gray-100">
                    <form action="{{ route('reviews.storeFromHome') }}" method="POST">
                        @csrf
                        <input type="text" name="website" tabindex="-1" autocomplete="off" class="hidden" aria-hidden="true">
                        <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
                            <h3 class="text-2xl font-black text-gray-900 mb-6" id="modal-title">Partagez votre expérience</h3>
                            
                            @if(session('success'))
                                <div class="bg-green-50 text-green-700 px-4 py-3 rounded-xl border border-green-200 shadow-sm mb-6 text-sm font-medium">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="space-y-5">
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Quelle association concerne votre avis ? <span class="text-red-500">*</span></label>
                                    <select name="user_id" x-model="selectedAssociation" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors">
                                        <option value="">-- Sélectionnez une ONG / Association --</option>
                                        @foreach($users as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div x-show="selectedAssociation" x-transition>
                                    <label class="block text-sm font-bold text-gray-700 mb-1 flex justify-between">
                                        <span>Sur quelle activité spécifiquement ?</span>
                                        <span x-show="isLoading" class="text-teal-600 text-xs italic">Chargement...</span>
                                    </label>
                                    <select name="activity_id" class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors">
                                        <option value="">Avis général sur l'association (Aucune activité spécifique)</option>
                                        <template x-for="activity in activities" :key="activity.id">
                                            <option :value="activity.id" x-text="activity.titre"></option>
                                        </template>
                                    </select>
                                    <p class="text-xs text-gray-500 mt-1">Laissez ce champ vide si votre avis concerne l'association en général.</p>
                                </div>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Votre Nom / Pseudo <span class="text-red-500">*</span></label>
                                        <input type="text" name="author_name" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors" placeholder="Ex: Jean D.">
                                    </div>
                                    
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-1">Note (sur 5) <span class="text-red-500">*</span></label>
                                        <select name="rating" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors">
                                            <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                                            <option value="4">⭐⭐⭐⭐ Très bien</option>
                                            <option value="3">⭐⭐⭐ Correct</option>
                                            <option value="2">⭐⭐ Moyen</option>
                                            <option value="1">⭐ Médiocre</option>
                                        </select>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Votre commentaire <span class="text-red-500">*</span></label>
                                    <textarea name="comment" rows="4" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors placeholder-gray-400" placeholder="Racontez-nous votre expérience..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 sm:px-8 border-t border-gray-100 flex flex-col-reverse sm:flex-row justify-end gap-3">
                            <button type="button" @click="show = false" class="w-full sm:w-auto px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
                                Annuler
                            </button>
                            <button type="submit" class="w-full sm:w-auto px-6 py-3 bg-slate-900 text-white font-bold rounded-xl shadow-md hover:bg-slate-800 transition-colors">
                                Publier l'avis
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
