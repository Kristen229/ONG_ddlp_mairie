@extends('layouts.admin')

@section('content')
<section class="py-6" x-data="{ domaine: {{ json_encode(old('domaine', [])) }} }">
    <div class="max-w-4xl mx-auto">
        
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <div class="bg-blue-700 px-8 py-8 text-white relative">
                <h2 class="text-3xl font-black mb-2">Inscrire une Association / ONG</h2>
                <p class="text-blue-100">Informations générales, Adresse & Contact (Étape 1 sur 3)</p>
                <div class="mt-8 relative">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-blue-900">
                        <div style="width: 33%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-400"></div>
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
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-blue-100 text-blue-700 text-xs font-black">1</span>
                        Informations Générales
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-base font-bold text-gray-700 mb-1">Nom de la structure <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-base">
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Catégorie <span class="text-red-500">*</span></label>
                            <select name="groupe" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-base">
                                <option value="">Choisir...</option>
                                @foreach(\App\Enums\UserGroup::cases() as $group)
                                    <option value="{{ $group->value }}" {{ old('groupe') == $group->value ? 'selected' : '' }}>{{ Str::title($group->value) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Acronyme / Sigle <span class="text-red-500">*</span></label>
                            <input type="text" name="denomination" value="{{ old('denomination') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-base">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-base font-bold text-gray-700 mb-3">Domaines d'intervention (Cochez toutes les cases applicables) <span class="text-red-500">*</span></label>
                            
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 max-h-96 overflow-y-auto p-2 border border-gray-200 rounded-xl bg-gray-50/50">
                                @php
                                $domaines = [
                                    "Agriculture et Maraîchage",
                                    "Alphabétisation des adultes",
                                    "Art et Patrimoine",
                                    "Assainissement et Déchets",
                                    "Biodiversité et Nature",
                                    "Changement climatique",
                                    "Droits des détenus",
                                    "Droits des femmes et VBG",
                                    "Eau potable (WASH)",
                                    "Éducation civique",
                                    "Éducation des filles",
                                    "Enseignement primaire et secondaire",
                                    "Entrepreneuriat des jeunes",
                                    "Formation professionnelle",
                                    "Gouvernance locale",
                                    "Handisport",
                                    "Inclusion numérique",
                                    "Inclusion sociale",
                                    "Infrastructures sportives",
                                    "Lutte contre les maladies",
                                    "Microfinance et Épargne",
                                    "Nutrition communautaire",
                                    "Protection de l'enfance",
                                    "Santé maternelle et infantile",
                                    "Santé mentale",
                                    "Santé sexuelle des jeunes",
                                    "Soutien scolaire et Excellence",
                                    "Sport au féminin",
                                    "Sport de masse et d'animation",
                                    "Sport-Loisir et Fitness",
                                    "Tourisme communautaire",
                                    "Transformation locale",
                                    "Autre",
                                ];
                                @endphp
                                @foreach($domaines as $index => $d)
                                    <label class="cursor-pointer relative">
                                        <input type="checkbox" name="domaine[]" value="{{ $d }}" x-model="domaine" class="peer sr-only">
                                        <div class="h-full rounded-xl border-2 border-gray-200 bg-white p-4 transition-all hover:border-blue-300 peer-checked:border-blue-600 peer-checked:bg-blue-50 peer-focus:ring-2 peer-focus:ring-blue-500 peer-focus:ring-offset-2 flex items-start gap-3 shadow-sm">
                                            <div class="flex h-5 w-5 shrink-0 items-center justify-center rounded border-2 border-gray-300 peer-checked:border-blue-600 peer-checked:bg-blue-600 mt-0.5 transition-colors">
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
                        <div class="md:col-span-2" x-show="Array.isArray(domaine) ? domaine.includes('Autre') : domaine === 'Autre'" x-transition>
                            <label class="block text-base font-bold text-gray-700 mb-1">Précisez votre domaine <span class="text-red-500">*</span></label>
                            <input type="text" name="domaine_autre" value="{{ old('domaine_autre') }}" class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-base" :required="Array.isArray(domaine) ? domaine.includes('Autre') : domaine === 'Autre'">
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Date de création légale <span class="text-red-500">*</span></label>
                            <input type="date" name="date" value="{{ old('date') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-base">
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Site Web / Réseaux sociaux</label>
                            <input type="url" name="lien" value="{{ old('lien') }}" placeholder="https://..." class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-base">
                        </div>
                    </div>

                    <hr class="border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-blue-100 text-blue-700 text-xs font-black">2</span>
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
                                    <option value="{{ $i }}ème Arrondissement" {{ old('arrondissement') == $i.'ème Arrondissement' ? 'selected' : '' }}>{{ $i }}{{ $i == 1 ? 'er' : 'ème' }} Arrondissement</option>
                                @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Quartier <span class="text-red-500">*</span></label>
                            <input type="text" name="quartier" value="{{ old('quartier') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Maison / Repère <span class="text-red-500">*</span></label>
                            <input type="text" name="maison" value="{{ old('maison') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                        </div>
                    </div>

                    <hr class="border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-blue-100 text-blue-700 text-xs font-black">3</span>
                        Contact
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-base font-bold text-gray-700 mb-1">Adresse e-mail <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Téléphone principal <span class="text-red-500">*</span></label>
                            <input type="text" name="number1" value="{{ old('number1') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                        </div>
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Téléphone secondaire <span class="text-gray-400 text-sm font-normal">(optionnel)</span></label>
                            <input type="text" name="number2" value="{{ old('number2') }}" class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                        </div>
                    </div>

                    <hr class="border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-blue-100 text-blue-700 text-xs font-black">4</span>
                        Objectifs Principaux (5 obligatoires)
                    </h3>
                    <div class="space-y-4">
                        @for($i = 0; $i < 5; $i++)
                        <div>
                            <label class="block text-base font-bold text-gray-700 mb-1">Objectif {{ $i + 1 }} <span class="text-red-500">*</span></label>
                            <input type="text" name="objectifs[]" value="{{ old('objectifs.'.$i) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl text-base">
                        </div>
                        @endfor
                    </div>

                    <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-500 hover:text-gray-800 font-medium text-sm">← Retour au tableau de bord</a>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-md">Suivant : Membres (2/3) →</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
