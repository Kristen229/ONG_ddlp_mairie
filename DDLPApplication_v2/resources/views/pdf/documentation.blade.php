<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Documentation Technique - DDLPApplication</title>
    <style>
        @page { margin: 25px 25px 50px 25px; } /* top, right, bottom, left */
        body { font-family: DejaVu Sans, sans-serif; color: #000000; font-size: 11px; line-height: 1.5; margin-bottom: 20px; }
        h1 { color: #000000; font-size: 18px; margin-bottom: 8px; text-align: center; text-transform: uppercase; text-decoration: underline; }
        .subtitle { text-align: center; font-size: 11px; margin-bottom: 25px; font-weight: bold; }
        h2 { color: #000000; font-size: 14px; margin-top: 20px; border-bottom: 1px solid #000000; padding-bottom: 4px; text-transform: uppercase; }
        h3 { color: #000000; font-size: 12px; margin-top: 16px; font-weight: bold; }
        p { margin-top: 8px; margin-bottom: 8px; text-align: justify; }
        ul, ol { margin-top: 8px; margin-bottom: 8px; padding-left: 20px; }
        li { margin-bottom: 4px; }
        code { font-family: monospace; background-color: #f1f5f9; padding: 2px 4px; border-radius: 4px; color: #b91c1c; font-size: 10px; }
        .page-break { page-break-after: always; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; margin-bottom: 20px; }
        th, td { border: 1px solid #000000; padding: 10px; text-align: left; vertical-align: top; }
        th { background: #e5e7eb; color: #000000; font-weight: bold; text-transform: uppercase; font-size: 10px; }
        tr:nth-child(even) { background-color: #f9fafb; }
        .header-box { background-color: #f8fafc; border: 1px solid #000000; padding: 12px; margin-bottom: 20px; }
    </style>
</head>
<body>
    @include('pdf.header')
    
    <h1>Documentation Technique - Plateforme DDLP</h1>
    <div class="subtitle">Généré le {{ now()->format('d/m/Y à H:i') }}</div>

    <div class="header-box">
        <strong>Application :</strong> Gestion des Associations et ONG - Mairie de Cotonou<br>
        <strong>Version :</strong> 2.0<br>
        <strong>Framework :</strong> Laravel 10 / PHP 8.2<br>
    </div>

    <h2>1. Introduction</h2>
    <p>Cette plateforme permet à la Mairie de Cotonou (Direction du Développement Local et de la Participation) de gérer, suivre et évaluer les associations et ONG opérant sur son territoire. Elle offre un espace d'administration pour les agents de la mairie et un espace utilisateur pour les structures.</p>

    <h2>2. Architecture de l'Application</h2>
    <p>L'application est construite sur une architecture MVC (Modèle-Vue-Contrôleur) avec Laravel.</p>
    <ul>
        <li><strong>Frontend :</strong> Blade, Tailwind CSS, Alpine.js, Chart.js</li>
        <li><strong>Backend :</strong> Laravel (PHP), requêtes de formulaires (FormRequests), services.</li>
        <li><strong>Base de données :</strong> MySQL (avec système de migrations et seeders).</li>
        <li><strong>PDF :</strong> Génération via <code>barryvdh/laravel-dompdf</code>.</li>
    </ul>

    <h2>3. Rôles et Permissions</h2>
    <p>Le système gère deux grands types d'utilisateurs :</p>
    <ul>
        <li><strong>Utilisateurs (Associations/ONG) :</strong> Peuvent s'inscrire, mettre à jour leur profil, soumettre des activités, envoyer des courriers.</li>
        <li><strong>Administrateurs :</strong> Peuvent valider/rejeter les candidatures, modérer les activités, gérer les courriers, exporter les données.</li>
        <li><strong>Super Administrateurs :</strong> Ont les mêmes droits que les administrateurs, avec en plus la gestion des autres comptes administrateurs, l'accès aux logs d'audit et l'export des statistiques globales.</li>
    </ul>

    <div class="page-break"></div>

    <h2>4. Modèle de Données Principal</h2>
    <table>
        <thead>
            <tr>
                <th>Modèle</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>User</code></td>
                <td>Représente une association ou ONG. Contient les infos de contact, statuts, et l'état d'approbation (<code>is_approved</code>).</td>
            </tr>
            <tr>
                <td><code>Admin</code></td>
                <td>Compte administrateur de la mairie. Possède un attribut <code>is_super_admin</code>.</td>
            </tr>
            <tr>
                <td><code>Activity</code></td>
                <td>Activité ou projet mené par une ONG. Géré avec un statut de validation (En attente, Validée, Rejetée).</td>
            </tr>
            <tr>
                <td><code>AssociationRequest</code></td>
                <td>Courrier ou demande envoyée par une ONG à la mairie.</td>
            </tr>
            <tr>
                <td><code>Domaine</code></td>
                <td>Catégorie d'intervention (ex: Santé, Éducation). Lié aux utilisateurs via une relation Many-to-Many.</td>
            </tr>
            <tr>
                <td><code>AuditLog</code></td>
                <td>Trace des actions sensibles effectuées par les administrateurs.</td>
            </tr>
        </tbody>
    </table>

    <h2>5. Fonctionnalités Clés</h2>
    <h3>5.1 Gestion des Candidatures</h3>
    <p>Lorsqu'une ONG s'inscrit, son compte est inactif (<code>is_approved = false</code>). Un administrateur doit examiner les documents fournis (récépissé, statuts) avant d'approuver ou de rejeter la demande.</p>

    <h3>5.2 Cycle de vie des activités</h3>
    <p>Les activités soumises passent par un workflow :</p>
    <ol>
        <li><strong>Brouillon / En attente :</strong> L'activité est soumise par l'ONG.</li>
        <li><strong>Publication (Admin) :</strong> Un administrateur examine et publie l'activité (<code>is_visible = true</code>).</li>
        <li><strong>Validation Mairie (Admin) :</strong> Confirmation officielle que l'activité a bien eu lieu (<code>is_validated_by_mairie = true</code>).</li>
    </ol>

    <h3>5.3 Tableaux de bord et Statistiques</h3>
    <p>Le <code>StatsService</code> consolide les données pour le tableau de bord : inscriptions mensuelles, répartition par domaine, traitement des courriers. Ces données peuvent être exportées en PDF (Super Admin).</p>

    <div class="page-break"></div>

    <h2>6. Déploiement et Maintenance</h2>
    <h3>6.1 Commandes usuelles</h3>
    <ul>
        <li><code>php artisan serve</code> : Lancer le serveur de développement local.</li>
        <li><code>npm run dev</code> : Compiler les assets Tailwind/JS en temps réel.</li>
        <li><code>php artisan migrate</code> : Exécuter les migrations de base de données.</li>
        <li><code>php artisan config:cache</code> : Mettre en cache la configuration (pour la production).</li>
        <li><code>php artisan storage:link</code> : Créer le lien symbolique pour rendre les fichiers uploadés (logos, PDF) accessibles publiquement.</li>
    </ul>

    <h3>6.2 Gestion des fichiers</h3>
    <p>Les fichiers uploadés (statuts, récépissés, rapports d'activité) sont stockés dans <code>storage/app/public/</code>. La taille maximale d'upload est définie à 20 Mo. Il est nécessaire de configurer <code>upload_max_filesize</code> et <code>post_max_size</code> dans le <code>php.ini</code> du serveur.</p>

    @include('pdf.footer')
</body>
</html>
