@extends('layouts.admin')

@section('content')
<section class="py-6" x-data="{ domaine: '{{ old('domaine', '') }}' }">
    <div class="max-w-4xl mx-auto">
        
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-teal-700 px-8 py-8 text-white relative">
                <h2 class="text-3xl font-black mb-2">Inscrire une Association / ONG</h2>
                <p class="text-teal-100">Informations générales, Adresse & Contact (Étape 1 sur 3)</p>
                <div class="mt-8 relative">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-teal-900">
                        <div style="width: 33%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-teal-400"></div>
                    </div>
                </div>
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

                <form method="POST" action="{{ route('admin.createUserType1') }}" class="space-y-8">
                    @csrf
                    
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-teal-100 text-teal-700 text-xs font-black">1</span>
                        Informations Générales
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Nom de la structure <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Catégorie <span class="text-red-500">*</span></label>
                            <select name="groupe" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Choisir...</option>
                                @foreach(\App\Enums\UserGroup::cases() as $group)
                                    <option value="{{ $group->value }}" {{ old('groupe') == $group->value ? 'selected' : '' }}>{{ Str::title($group->value) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Acronyme / Sigle <span class="text-red-500">*</span></label>
                            <input type="text" name="denomination" value="{{ old('denomination') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
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
                                    <option value="{{ $d }}" {{ old('domaine') == $d ? 'selected' : '' }}>{{ $d }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="md:col-span-2" x-show="domaine === 'Autre'" x-transition>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Précisez votre domaine <span class="text-red-500">*</span></label>
                            <input type="text" name="domaine_autre" value="{{ old('domaine_autre') }}" class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm" :required="domaine === 'Autre'">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Date de création légale <span class="text-red-500">*</span></label>
                            <input type="date" name="date" value="{{ old('date') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Site Web / Réseaux sociaux</label>
                            <input type="url" name="lien" value="{{ old('lien') }}" placeholder="https://..." class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>
                    </div>

                    <hr class="border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-teal-100 text-teal-700 text-xs font-black">2</span>
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
                                    <option value="{{ $i }}ème Arrondissement" {{ old('arrondissement') == $i.'ème Arrondissement' ? 'selected' : '' }}>{{ $i }}{{ $i == 1 ? 'er' : 'ème' }} Arrondissement</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Quartier <span class="text-red-500">*</span></label>
                            <input type="text" name="quartier" value="{{ old('quartier') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Maison / Repère <span class="text-red-500">*</span></label>
                            <input type="text" name="maison" value="{{ old('maison') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                        </div>
                    </div>

                    <hr class="border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-teal-100 text-teal-700 text-xs font-black">3</span>
                        Contact
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Adresse e-mail <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Téléphone principal <span class="text-red-500">*</span></label>
                            <input type="text" name="number1" value="{{ old('number1') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Téléphone secondaire <span class="text-gray-400 text-xs font-normal">(optionnel)</span></label>
                            <input type="text" name="number2" value="{{ old('number2') }}" class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                        </div>
                    </div>

                    <hr class="border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-teal-100 text-teal-700 text-xs font-black">4</span>
                        Objectifs Principaux (5 obligatoires)
                    </h3>
                    <div class="space-y-4">
                        @for($i = 0; $i < 5; $i++)
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Objectif {{ $i + 1 }} <span class="text-red-500">*</span></label>
                            <input type="text" name="objectifs[]" value="{{ old('objectifs.'.$i) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl sm:text-sm">
                        </div>
                        @endfor
                    </div>

                    <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-800 font-medium text-sm">← Retour au tableau de bord</a>
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-md">Suivant : Membres (2/3) →</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
