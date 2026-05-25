@extends('layouts.app')

@section('content')
<div class="bg-gray-50 min-h-screen py-12" x-data="{ showReviewModal: false }">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- HEADER ASSOCIATION -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-200 overflow-hidden mb-8 relative">
            <div class="h-40 bg-gradient-to-r from-teal-700 to-green-600"></div>
            <div class="px-8 pb-8 relative">
                <div class="flex flex-col sm:flex-row items-center sm:items-end -mt-16 sm:-mt-20 gap-6">
                    <div class="h-32 w-32 sm:h-40 sm:w-40 rounded-full border-4 border-white bg-white shadow-md overflow-hidden flex-shrink-0">
                        @if($user->logo_path)
                            <img src="{{ asset('storage/' . $user->logo_path) }}" alt="Logo" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-teal-50 flex items-center justify-center text-teal-600 font-bold text-4xl">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                    <div class="text-center sm:text-left flex-grow">
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-teal-50 text-teal-700 mb-2 uppercase tracking-wider">
                            {{ $user->groupe ? Str::title($user->groupe->value) : 'ONG' }}
                        </div>
                        <h1 class="text-4xl font-black text-gray-900 mb-1">{{ $user->name }}</h1>
                        <p class="text-gray-500 font-medium text-lg">{{ $user->domaine }}</p>
                    </div>
                    
                    @if(session('success'))
                        <div class="bg-green-50 text-green-700 px-4 py-3 rounded-xl border border-green-200 shadow-sm mt-4 sm:mt-0 text-sm font-medium flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- COLONNE DE GAUCHE : INFOS & AVIS -->
            <div class="lg:col-span-1 space-y-8">
                
                <!-- CONTACT & INFOS -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-3">Informations Pratiques</h3>
                    <div class="space-y-4 text-sm">
                        @if($user->commune)
                        <div class="flex items-start gap-3 text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            <div>
                                <span class="block font-bold text-gray-900">Siège social</span>
                                {{ $user->arrondissement }}, {{ $user->commune }}
                            </div>
                        </div>
                        @endif

                        @if($user->email)
                        <div class="flex items-start gap-3 text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            <div>
                                <span class="block font-bold text-gray-900">Email de contact</span>
                                <a href="mailto:{{ $user->email }}" class="text-teal-600 hover:underline">{{ $user->email }}</a>
                            </div>
                        </div>
                        @endif

                        @if($user->number1)
                        <div class="flex items-start gap-3 text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            <div>
                                <span class="block font-bold text-gray-900">Téléphone</span>
                                {{ $user->number1 }} @if($user->number2) / {{ $user->number2 }} @endif
                            </div>
                        </div>
                        @endif
                        
                        @if($user->lien)
                        <div class="flex items-start gap-3 text-gray-600">
                            <svg class="w-5 h-5 text-teal-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                            <div>
                                <span class="block font-bold text-gray-900">Site Web / Réseaux</span>
                                <a href="{{ $user->lien }}" target="_blank" class="text-teal-600 hover:underline break-all">{{ $user->lien }}</a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- SECTION AVIS (REVIEWS) -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col">
                    <div class="flex justify-between items-center mb-4 border-b border-gray-100 pb-3">
                        <h3 class="text-lg font-bold text-gray-900">Avis du public</h3>
                        @php
                            $avgRating = $user->reviews->count() > 0 ? round($user->reviews->avg('rating'), 1) : 0;
                        @endphp
                        <div class="flex items-center gap-1 bg-gray-50 px-2 py-1 rounded-lg">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span class="font-bold text-gray-900">{{ $avgRating > 0 ? $avgRating : '-' }}</span>
                            <span class="text-xs text-gray-500">/ 5</span>
                        </div>
                    </div>

                    <div class="space-y-4 mb-6 flex-grow max-h-96 overflow-y-auto pr-2">
                        @forelse($user->reviews as $review)
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                            <div class="flex justify-between items-start mb-2">
                                <span class="font-bold text-gray-900 text-sm">{{ $review->author_name }}</span>
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3 h-3 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-sm text-gray-600">{{ $review->comment }}</p>
                            <span class="text-xs text-gray-400 mt-2 block">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        @empty
                        <div class="text-center py-6">
                            <p class="text-gray-500 text-sm">Aucun avis pour le moment.</p>
                        </div>
                        @endforelse
                    </div>

                    <button type="button" @click.prevent="showReviewModal = true" class="w-full py-2.5 bg-slate-900 hover:bg-slate-800 text-white font-bold rounded-xl text-sm transition-colors shadow-sm">
                        Laisser un avis public
                    </button>
                </div>

            </div>

            <!-- COLONNE DE DROITE : OBJECTIFS & ACTIVITÉS -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- OBJECTIFS -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-2xl font-black text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        Missions et Objectifs
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        @php
                            $objectifs = is_string($user->objectifs) ? json_decode($user->objectifs, true) : ($user->objectifs ?? []);
                        @endphp
                        @forelse($objectifs as $index => $objectif)
                        <div class="bg-gray-50 p-5 rounded-xl border border-gray-100">
                            <span class="w-8 h-8 rounded-full bg-teal-100 text-teal-700 font-black flex items-center justify-center mb-3">{{ $index + 1 }}</span>
                            <p class="text-gray-700 text-sm">{{ $objectif }}</p>
                        </div>
                        @empty
                        <div class="col-span-full text-gray-500 text-sm">Aucun objectif défini.</div>
                        @endforelse
                    </div>
                </div>

                <!-- ACTIVITÉS RÉCENTES -->
                <div>
                    <h2 class="text-2xl font-black text-gray-900 mb-6">Activités Récentes</h2>
                    
                    @if($user->activities && $user->activities->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($user->activities as $activity)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                                <div class="h-48 relative overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $activity->attachment) }}" class="w-full h-full object-cover transition-transform duration-500 hover:scale-105">
                                </div>
                                <div class="p-6 flex-grow flex flex-col justify-between">
                                    <div>
                                        <h4 class="font-bold text-gray-900 text-xl mb-2">{{ $activity->titre }}</h4>
                                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ $activity->description }}</p>
                                    </div>
                                    <div class="text-xs font-bold text-teal-600 bg-teal-50 self-start px-3 py-1 rounded-lg">
                                        {{ $activity->created_at->translatedFormat('d F Y') }}
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-white rounded-2xl shadow-sm border border-dashed border-gray-300 p-12 text-center">
                            <div class="w-16 h-16 bg-gray-50 rounded-full mx-auto flex items-center justify-center mb-4">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-1">Aucune activité publiée</h3>
                            <p class="text-gray-500 text-sm">Cette structure n'a pas encore partagé d'activités publiques.</p>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- MODAL AJOUT AVIS -->
    <div x-show="showReviewModal" style="display: none;" class="relative z-50" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <!-- Background backdrop -->
        <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"></div>

        <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <!-- Modal panel -->
                <div @click.away="showReviewModal = false" class="relative transform overflow-hidden rounded-3xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100">
                    <form action="{{ route('reviews.store', $user->id) }}" method="POST">
                        @csrf
                        <div class="bg-white px-6 pt-6 pb-4 sm:p-8 sm:pb-4">
                            <h3 class="text-2xl font-black text-gray-900 mb-6" id="modal-title">Laisser un avis</h3>
                            
                            <div class="space-y-5">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Votre Nom / Pseudo <span class="text-red-500">*</span></label>
                                    <input type="text" name="author_name" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors" placeholder="Ex: Jean Dupont">
                                </div>
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Note (sur 5) <span class="text-red-500">*</span></label>
                                    <select name="rating" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors">
                                        <option value="5">⭐⭐⭐⭐⭐ Excellent (5/5)</option>
                                        <option value="4">⭐⭐⭐⭐ Très bien (4/5)</option>
                                        <option value="3">⭐⭐⭐ Correct (3/5)</option>
                                        <option value="2">⭐⭐ Moyen (2/5)</option>
                                        <option value="1">⭐ Médiocre (1/5)</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-1">Votre commentaire <span class="text-red-500">*</span></label>
                                    <textarea name="comment" rows="4" required class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors placeholder-gray-400" placeholder="Partagez votre expérience avec cette association..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-6 py-4 sm:px-8 border-t border-gray-100 flex flex-col-reverse sm:flex-row justify-end gap-3">
                            <button type="button" @click="showReviewModal = false" class="w-full sm:w-auto px-6 py-3 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors">
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
