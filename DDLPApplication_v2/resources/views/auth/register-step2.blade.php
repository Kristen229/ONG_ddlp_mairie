@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- En-tête et Stepper -->
            <div class="bg-teal-700 px-8 py-8 text-white relative">
                <h2 class="text-3xl font-black mb-2">Contacts et Accès</h2>
                <p class="text-teal-100">Coordonnées et Sécurité (Étape 2 sur 3)</p>
                
                <div class="mt-8 relative">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-teal-900">
                        <div style="width: 66%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-teal-400"></div>
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

                <form method="POST" action="{{ route('user.createUserPartie2') }}" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Email -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Adresse Email Principale <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ old('email', session('registration_data.email')) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                            <p class="text-xs text-gray-500 mt-1">Cet email servira d'identifiant de connexion.</p>
                        </div>

                        <!-- Siège -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-1">Adresse du Siège <span class="text-red-500">*</span></label>
                            <input type="text" name="siege" value="{{ old('siege', session('registration_data.siege')) }}" required placeholder="Quartier, Ville..." class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>

                        <!-- Numéros -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Numéro de Téléphone 1 <span class="text-red-500">*</span></label>
                            <input type="text" name="number1" value="{{ old('number1', session('registration_data.number1')) }}" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">Numéro de Téléphone 2 (Optionnel)</label>
                            <input type="text" name="number2" value="{{ old('number2', session('registration_data.number2')) }}" class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm">
                        </div>
                    </div>

                    <hr class="border-gray-200 my-8">

                    <h3 class="text-lg font-bold text-gray-900 mb-4">Sécurité du compte</h3>
                        <div class="space-y-4">
                            <!-- Mot de passe -->
                            <div x-data="{ show: false }">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                                <div class="relative">
                                    <input name="password" :type="show ? 'text' : 'password'" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm pr-10">
                                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                    </button>
                                </div>
                            </div>
                            <!-- Confirmation -->
                            <div x-data="{ show: false }">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Confirmez le mot de passe</label>
                                <div class="relative">
                                    <input name="password_confirmation" :type="show ? 'text' : 'password'" required class="block w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-teal-500 focus:border-teal-500 sm:text-sm pr-10">
                                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 focus:outline-none">
                                        <svg x-show="!show" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                        <svg x-show="show" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" /></svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center mt-8 pt-6 border-t border-gray-100">
                        <a href="{{ route('user.createForme1') }}" class="text-gray-500 hover:text-gray-800 font-medium text-sm">
                            ← Retour Étape 1
                        </a>
                        <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-bold py-3 px-8 rounded-xl transition-colors shadow-md">
                            Suivant (3/3) →
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
