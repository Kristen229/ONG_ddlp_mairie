@extends('layouts.app')

@section('content')
<!-- Header Section -->
<section class="bg-teal-700 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-white">
        <h1 class="text-3xl md:text-5xl font-bold mb-4">Questions Fréquentes (FAQ)</h1>
        <p class="text-lg text-teal-100 max-w-2xl mx-auto">
            Trouvez rapidement des réponses aux questions les plus courantes sur le fonctionnement de la plateforme et les démarches administratives.
        </p>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16 bg-gray-50 flex-grow">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        
        <!-- Question 1 -->
        <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden [&_summary::-webkit-details-marker]:hidden">
            <summary class="flex items-center justify-between p-6 cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                <h3 class="text-lg font-semibold text-gray-900">Comment inscrire mon ONG sur la plateforme ?</h3>
                <span class="ml-4 flex-shrink-0 text-teal-500 transition-transform duration-300 group-open:rotate-180">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </span>
            </summary>
            <div class="p-6 pt-0 text-gray-600 bg-white leading-relaxed">
                <p>Pour inscrire votre structure (Association, ONG, Groupement ou Fondation) :</p>
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li>Cliquez sur "Connexion membre" en haut à droite.</li>
                    <li>Choisissez "Je n'ai pas de compte / S'inscrire".</li>
                    <li>Remplissez les 3 étapes du formulaire avec les documents justificatifs (statuts, arrêtés, etc.).</li>
                    <li>L'administration vérifiera vos informations et validera la création.</li>
                </ul>
            </div>
        </details>

        <!-- Question 2 -->
        <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden [&_summary::-webkit-details-marker]:hidden">
            <summary class="flex items-center justify-between p-6 cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                <h3 class="text-lg font-semibold text-gray-900">Une simple association peut-elle s'inscrire ?</h3>
                <span class="ml-4 flex-shrink-0 text-teal-500 transition-transform duration-300 group-open:rotate-180">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </span>
            </summary>
            <div class="p-6 pt-0 text-gray-600 bg-white leading-relaxed">
                Oui. Lors de l'inscription, il vous sera demandé la "Catégorie" de votre structure. Vous pouvez choisir "Association", "ONG", "Groupement" ou "Fondation". Assurez-vous d'avoir vos documents légaux à jour.
            </div>
        </details>

        <!-- Question 3 -->
        <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden [&_summary::-webkit-details-marker]:hidden">
            <summary class="flex items-center justify-between p-6 cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                <h3 class="text-lg font-semibold text-gray-900">Comment soumettre une demande (audience, partenariat...) ?</h3>
                <span class="ml-4 flex-shrink-0 text-teal-500 transition-transform duration-300 group-open:rotate-180">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </span>
            </summary>
            <div class="p-6 pt-0 text-gray-600 bg-white leading-relaxed">
                Une fois votre inscription validée et que vous êtes connecté à votre "Espace Membre" :
                <ul class="list-disc pl-5 mt-2 space-y-1">
                    <li>Allez dans l'onglet "Mes Demandes".</li>
                    <li>Cliquez sur "Nouvelle demande".</li>
                    <li>Rédigez l'objet de votre lettre au Maire et soumettez-la numériquement.</li>
                    <li>Un code de suivi vous sera attribué pour suivre l'état (Approuvé, Rejeté, etc.).</li>
                </ul>
            </div>
        </details>

        <!-- Question 4 -->
        <details class="group bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden [&_summary::-webkit-details-marker]:hidden">
            <summary class="flex items-center justify-between p-6 cursor-pointer bg-white hover:bg-gray-50 transition-colors">
                <h3 class="text-lg font-semibold text-gray-900">Comment publier les activités de mon association ?</h3>
                <span class="ml-4 flex-shrink-0 text-teal-500 transition-transform duration-300 group-open:rotate-180">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </span>
            </summary>
            <div class="p-6 pt-0 text-gray-600 bg-white leading-relaxed">
                Depuis votre espace membre, cliquez sur l'onglet "Mes Activités" puis sur "Ajouter une activité". Mettez un titre, une description et un visuel. L'équipe d'administration de la mairie validera son affichage public (si conforme).
            </div>
        </details>

        <div class="mt-12 text-center">
            <p class="text-gray-500 mb-4">Vous n'avez pas trouvé votre réponse ?</p>
            <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 border border-teal-600 text-base font-medium rounded-xl text-teal-600 bg-white hover:bg-teal-50 transition-colors">
                Nous contacter
            </a>
        </div>
    </div>
</section>
@endsection
