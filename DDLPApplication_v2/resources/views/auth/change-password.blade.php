@extends('layouts.app')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <!-- En-tête -->
            <div class="bg-blue-700 py-8 px-6 text-center">
                <div class="w-16 h-16 bg-white/20 rounded-full mx-auto flex items-center justify-center mb-3">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-black text-white">Changement de mot de passe</h2>
                <p class="text-blue-100 mt-2 text-sm">Pour votre sécurité, veuillez définir un nouveau mot de passe.</p>
            </div>

            <div class="p-8">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                        @foreach ($errors->all() as $error)
                            <p class="text-sm text-red-700 font-medium">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.change.update') }}" class="space-y-6" x-data="{ showPassword: false, showConfirmation: false }">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nouveau mot de passe <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input :type="showPassword ? 'text' : 'password'" name="password" required minlength="8" class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 pl-4 pr-12 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-colors" placeholder="Minimum 8 caractères">
                            <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 px-4 text-gray-400 hover:text-blue-700 transition-colors" :aria-label="showPassword ? 'Masquer le mot de passe' : 'Afficher le mot de passe'">
                                <svg x-show="!showPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <svg x-show="showPassword" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18M10.584 10.587A2 2 0 0012 14a2 2 0 001.414-.586M9.88 4.24A10.116 10.116 0 0112 4c4.478 0 8.268 2.943 9.542 7a10.51 10.51 0 01-3.052 4.568M6.228 6.228A10.57 10.57 0 002.458 12c.716 2.282 2.19 4.214 4.095 5.47A9.957 9.957 0 0012 19c.736 0 1.454-.079 2.145-.229"></path></svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Confirmer le mot de passe <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <input :type="showConfirmation ? 'text' : 'password'" name="password_confirmation" required minlength="8" class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 pl-4 pr-12 focus:ring-blue-500 focus:border-blue-500 focus:bg-white transition-colors" placeholder="Retapez votre mot de passe">
                            <button type="button" @click="showConfirmation = !showConfirmation" class="absolute inset-y-0 right-0 px-4 text-gray-400 hover:text-blue-700 transition-colors" :aria-label="showConfirmation ? 'Masquer la confirmation' : 'Afficher la confirmation'">
                                <svg x-show="!showConfirmation" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                <svg x-show="showConfirmation" style="display: none;" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18M10.584 10.587A2 2 0 0012 14a2 2 0 001.414-.586M9.88 4.24A10.116 10.116 0 0112 4c4.478 0 8.268 2.943 9.542 7a10.51 10.51 0 01-3.052 4.568M6.228 6.228A10.57 10.57 0 002.458 12c.716 2.282 2.19 4.214 4.095 5.47A9.957 9.957 0 0012 19c.736 0 1.454-.079 2.145-.229"></path></svg>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="w-full py-3 bg-blue-700 hover:bg-blue-800 text-white font-bold rounded-xl transition-colors shadow-lg">
                        Définir mon mot de passe
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
