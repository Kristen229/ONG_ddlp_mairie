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

                    <div class="bg-teal-50 border border-teal-100 rounded-2xl p-5">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-teal-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <h4 class="font-bold text-teal-800 text-sm">À propos de votre mot de passe</h4>
                                <p class="text-teal-700 text-sm mt-1">Votre mot de passe vous sera envoyé par email une fois votre candidature validée par la Mairie. Vous pourrez le changer lors de votre première connexion.</p>
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
