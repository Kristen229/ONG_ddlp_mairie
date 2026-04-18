@extends('layouts.app')

@section('content')
<!-- Différence visuelle : theme plutôt "slate/bleu" pour bien distinguer de la connexion ONG -->
<section class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-200">
        
        <!-- En-tête Admin -->
        <div class="bg-slate-900 py-8 px-6 text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 -tr border-[50px] border-slate-800 border-b-transparent border-l-transparent"></div>
            <h2 class="text-3xl font-black text-white relative z-10 flex items-center justify-center gap-3">
                <svg class="w-8 h-8 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                Portail Admin
            </h2>
            <p class="text-slate-300 mt-2 text-sm relative z-10">Accès restreint aux agents de la Mairie</p>
        </div>

        <div class="p-8">
            <!-- Gestion des erreurs -->
            @if ($errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                    <div class="flex">
                        <svg class="h-5 w-5 text-red-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <p class="text-sm text-red-700">Identifiants incorrects.</p>
                    </div>
                </div>
            @endif

            <!-- Formulaire -->
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Email Administrateur</label>
                    <input id="email" name="email" type="email" required 
                           class="appearance-none block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-slate-900 focus:border-slate-900 sm:text-sm transition-all shadow-inner" placeholder="admin@mairie-cotonou.bj">
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Mot de passe</label>
                    <input id="password" name="password" type="password" required 
                           class="appearance-none block w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl focus:bg-white focus:outline-none focus:ring-2 focus:ring-slate-900 focus:border-slate-900 sm:text-sm transition-all shadow-inner" placeholder="••••••••">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-bold text-white bg-slate-900 hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-slate-900 shadow-lg transition-all">
                        Connexion Sécurisée
                    </button>
                </div>
            </form>
            
            <div class="mt-6 text-center text-xs text-gray-500">
                <p>⚠️ Toute tentative d'accès non autorisé est enregistrée.</p>
            </div>
        </div>
    </div>
</section>
@endsection
