@extends('layouts.app')

@section('content')
<!-- Header Section -->
<section class="bg-blue-700 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">Contactez-nous</h1>
        <p class="text-lg text-blue-100 max-w-2xl mx-auto">
            Une question spécifique ou un problème technique ? N'hésitez pas à joindre l'équipe d'assistance.
        </p>
    </div>
</section>

<!-- Form & Info Section -->
<section class="py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <!-- Informations de contact -->
            <div class="bg-gray-50 p-8 rounded-3xl border border-gray-100 h-full flex flex-col justify-center">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Informations de la Mairie</h2>
                
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-white rounded-full flex items-center justify-center text-blue-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Adresse</h3>
                            <p class="text-gray-600 mt-1">Mairie de Cotonou, Direction du Développement Local<br>Cotonou, Bénin</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-white rounded-full flex items-center justify-center text-blue-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Téléphone</h3>
                            <p class="text-gray-600 mt-1">+229 XX XX XX XX</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 bg-white rounded-full flex items-center justify-center text-blue-600 shadow-sm">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900">Email</h3>
                            <p class="text-gray-600 mt-1">support-ddlp@mairie-cotonou.bj</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulaire Contact Basique -->
            <div class="bg-white">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Envoyez un message rapide</h2>
                
                <form action="#" method="POST" class="space-y-6">
                    <!-- Pour la V2 ce form n'est pas branché backend (pas de mailer config) mais esthétique -->
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nom Complet</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" name="email" id="email" class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
                        <textarea id="message" name="message" rows="4" class="mt-1 block w-full border border-gray-300 rounded-xl shadow-sm py-3 px-4 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>

                    <button type="button" onclick="alert('Le formulaire sera relié au système de messagerie plus tard !')" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-xl shadow hover:bg-blue-700 transition">
                        Envoyer le message
                    </button>
                </form>
            </div>
            
        </div>
    </div>
</section>
@endsection
