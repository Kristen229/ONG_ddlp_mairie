@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-blue-700 px-8 py-10 text-white text-center">
                <h1 class="text-3xl md:text-4xl font-black mb-4">Conditions d'Utilisation</h1>
                <p class="text-blue-100">Dernière mise à jour : {{ date('d/m/Y') }}</p>
            </div>
            
            <div class="p-8 md:p-12 prose prose-blue max-w-none text-gray-600">
                <h2>1. Acceptation des conditions</h2>
                <p>En accédant et en utilisant la plateforme de la Mairie de Cotonou, vous acceptez sans réserve les présentes Conditions d'Utilisation. Si vous n'acceptez pas ces conditions, veuillez ne pas utiliser la plateforme.</p>

                <h2>2. Objet de la plateforme</h2>
                <p>La présente plateforme a pour but de recenser, suivre et accompagner les Associations et Organisations Non Gouvernementales (ONG) intervenant sur le territoire de la commune de Cotonou. Elle permet également aux citoyens de consulter les activités menées par ces organisations et de donner leur avis.</p>

                <h2>3. Inscription et Responsabilité</h2>
                <p>Les représentants légaux des associations s'engagent à fournir des informations exactes, à jour et complètes lors de leur inscription. Toute fausse déclaration pourra entraîner le rejet de la candidature ou la suppression du compte, sans préjudice de poursuites judiciaires éventuelles.</p>
                <p>Les identifiants de connexion (mot de passe) sont strictement personnels et confidentiels. L'utilisateur est seul responsable de l'utilisation de son compte.</p>

                <h2>4. Publication des activités</h2>
                <p>Les associations peuvent soumettre des activités à publier. La Mairie se réserve le droit d'évaluer, de publier, de refuser ou de supprimer toute activité jugée non conforme aux lois en vigueur, aux bonnes mœurs, ou ne relevant pas de l'intérêt général de la commune.</p>

                <h2>5. Avis des citoyens</h2>
                <p>Les utilisateurs non inscrits peuvent laisser des avis. Les commentaires doivent être respectueux et constructifs. Tout avis contenant des propos diffamatoires, injurieux, racistes ou hors contexte sera supprimé par l'administration.</p>

                <h2>6. Propriété Intellectuelle</h2>
                <p>L'ensemble des éléments constituant la plateforme (textes, images, logos, design, code) sont la propriété exclusive de la Mairie de Cotonou ou de leurs auteurs respectifs. Toute reproduction sans autorisation préalable est interdite.</p>

                <h2>7. Modification des conditions</h2>
                <p>La Mairie de Cotonou se réserve le droit de modifier les présentes conditions d'utilisation à tout moment. Les utilisateurs seront informés de toute modification significative.</p>
            </div>
        </div>
    </div>
</div>
@endsection
