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
    <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden" x-data="{ domaine: {{ json_encode(old('domaine', $user->domaines->pluck('nom')->all())) }} }">
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
                        <label class="block text-base font-bold text-gray-700 mb-1">Nom de la structure <span class="text-red-500">*</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                    </div>
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-1">Catégorie <span class="text-red-500">*</span></label>
                        <select name="groupe" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                            <option value="">Choisir...</option>
                            @foreach(\App\Enums\UserGroup::cases() as $group)
                                <option value="{{ $group->value }}" {{ old('groupe', $user->groupe?->value) == $group->value ? 'selected' : '' }}>{{ Str::title($group->value) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-1">Acronyme / Sigle <span class="text-red-500">*</span></label>
                        <input type="text" name="denomination" value="{{ old('denomination', $user->denomination) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                    </div>
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
                            $userDomaines = old('domaine', $user->domaines->pluck('nom')->all());
                            $hasAutre = false;
                            foreach($userDomaines as $ud) {
                                if (!in_array($ud, $domaines) && $ud !== 'Autre') {
                                    $hasAutre = true;
                                }
                            }
                            if ($hasAutre && !in_array('Autre', $userDomaines)) {
                                $userDomaines[] = 'Autre';
                            }
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
                        <input type="checkbox" class="sr-only" required :checked="domaine.length > 0">
                    </div>
                    <div class="md:col-span-2" x-show="Array.isArray(domaine) ? domaine.includes('Autre') : false" x-transition>
                        <label class="block text-base font-bold text-gray-700 mb-1">Précisez votre domaine <span class="text-red-500">*</span></label>
                        <input type="text" name="domaine_autre" value="{{ old('domaine_autre', $hasAutre ? collect($userDomaines)->reject(fn($d) => in_array($d, $domaines) || $d === 'Autre')->first() : '') }}" class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base" :required="Array.isArray(domaine) ? domaine.includes('Autre') : false">
                    </div>
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-1">Date de création légale <span class="text-red-500">*</span></label>
                        <input type="date" name="date" value="{{ old('date', $user->date ? \Carbon\Carbon::parse($user->date)->format('Y-m-d') : '') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                    </div>
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-1">Site Web / Réseaux sociaux</label>
                        <input type="url" name="lien" value="{{ old('lien', $user->lien) }}" placeholder="https://..." class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 text-base">
                    </div>
                </div>

                <hr class="border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                    Adresse du Siège
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-1">Commune <span class="text-red-500">*</span></label>
                        <select name="commune" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                            <option value="Cotonou" selected>Cotonou</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-1">Arrondissement <span class="text-red-500">*</span></label>
                        <select name="arrondissement" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                            <option value="">Choisir...</option>
                            @for($i = 1; $i <= 13; $i++)
                                <option value="{{ $i }}ème Arrondissement" {{ old('arrondissement', $user->arrondissement) == $i.'ème Arrondissement' ? 'selected' : '' }}>{{ $i }}{{ $i == 1 ? 'er' : 'ème' }} Arrondissement</option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-1">Quartier <span class="text-red-500">*</span></label>
                        <input type="text" name="quartier" value="{{ old('quartier', $user->quartier) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                    </div>
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-1">Maison / Repère <span class="text-red-500">*</span></label>
                        <input type="text" name="maison" value="{{ old('maison', $user->maison) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                    </div>
                </div>

                <hr class="border-gray-200">
                <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                    <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Contact
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-base font-bold text-gray-700 mb-1">Adresse e-mail <span class="text-red-500">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                    </div>
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-1">Téléphone principal <span class="text-red-500">*</span></label>
                        <input type="text" name="number1" value="{{ old('number1', $user->number1) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                    </div>
                    <div>
                        <label class="block text-base font-bold text-gray-700 mb-1">Téléphone secondaire <span class="text-gray-400 text-sm font-normal">(optionnel)</span></label>
                        <input type="text" name="number2" value="{{ old('number2', $user->number2) }}" class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
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
