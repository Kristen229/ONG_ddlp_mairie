@extends('layouts.app')

@section('content')
<!-- Header Section -->
<section class="bg-blue-700 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">Associations et ONG de Cotonou</h1>
        <p class="text-lg text-blue-100 max-w-2xl mx-auto">
            Découvrez toutes les associations et Organisations Non Gouvernementales actives dans la commune. Filtrez par domaine ou recherchez un nom spécifique.
        </p>
    </div>
</section>

<!-- Search and Filter Section -->
<section class="py-8 bg-gray-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form action="{{ route('association-et-ong') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-center">
            
            <!-- Search Input -->
            <div class="relative w-full md:w-1/2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher une association..." 
                       class="block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-xl leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition">
            </div>

            <!-- Domaine Filter -->
            <div class="w-full md:w-1/4">
                <select name="domaine" class="block w-full py-3 px-4 border border-gray-300 rounded-xl bg-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500 transition">
                    <option value="">Tous les domaines</option>
                    @foreach($domaines as $d)
                        <option value="{{ $d }}" {{ request('domaine') == $d ? 'selected' : '' }}>{{ $d }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="w-full md:w-auto px-6 py-3 bg-blue-600 text-white font-medium rounded-xl hover:bg-blue-700 transition">
                Filtrer
            </button>
            
            @if(request('search') || request('domaine'))
                <a href="{{ route('association-et-ong') }}" class="w-full md:w-auto px-6 py-3 bg-gray-200 text-gray-700 font-medium rounded-xl hover:bg-gray-300 transition text-center">
                    Réinitialiser
                </a>
            @endif
        </form>
    </div>
</section>

<!-- List Section -->
<section class="py-12 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if(isset($users) && $users->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($users as $user)
                    <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-shadow border border-gray-100 flex flex-col h-full">
                        
                        <!-- Image ou Placeholder -->
                        <div class="relative h-48 bg-gray-100 border-b border-gray-100">
                            @if($user->logo_path)
                                <img src="{{ asset('storage/' . $user->logo_path) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                            @else
                                <div class="flex items-center justify-center w-full h-full text-gray-300">
                                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                </div>
                            @endif
                            <!-- Badge Type (ONG / ASSOC / FONDATION) -->
                            <div class="absolute top-4 right-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-white/90 text-blue-800 shadow-sm backdrop-blur-sm">
                                    {{ Str::upper($user->groupe ? $user->groupe->value : 'ONG') }}
                                </span>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6 flex-grow flex flex-col justify-between">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 leading-tight mb-2">{{ $user->name }}</h3>
                                
                                <div class="flex items-start gap-2 text-sm text-gray-500 mb-2">
                                    <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    <span class="line-clamp-2"><span class="font-semibold text-gray-700">Domaine :</span> {{ is_array($user->domaine) ? implode(', ', $user->domaine) : $user->domaine }}</span>
                                </div>
                                
                                @if($user->commune)
                                <div class="flex items-start gap-2 text-sm text-gray-500 mb-4">
                                    <svg class="w-5 h-5 text-blue-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span class="line-clamp-1"><span class="font-semibold text-gray-700">Siège :</span> {{ $user->arrondissement }}, {{ $user->commune }}</span>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Action button -->
                            <div class="mt-6">
                                <a href="{{ route('association.details', $user->id) }}" class="inline-flex w-full justify-center items-center px-4 py-2 bg-blue-50 text-blue-700 border border-blue-100 rounded-xl hover:bg-blue-100 hover:border-blue-200 transition-colors font-semibold group">
                                    En savoir plus
                                    <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination de Laravel stylisée -->
            @if(method_exists($users, 'links'))
                <div class="mt-12">
                    {{ $users->links() }}
                </div>
            @endif

        @else
            <!-- Empty State : Si aucune ONG ou recherche sans résultat -->
            <div class="text-center py-16 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-4 text-xl font-medium text-gray-900">Aucun résultat trouvé</h3>
                <p class="mt-2 text-gray-500">Nous n'avons trouvé aucune association correspondant à tes critères actuels.</p>
                <div class="mt-6">
                    <a href="{{ route('association-et-ong') }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-blue-700 bg-blue-100 hover:bg-blue-200 transition">
                        Effacer les filtres
                    </a>
                </div>
            </div>
        @endif

    </div>
</section>
@endsection
