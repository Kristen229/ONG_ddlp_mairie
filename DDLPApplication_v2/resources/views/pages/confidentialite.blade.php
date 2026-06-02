@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-blue-700 px-8 py-10 text-white text-center">
                <h1 class="text-3xl md:text-4xl font-black mb-4">Politique de Confidentialité</h1>
                <p class="text-blue-100">Dernière mise à jour : {{ date('d/m/Y') }}</p>
            </div>
            
            <div class="p-8 md:p-12 prose prose-blue max-w-none text-gray-600">
                <h2>1. Collecte des données</h2>
                <p>Dans le cadre de l'utilisation de la plateforme de la Mairie de Cotonou, nous sommes amenés à collecter certaines informations vous concernant, notamment lors de l'inscription d'une association ou d'une ONG.</p>
                <p>Les données collectées incluent, sans s'y limiter : les noms, adresses e-mail, numéros de téléphone, informations sur le bureau exécutif, et documents justificatifs de l'organisation.</p>

                <h2>2. Utilisation des données</h2>
                <p>Les informations collectées sont utilisées exclusivement pour :</p>
                <ul>
                    <li>Valider l'existence légale et la conformité des associations et ONG.</li>
                    <li>Faciliter la communication entre la Mairie et les organisations.</li>
                    <li>Traiter les demandes administratives et les courriers.</li>
                    <li>Présenter les organisations approuvées au grand public via l'annuaire de la plateforme.</li>
                </ul>

                <h2>3. Protection et Sécurité</h2>
                <p>La Mairie de Cotonou met en œuvre toutes les mesures techniques et organisationnelles nécessaires pour garantir la sécurité et la confidentialité de vos données contre toute altération, destruction ou accès non autorisé. Les mots de passe sont hachés et sécurisés.</p>

                <h2>4. Partage des données</h2>
                <p>Vos données internes (telles que le budget prévisionnel ou les documents internes) ne sont jamais partagées avec le public. Seules les informations publiques validées (nom, domaine, description des activités) sont affichées sur le portail citoyen.</p>

                <h2>5. Vos droits</h2>
                <p>Conformément à la réglementation en vigueur, vous disposez d'un droit d'accès, de rectification, de suppression et de limitation du traitement de vos données. Pour exercer ces droits, vous pouvez contacter la Mairie de Cotonou via le formulaire de contact ou directement à la Mairie de Cotonou.</p>

                <h2>6. Cookies</h2>
                <p>La plateforme utilise des cookies strictement nécessaires à son bon fonctionnement (maintien de la session de connexion). Aucun cookie de traçage à des fins publicitaires n'est utilisé.</p>
            </div>
        </div>
    </div>
</div>
@endsection
