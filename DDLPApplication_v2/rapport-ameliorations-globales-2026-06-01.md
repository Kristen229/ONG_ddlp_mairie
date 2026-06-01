# Rapport des ameliorations globales

Date: 2026-06-01

## Corrections realisees

- Remplacement du popup navigateur d'approbation ONG par un modal coherent avec le rejet.
- Ajout de l'oeil sur les champs de changement de mot de passe utilisateur et admin.
- Affichage visible du fichier PDF selectionne dans les demandes de courrier.
- Message admin rendu obligatoire pour approuver ou rejeter un courrier, avec validation serveur.
- Notification interne envoyee a l'ONG quand un mail de traitement de courrier lui est envoye.
- Correction des logos ONG sur la page d'accueil et retrait des domaines dans les cartes publiques.
- Avis visiteurs rendus visibles immediatement, avec suppression admin conservee.
- Cloche admin rendue utile avec compteurs candidatures, courriers et activites en attente.
- Page publique de detail d'activite ajoutee et liens "Decouvrir" corriges.
- Workflow activite ajoute: statuts, demande de correction, resoumission ONG, limite de 3 corrections/rejets.
- Edition des informations ONG depuis l'espace ONG.
- Profil admin ajoute avec changement de mot de passe.
- CRUD super-admin enrichi avec nom, prenom, email, role et protections du dernier super-admin.
- DomPDF installe et vues PDF remplies pour association, export par domaine et tableau de bord.
- Export PDF du tableau de bord reserve au super-admin.
- Logs d'audit ajoutes avec consultation super-admin et export CSV/Excel par periode.

## Diagnostic PDF

L'export PDF ne fonctionnait pas pour deux raisons principales:

1. La dependance `barryvdh/laravel-dompdf` n'etait pas installee.
2. Les vues `resources/views/pdf/association.blade.php`, `export-domaine.blade.php` et `stats.blade.php` etaient vides.

Les deux points ont ete corriges.

## Verification

- `php -l` sur les nouveaux fichiers critiques: OK.
- `php artisan route:list`: OK, 87 routes detectees.
- `php artisan view:cache`: OK.
- `php artisan view:clear`: OK.
- `php artisan test`: OK, 2 tests passes.
- `php artisan migrate --force`: echec MySQL local.

## Point restant hors code

La migration n'a pas pu etre executee parce que Laravel ne parvient pas a se connecter au serveur MySQL local:

`SQLSTATE[HY000] [2002] Unknown error while connecting (Host: 127.0.0.1, Port: 3306, Database: ddlpmairieapplication)`

Apres redemarrage/correction du service MySQL, il faudra lancer:

```bash
php artisan migrate --force
```

## Note securite dependances

Composer signale des avis de securite sur certaines dependances deja presentes ou installees. Une passe dediee avec `composer audit` est recommandee pour traiter ce sujet proprement.
