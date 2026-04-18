@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- En-tête et Stepper -->
            <div class="bg-teal-700 px-8 py-8 text-white relative">
                <h2 class="text-3xl font-black mb-2">Fichiers et Bureau</h2>
                <p class="text-teal-100">Membres du bureau et Documents justificatifs (Étape 3 sur 3)</p>
                
                <div class="mt-8 relative">
                    <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-teal-900">
                        <div style="width: 100%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-teal-400"></div>
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
                    
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Les Membres du Bureau</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-2xl border border-gray-100">
                            
                            <!-- Président -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nom du Président <span class="text-red-500">*</span></label>
                                <input type="text" name="name_president" required class="block w-full px-4 py-2 border border-gray-300 rounded-lg sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Prénom du Président <span class="text-red-500">*</span></label>
                                <input type="text" name="last_name_president" required class="block w-full px-4 py-2 border border-gray-300 rounded-lg sm:text-sm">
                            </div>

                            <!-- Vice P. -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nom du Vice-Président</label>
                                <input type="text" name="name_vice_president" class="block w-full px-4 py-2 border border-gray-300 rounded-lg sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Prénom du Vice-Président</label>
                                <input type="text" name="last_name_vice_president" class="block w-full px-4 py-2 border border-gray-300 rounded-lg sm:text-sm">
                            </div>

                            <!-- SG -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nom du Secrétaire Général</label>
                                <input type="text" name="name_secretaire_general" class="block w-full px-4 py-2 border border-gray-300 rounded-lg sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Prénom du Secrétaire Général</label>
                                <input type="text" name="last_name_secretaire_general" class="block w-full px-4 py-2 border border-gray-300 rounded-lg sm:text-sm">
                            </div>

                            <!-- Trésorier -->
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Nom du Trésorier Général</label>
                                <input type="text" name="name_tresorier_general" class="block w-full px-4 py-2 border border-gray-300 rounded-lg sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-1">Prénom du Trésorier Général</label>
                                <input type="text" name="last_name_tresorier_general" class="block w-full px-4 py-2 border border-gray-300 rounded-lg sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Documents Justificatifs obligatoires</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Attachements (Tous PDF sauf Logo) -->
                            <div class="p-4 border-2 border-dashed border-gray-300 rounded-xl bg-white">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Arrêté d'enregistrement de l'ONG (PDF)</label>
                                <input type="file" name="attachment" accept="application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            </div>
                            
                            <div class="p-4 border-2 border-dashed border-gray-300 rounded-xl bg-white">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Certificat d'enregistrement de l'ONG (PDF)</label>
                                <input type="file" name="attachment1" accept="application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            </div>

                            <div class="p-4 border-2 border-dashed border-gray-300 rounded-xl bg-white">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Extrait du Journal Officiel (PDF)</label>
                                <input type="file" name="attachment2" accept="application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            </div>

                            <div class="p-4 border-2 border-dashed border-gray-300 rounded-xl bg-white">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Statut et règlement intérieur (PDF)</label>
                                <input type="file" name="attachment3" accept="application/pdf" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            </div>

                            <div class="p-4 border-2 border-dashed border-gray-300 rounded-xl bg-white border-teal-200 bg-teal-50">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Logo de l'association (Image PNG/JPG)</label>
                                <input type="file" name="attachment5" accept="image/*" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-100 file:text-teal-800 hover:file:bg-teal-200">
                            </div>

                            <!-- Autres infos -->
                            <div class="p-4 border border-gray-200 rounded-xl bg-white flex flex-col justify-center">
                                <label class="block text-sm font-bold text-gray-700 mb-1">Lien Web ou Réseau Social (URL)</label>
                                <input type="url" name="lien" placeholder="https://..." class="block w-full px-4 py-2 border border-gray-300 rounded-lg sm:text-sm">
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex justify-between items-center mt-12 pt-6 border-t border-gray-100">
                        <a href="{{ route('user.createForme2') }}" class="text-gray-500 hover:text-gray-800 font-medium text-sm">
                            ← Retour Étape 2
                        </a>
                        <!-- Bouton final -->
                        <button type="submit" class="bg-gradient-to-r from-teal-600 to-green-600 hover:from-teal-700 hover:to-green-700 text-white font-black py-4 px-8 rounded-xl transition-all shadow-lg transform hover:scale-105 flex items-center gap-2">
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
