@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <!-- Bouton Retour -->
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.associations.index') }}" class="text-slate-500 hover:text-teal-600 transition-colors flex items-center gap-2 font-medium bg-white px-4 py-2 rounded-xl shadow-sm border border-gray-200">
            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Retour aux structures
        </a>
    </div>

    <!-- Carte principale -->
    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden" x-data="{ domaine: '{{ old('domaine', $user->domaine) }}' }">
        <div class="bg-teal-700 px-8 py-8 text-white relative">
            <h2 class="text-3xl font-black mb-2">Modifier l'association</h2>
            <p class="text-teal-100">{{ $user->name }}</p>
        </div>

        <div class="p-8">
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                    <ul class="text-sm text-red-700 list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.update', $user->id) }}" class="space-y-8">
                @csrf
                
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Informations Générales
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nom de la structure <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Catégorie <span class="text-red-500">*</span></label>
                        <select name="groupe" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            <option value="">Choisir...</option>
                            @foreach(\App\Enums\UserGroup::cases() as $group)
                                <option value="{{ $group->value }}" {{ old('groupe', $user->groupe?->value) == $group->value ? 'selected' : '' }}>{{ Str::title($group->value) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Acronyme / Sigle <span class="text-red-500">*</span></label>
                        <input type="text" name="denomination" value="{{ old('denomination', $user->denomination) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Domaine d'intervention <span class="text-red-500">*</span></label>
                        <select name="domaine" x-model="domaine" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            <option value="">Choisir un domaine...</option>
                            @php
                            $domaines = [
                                'Sport de masse et d\'animation','Sport au féminin','Sport-Loisir et Fitness',
                                'Sport et Handicap (handisport, sport adapté)','Sport et Éducation (sport scolaire, périscolaire)',
                                'Sport et Santé (activités physiques adaptées)','Sport et Numérique (e-sport, innovation digitale)',
                                'Sport et Environnement (éco-sport, activités nature)','Sport et Culture (danses traditionnelles, arts martiaux)',
                                'Sport et Tourisme (randonnée, activités balnéaires)','Sport de haut niveau et élite',
                                'Sport et Citoyenneté (fair-play, valeurs olympiques)','Formation et Certification (arbitres, entraîneurs)',
                                'Médecine et Sciences du sport','Infrastructure et Équipements sportifs','Sport et Développement local',
                                'Gestion et Administration sportive','Sport et Médias (communication, promotion)',
                                'Sport et Économie (entrepreneuriat sportif)','Sport et Sécurité (prévention, secourisme sportif)',
                                'Sport et Coopération internationale','Sport et Jeunesse (animation, insertion)',
                                'Sport et 3ème âge (activités seniors)','Sport et Nutrition','Sport et Psychologie (performance mentale)',
                                'Sport et Droit (réglementation, contentieux)','Sport et Genre (égalité, mixité)',
                                'Sport et Patrimoine (jeux traditionnels)','Sport et Recherche (R&D, innovation)',
                                'Sport et Technologie (wearables, data)','Sport et Solidarité (actions humanitaires)','Autre',
                            ];
                            @endphp
                            @foreach($domaines as $d)
                                <option value="{{ $d }}" {{ old('domaine', $user->domaine) == $d ? 'selected' : '' }}>{{ $d }}</option>
                            @endforeach
                            @if(!in_array($user->domaine, $domaines) && $user->domaine)
                                <option value="Autre" selected>Autre</option>
                            @endif
                        </select>
                    </div>
                    <div class="md:col-span-2" x-show="domaine === 'Autre'" x-transition>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Précisez votre domaine <span class="text-red-500">*</span></label>
                        <input type="text" name="domaine_autre" value="{{ old('domaine_autre', !in_array($user->domaine, $domaines) ? $user->domaine : '') }}" class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm" :required="domaine === 'Autre'">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Date de création légale <span class="text-red-500">*</span></label>
                        <input type="date" name="date" value="{{ old('date', $user->date ? \Carbon\Carbon::parse($user->date)->format('Y-m-d') : '') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Site Web / Réseaux sociaux</label>
                        <input type="url" name="lien" value="{{ old('lien', $user->lien) }}" placeholder="https://..." class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                    </div>
                </div>

                <hr class="border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    Adresse du Siège
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Commune <span class="text-red-500">*</span></label>
                        <select name="commune" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                            <option value="Cotonou" selected>Cotonou</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Arrondissement <span class="text-red-500">*</span></label>
                        <select name="arrondissement" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                            <option value="">Choisir...</option>
                            @for($i = 1; $i <= 13; $i++)
                                <option value="{{ $i }}ème Arrondissement" {{ old('arrondissement', $user->arrondissement) == $i.'ème Arrondissement' ? 'selected' : '' }}>{{ $i }}{{ $i == 1 ? 'er' : 'ème' }} Arrondissement</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Quartier <span class="text-red-500">*</span></label>
                        <input type="text" name="quartier" value="{{ old('quartier', $user->quartier) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Maison / Repère <span class="text-red-500">*</span></label>
                        <input type="text" name="maison" value="{{ old('maison', $user->maison) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                    </div>
                </div>

                <hr class="border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Contact
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-gray-700 mb-1">Adresse e-mail <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Téléphone principal <span class="text-red-500">*</span></label>
                        <input type="text" name="number1" value="{{ old('number1', $user->number1) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Téléphone secondaire <span class="text-gray-400 text-xs font-normal">(optionnel)</span></label>
                        <input type="text" name="number2" value="{{ old('number2', $user->number2) }}" class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                    </div>
                </div>

                <div class="flex justify-end pt-6 border-t border-gray-100">
                    <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-md">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
