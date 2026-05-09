@extends('layouts.app')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
            <!-- En-tête -->
            <div class="bg-teal-700 py-8 px-6 text-center">
                <div class="w-16 h-16 bg-white/20 rounded-full mx-auto flex items-center justify-center mb-3">
                    <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h2 class="text-2xl font-black text-white">Changement de mot de passe</h2>
                <p class="text-teal-100 mt-2 text-sm">Pour votre sécurité, veuillez définir un nouveau mot de passe.</p>
            </div>

            <div class="p-8">
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg">
                        @foreach ($errors->all() as $error)
                            <p class="text-sm text-red-700 font-medium">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('password.change.update') }}" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Nouveau mot de passe <span class="text-red-500">*</span></label>
                        <input type="password" name="password" required minlength="8" class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors" placeholder="Minimum 8 caractères">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Confirmer le mot de passe <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" required minlength="8" class="block w-full border border-gray-200 rounded-xl bg-gray-50 py-3 px-4 focus:ring-teal-500 focus:border-teal-500 focus:bg-white transition-colors" placeholder="Retapez votre mot de passe">
                    </div>
                    <button type="submit" class="w-full py-3 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-xl transition-colors shadow-lg">
                        Définir mon mot de passe
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection
