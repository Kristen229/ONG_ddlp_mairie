@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- En-tête et Stepper -->
            <div class="bg-blue-700 px-8 py-8 text-white relative">
                <h2 class="text-3xl font-black mb-2">Documents Justificatifs</h2>
                <p class="text-blue-100">Logo et pièces administratives (Étape 3 sur 3)</p>
                
                <div class="mt-8 relative">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-blue-900">
                        <div style="width: 100%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-blue-400"></div>
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

                <form method="POST" action="{{ route('user.createUserPartie3') }}" enctype="multipart/form-data" class="space-y-8">
                    @csrf

                    {{-- ===== LOGO ===== --}}
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-blue-100 text-blue-700 text-xs font-black">1</span>
                        Logo de la structure
                    </h3>
                    <div class="p-6 border-2 border-dashed border-blue-300 rounded-2xl bg-blue-50/50">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Logo (Image PNG/JPG) <span class="text-red-500">*</span></label>
                        <input type="file" name="logo" accept="image/*" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-100 file:text-blue-800 hover:file:bg-blue-200">
                        <p class="text-xs text-gray-500 mt-2">Format accepté : PNG, JPG, JPEG. Taille max : 20 Mo.</p>
                    </div>

                    <hr class="border-gray-200">

                    {{-- ===== DOCUMENTS ADMINISTRATIFS ===== --}}
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-2">
                        <span class="flex items-center justify-center h-7 w-7 rounded-full bg-blue-100 text-blue-700 text-xs font-black">2</span>
                        Documents Administratifs Obligatoires
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Récépissé -->
                        <div class="p-5 border-2 border-dashed border-gray-300 rounded-xl bg-white hover:border-blue-400 transition-colors">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Récépissé de déclaration <span class="text-red-500">*</span></label>
                            <input type="file" name="doc_recepisse" accept="application/pdf" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-400 mt-1">Format PDF uniquement</p>
                        </div>
                        
                        <!-- Journal Officiel -->
                        <div class="p-5 border-2 border-dashed border-gray-300 rounded-xl bg-white hover:border-blue-400 transition-colors">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Extrait du Journal Officiel <span class="text-red-500">*</span></label>
                            <input type="file" name="doc_journal_officiel" accept="application/pdf" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-400 mt-1">Format PDF uniquement</p>
                        </div>

                        <!-- Attestation -->
                        <div class="p-5 border-2 border-dashed border-gray-300 rounded-xl bg-white hover:border-blue-400 transition-colors">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Attestation d'enregistrement <span class="text-red-500">*</span></label>
                            <input type="file" name="doc_attestation" accept="application/pdf" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-400 mt-1">Format PDF uniquement</p>
                        </div>

                        <!-- Statut et Règlement -->
                        <div class="p-5 border-2 border-dashed border-gray-300 rounded-xl bg-white hover:border-blue-400 transition-colors">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Statut et Règlement intérieur <span class="text-red-500">*</span></label>
                            <input type="file" name="doc_reglement" accept="application/pdf" required class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            <p class="text-xs text-gray-400 mt-1">Format PDF uniquement</p>
                        </div>
                    </div>

                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <div>
                                <h4 class="font-bold text-blue-800 text-sm">À propos de votre mot de passe</h4>
                                <p class="text-blue-700 text-sm mt-1">Votre mot de passe vous sera envoyé par email une fois votre candidature validée par la Mairie. Vous pourrez le changer lors de votre première connexion.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center mt-12 pt-6 border-t border-gray-100">
                        <a href="{{ route('user.createForme2') }}" class="text-gray-500 hover:text-gray-800 font-medium text-sm">
                            ← Retour Étape 2
                        </a>
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 text-white font-black py-4 px-8 rounded-xl transition-all shadow-lg transform hover:scale-105 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Terminer l'inscription
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
