@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-12 min-h-screen" x-data="{ domaine: {{ json_encode(old('domaine', [])) }} }">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Carte principale -->
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- En-tête et Stepper -->
            <div class="bg-teal-700 px-8 py-8 text-white relative">
                <h2 class="text-3xl font-black mb-2">Inscription de votre structure</h2>
                <p class="text-teal-100">Informations générales, Adresse & Contact (Étape 1 sur 3)</p>
                
                <!-- Barre de progression -->
                <div class="mt-8 relative">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-teal-900">
                        <div style="width: 33%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-teal-400"></div>
                    </div>
                </div>
            </div>

            <!-- Formulaire -->
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

                <form method="POST" action="{{ route('user.createUserPartie1') }}" class="space-y-8">
                    @csrf
                    
                    {{-- ===== SECTION 1 : INFORMATIONS GÉNÉRALES ===== --}}
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-teal-100 text-teal-700 text-xs font-black">1</span>
                        Informations Générales
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom de la structure -->
                        <div class="md:col-span-2">
                            <label class="block text-base font-bold text-gray-700 mb-1">Nom de la structure <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>

                        <!-- Catégorie (Group) -->
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Catégorie <span class="text-red-500">*</span></label>
                            <select name="groupe" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                                <option value="">Choisir une catégorie...</option>
                                @foreach(\App\Enums\UserGroup::cases() as $group)
                                    <option value="{{ $group->value }}" {{ old('groupe') == $group->value ? 'selected' : '' }}>
                                        {{ Str::title($group->value) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Acronyme / Sigle -->
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Acronyme / Sigle <span class="text-red-500">*</span></label>
                            <input type="text" name="denomination" value="{{ old('denomination') }}" placeholder="Ex: DDLP" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>

                        <!-- Domaine d'intervention -->
                        <div class="md:col-span-2">
                            <label class="block text-base font-bold text-gray-700 mb-3">Domaines d'intervention (Cochez toutes les cases applicables) <span class="text-red-500">*</span></label>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 max-h-96 overflow-y-auto p-2 border border-gray-200 rounded-xl bg-gray-50/50">
                                @php
                                $domaines = [
                                    "Sport de masse et d'animation (tournois locaux, maracana, football, basketball)",
                                    "Sport au féminin (promotion du sport chez les filles, lutte contre les stéréotypes)",
                                    "Sport-Loisir et Fitness (clubs de marche, gymnastique d'entretien, bien-être)",
                                    "Handisport (pratique sportive adaptée aux personnes en situation de handicap)",
                                    "Infrastructures sportives (aménagement de terrains de proximité, dons d'équipements)",
                                    "Enseignement primaire et secondaire (construction de classes, dons de fournitures, parrainages)",
                                    "Éducation des filles (maintien à l'école, lutte contre le décrochage précoce)",
                                    "Alphabétisation des adultes (cours de lecture/écriture en langues nationales : Fon, Adja, Yoruba...)",
                                    "Formation professionnelle (appui aux apprentis en couture, coiffure, mécanique, soudure)",
                                    "Soutien scolaire et Excellence (cours de renforcement, bibliothèques, prix d'excellence)",
                                    "Santé maternelle et infantile (suivi des grossesses, accouchements sécurisés, vaccination)",
                                    "Lutte contre les maladies (prévention du paludisme, du VIH/SIDA, des IST, du diabète)",
                                    "Santé sexuelle des jeunes (contraception, gestion des menstrues, éviter les grossesses précoces)",
                                    "Nutrition communautaire (lutte contre la malnutrition des enfants, bouillies enrichies)",
                                    "Santé mentale (prise en charge et déstigmatisation des troubles psychiques)",
                                    "Protection de l'enfance (lutte contre le trafic d'enfants/Vidomégons, la maltraitance)",
                                    "Droits des femmes et VBG (assistance juridique et écoute pour les victimes de violences)",
                                    "Droits des détenus (amélioration des conditions de vie en prison, réinsertion)",
                                    "Inclusion sociale (défense des droits des personnes marginalisées ou handicapées)",
                                    "Microfinance et Épargne (groupements d'épargne type AVEC pour l'autonomie des femmes)",
                                    "Agriculture et Maraîchage (appui technique aux producteurs, agroécologie, semences résilientes)",
                                    "Transformation locale (modernisation de la production de gari, huile de palme, beurre de karité)",
                                    "Entrepreneuriat des jeunes (incubateurs, aide à la création de micro-entreprises, kits d'installation)",
                                    "Eau potable (WASH) (forages, puits, gestion des points d'eau villageois)",
                                    "Assainissement et Déchets (collecte des ordures, salubrité publique, latrines scolaires)",
                                    "Biodiversité et Nature (protection des mangroves, zones humides, forêts sacrées, parcs)",
                                    "Changement climatique (reboisement, lutte contre l'érosion côtière, foyers améliorés)",
                                    "Gouvernance locale (contrôle citoyen de l'action publique, veille sur les budgets des mairies)",
                                    "Éducation civique (sensibilisation aux droits et devoirs, culture de la paix)",
                                    "Art et Patrimoine (valorisation des danses traditionnelles, artisanat d'art, festivals)",
                                    "Tourisme communautaire (écotourisme géré par les populations villageoises)",
                                    "Inclusion numérique (alphabétisation digitale, initiation informatique en milieu rural)",
                                    "Autre"
                                ];
                                @endphp
                                @foreach($domaines as $index => $d)
                                    <label class="cursor-pointer relative">
                                        <input type="checkbox" name="domaine[]" value="{{ $d }}" x-model="domaine" class="peer sr-only">
                                        <div class="h-full rounded-xl border-2 border-gray-200 bg-white p-4 transition-all hover:border-teal-300 peer-checked:border-teal-600 peer-checked:bg-teal-50 peer-focus:ring-2 peer-focus:ring-teal-500 peer-focus:ring-offset-2 flex items-start gap-3 shadow-sm">
                                            <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded border-2 border-gray-300 peer-checked:border-teal-600 peer-checked:bg-teal-600 mt-0.5 transition-colors">
                                                <svg class="h-3 w-3 text-white opacity-0 peer-checked:opacity-100" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="domaine.includes('{{ addslashes($d) }}')"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                            <span class="text-sm font-semibold text-gray-700 leading-snug">{{ $d }}</span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            <!-- Validation fallback (hidden input for required constraint if none selected) -->
                            <input type="checkbox" class="sr-only" required :checked="domaine.length > 0">
                        </div>

                        <!-- Champ "Autre" conditionnel -->
                        <div class="md:col-span-2" x-show="Array.isArray(domaine) ? domaine.includes('Autre') : domaine === 'Autre'" x-transition>
                            <label class="block text-base font-bold text-gray-700 mb-1">Précisez votre domaine <span class="text-red-500">*</span></label>
                            <input type="text" name="domaine_autre" value="{{ old('domaine_autre') }}" placeholder="Décrivez votre domaine d'intervention..." class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base" :required="Array.isArray(domaine) ? domaine.includes('Autre') : domaine === 'Autre'">
                        </div>

                        <!-- Date de création légale -->
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Date de création légale <span class="text-red-500">*</span></label>
                            <input type="date" name="date" value="{{ old('date') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>

                        <!-- Lien site web -->
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Site Web / Réseaux sociaux</label>
                            <input type="url" name="lien" value="{{ old('lien') }}" placeholder="https://..." class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    {{-- ===== SECTION 2 : ADRESSE ===== --}}
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-teal-100 text-teal-700 text-xs font-black">2</span>
                        Adresse du Siège
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Commune -->
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Commune <span class="text-red-500">*</span></label>
                            <select name="commune" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                                <option value="Cotonou" selected>Cotonou</option>
                            </select>
                        </div>

                        <!-- Arrondissement -->
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Arrondissement <span class="text-red-500">*</span></label>
                            <select name="arrondissement" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                                <option value="">Choisir un arrondissement...</option>
                                @for($i = 1; $i <= 13; $i++)
                                    <option value="{{ $i }}ème Arrondissement" {{ old('arrondissement') == $i.'ème Arrondissement' ? 'selected' : '' }}>{{ $i }}{{ $i == 1 ? 'er' : 'ème' }} Arrondissement</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Quartier -->
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Quartier <span class="text-red-500">*</span></label>
                            <input type="text" name="quartier" value="{{ old('quartier') }}" placeholder="Nom du quartier" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>

                        <!-- Maison / Repère -->
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Maison / Repère <span class="text-red-500">*</span></label>
                            <input type="text" name="maison" value="{{ old('maison') }}" placeholder="Lot, immeuble, repère..." required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    {{-- ===== SECTION 3 : CONTACT ===== --}}
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-teal-100 text-teal-700 text-xs font-black">3</span>
                        Contact
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label class="block text-base font-bold text-gray-700 mb-1">Adresse e-mail <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>

                        <!-- Téléphone 1 -->
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Téléphone principal <span class="text-red-500">*</span></label>
                            <input type="text" name="number1" value="{{ old('number1') }}" placeholder="+229 XX XX XX XX" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>

                        <!-- Téléphone 2 -->
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Téléphone secondaire <span class="text-gray-400 text-sm font-normal">(optionnel)</span></label>
                            <input type="text" name="number2" value="{{ old('number2') }}" placeholder="+229 XX XX XX XX" class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    {{-- ===== SECTION 4 : OBJECTIFS ===== --}}
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-teal-100 text-teal-700 text-xs font-black">4</span>
                        Objectifs Principaux (5 obligatoires)
                    </h3>
                    <div class="space-y-4">
                        @for($i = 0; $i < 5; $i++)
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Objectif {{ $i + 1 }} <span class="text-red-500">*</span></label>
                            <input type="text" name="objectifs[]" value="{{ old('objectifs.'.$i) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base" placeholder="Décrivez l'objectif {{ $i + 1 }}">
                        </div>
                        @endfor
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('user.login') }}" class="text-teal-600 hover:text-teal-800 font-medium text-sm">
                            ← Retour à la connexion
                        </a>
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-md">
                            Suivant : Membres du bureau (2/3) →
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
