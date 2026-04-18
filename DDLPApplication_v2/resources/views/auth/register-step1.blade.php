@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Carte principale -->
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- En-tête et Stepper -->
            <div class="bg-teal-700 px-8 py-8 text-white relative">
                <h2 class="text-3xl font-black mb-2">Inscription de votre structure</h2>
                <p class="text-teal-100">Informations générales (Étape 1 sur 3)</p>
                
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
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Dénomination (Nom de la structure) <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>

                        <!-- Catégorie (Group) -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Catégorie <span class="text-red-500">*</span></label>
                            <select name="group" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                                <option value="">Choisir une catégorie...</option>
                                @foreach(\App\Enums\UserGroup::cases() as $group)
                                    <option value="{{ $group->value }}" {{ old('group') == $group->value ? 'selected' : '' }}>
                                        {{ Str::title($group->value) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Domaine -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Domaine d'intervention <span class="text-red-500">*</span></label>
                            <input type="text" name="domaine" value="{{ old('domaine') }}" placeholder="Ex: Environnement, Éducation..." required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>

                        <!-- Date -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Date de création légale <span class="text-red-500">*</span></label>
                            <input type="date" name="date" value="{{ old('date') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>

                        <!-- Acronyme -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Acronyme / Sigle (Optionnel)</label>
                            <input type="text" name="denomination" value="{{ old('denomination') }}" placeholder="Ex: DDLP" class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <h3 class="text-lg font-bold text-gray-900 mb-4">Objectifs Principaux</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Objectif 1 <span class="text-red-500">*</span></label>
                            <input type="text" name="objectif1" value="{{ old('objectif1') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Objectif 2 <span class="text-red-500">*</span></label>
                            <input type="text" name="objectif2" value="{{ old('objectif2') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Objectif 3 <span class="text-red-500">*</span></label>
                            <input type="text" name="objectif3" value="{{ old('objectif3') }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('user.login') }}" class="text-teal-600 hover:text-teal-800 font-medium text-sm">
                            ← Retour à la connexion
                        </a>
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-md">
                            Suivant (2/3) →
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
