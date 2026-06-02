@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- En-tête -->
            <div class="bg-blue-700 px-8 py-10 text-white text-center relative">
                <div class="flex justify-center mb-4">
                    <div class="h-16 w-16 bg-white/20 rounded-2xl flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <h2 class="text-3xl font-black mb-2">Avant de commencer</h2>
                <p class="text-blue-100 text-lg">Préparez vos documents pour une inscription sans accroc</p>
            </div>

            <div class="p-8 space-y-8">
                <!-- Message d'introduction -->
                <div class="bg-blue-50 border border-blue-100 rounded-2xl p-6">
                    <div class="flex items-start gap-4">
                        <svg class="w-7 h-7 text-blue-600 shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <div>
                            <h3 class="font-bold text-blue-900 text-base mb-1">Processus d'inscription en 3 étapes</h3>
                            <p class="text-blue-800 text-sm leading-relaxed">L'inscription se fait en <strong>3 étapes simples</strong>. Pour que tout se passe bien, assurez-vous d'avoir sous la main tous les éléments listés ci-dessous <strong>avant de commencer</strong>.</p>
                        </div>
                    </div>
                </div>

                <!-- Étape 1 -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-3 mb-4">
                        <span class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-600 text-white text-sm font-black">1</span>
                        Informations Générales, Adresse & Contact
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <ul class="space-y-2.5 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Le <strong>nom complet</strong> de votre structure et son <strong>acronyme/sigle</strong></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Le <strong>domaine d'intervention</strong> (sélection dans la liste)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>La <strong>date de création légale</strong> de la structure</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>L'<strong>adresse</strong> du siège : arrondissement, quartier, maison/repère</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>L'<strong>adresse e-mail</strong> officielle et le(s) <strong>numéro(s) de téléphone</strong></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span><strong>5 objectifs principaux</strong> de votre structure</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Étape 2 -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-3 mb-4">
                        <span class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-600 text-white text-sm font-black">2</span>
                        Membres du Bureau Exécutif
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <ul class="space-y-2.5 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Les <strong>nom, prénom, contact</strong> et une <strong>photo</strong> du <strong>Président(e)</strong></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Les <strong>nom, prénom, contact</strong> et une <strong>photo</strong> du <strong>Secrétaire Général(e)</strong></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                <span>Les <strong>nom, prénom, contact</strong> et une <strong>photo</strong> du <strong>Trésorier(ère)</strong></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-gray-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                <span class="text-gray-500">Optionnel : d'autres membres du bureau (Vice-président, etc.)</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Étape 3 -->
                <div>
                    <h3 class="text-lg font-bold text-gray-900 flex items-center gap-3 mb-4">
                        <span class="flex items-center justify-center h-8 w-8 rounded-full bg-blue-600 text-white text-sm font-black">3</span>
                        Documents Justificatifs
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                        <ul class="space-y-2.5 text-sm text-gray-700">
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <span><strong>Récépissé de déclaration</strong> (PDF)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <span><strong>Extrait du Journal Officiel</strong> (PDF)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <span><strong>Attestation d'enregistrement</strong> (PDF)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-red-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                <span><strong>Statut et Règlement intérieur</strong> (PDF)</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-blue-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                <span><strong>Logo de la structure</strong> (Image PNG/JPG)</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Bouton CTA -->
                <div class="pt-4 text-center">
                    <a href="{{ route('user.createForme1') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-blue-600 to-blue-600 hover:from-blue-700 hover:to-blue-700 text-white font-black py-4 px-10 rounded-xl transition-all shadow-lg transform hover:scale-105 text-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        J'ai tout préparé, commencer l'inscription
                    </a>
                    <p class="text-xs text-gray-400 mt-4">L'inscription prend environ 10 minutes.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
