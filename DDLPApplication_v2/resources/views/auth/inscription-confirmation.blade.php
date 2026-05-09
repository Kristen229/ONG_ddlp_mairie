@extends('layouts.app')

@section('content')
    <section class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-lg w-full bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100 text-center">
            <!-- En-tête -->
            <div class="bg-teal-700 py-10 px-6">
                <div class="w-20 h-20 bg-white/20 rounded-full mx-auto flex items-center justify-center mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-white">Candidature soumise !</h2>
                <p class="text-teal-100 mt-2">Votre inscription a bien été enregistrée.</p>
            </div>

            <div class="p-8 space-y-6">
                <div class="bg-teal-50 border border-teal-100 rounded-2xl p-6">
                    <svg class="w-8 h-8 text-teal-600 mx-auto mb-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <h3 class="text-lg font-black text-teal-800 mb-2">Que se passe-t-il maintenant ?</h3>
                    <p class="text-teal-700 text-sm leading-relaxed">
                        La Mairie va examiner votre dossier. Une fois votre inscription validée, 
                        vous recevrez un <strong>email</strong> contenant vos identifiants de connexion 
                        à l'adresse que vous avez renseignée.
                    </p>
                </div>

                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5">
                    <p class="text-amber-800 text-sm font-medium">
                        <svg class="w-5 h-5 inline-block mr-1 -mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Vous ne pouvez pas vous connecter tant que votre candidature n'a pas été approuvée.
                    </p>
                </div>

                <a href="{{ route('accueil') }}" class="inline-flex items-center gap-2 px-8 py-3 bg-teal-700 hover:bg-teal-800 text-white font-bold rounded-xl transition-colors shadow-lg">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Retour à l'accueil
                </a>
            </div>
        </div>
    </section>
@endsection
