# Plan d'implementation approuve

Date: 2026-05-31

## Objectif

Corriger les urgences securite, base de donnees, configuration, emails, statistiques domaines et avis publics selon les options validees.

## Plan valide

1. Corriger P1 avec l'import Laravel de `Hash` dans `routes/web.php`.
2. Corriger P2 avec un middleware `ForcePasswordChange` applique aux routes utilisateurs authentifiees.
3. Nettoyer la migration initiale `association_requests` puisque le projet est encore local, puis rafraichir la base.
4. Passer le fuseau horaire Laravel sur `Africa/Porto-Novo`.
5. Garder SMTP et remplir les vues email vides.
6. Remplacer le stockage JSON des domaines par une table `domaines` et une table pivot `domaine_user`.
7. Bloquer tout le site dans `robots.txt` tant que le lancement officiel n'est pas fait.
8. Garder les avis publics, mais ajouter throttling, anti-spam simple et affichage uniquement des avis approuves.
9. Corriger les problemes critiques releves hors P1-P8: creation admin publique, acces inter-utilisateurs, dette `objectifs`, tests.

## Verification prevue

- `php artisan route:list`
- `php artisan migrate:fresh --seed`
- `php artisan test`

## Plan additionnel valide: uploads inscription a 20 Mo

1. Passer les validations Laravel des photos, logos et documents d'inscription a `max:20480`.
2. Ajouter les limites PHP CLI actives dans `/home/kristen/.config/herd-lite/bin/php.ini`:
   - `upload_max_filesize=20M`
   - `post_max_size=120M`
   - `memory_limit=256M`
3. Verifier les valeurs actives avec `php -i`.
4. Relancer les tests Laravel.

## Plan additionnel valide: examen detaille des candidatures

1. Ajouter une route admin de detail `admin.candidates.show`.
2. Ajouter une methode `show` dans `CandidateController` pour charger une candidature non approuvee avec `domaines` et `boardMembers`.
3. Transformer la liste des candidatures en vue compacte avec un bouton `Examiner`.
4. Creer une page detail complete affichant toutes les informations, objectifs, membres du bureau, photos et documents uploades.
5. Mettre les actions `Approuver` et `Rejeter` sur la page detail.
6. Verifier les routes et les tests.

## Plan additionnel valide: ameliorations admin, ONG, courriers, activites et exports

Date: 2026-06-01

### Objectif

Ameliorer les workflows critiques apres l'examen des candidatures: actions admin plus propres, notifications utiles, edition des profils, suivi des courriers et activites, exports fiables, logs d'audit et affichage public coherent.

### Phase 1 - Corrections UX et validation rapides

1. Remplacer le `confirm()` navigateur d'approbation ONG par un modal coherent avec le modal de rejet.
2. Ajouter un bouton oeil sur les formulaires de changement de mot de passe.
3. Afficher clairement le fichier selectionne dans le formulaire de demande de courrier.
4. Rendre le message admin obligatoire pour approuver ou rejeter une demande de courrier.
5. Corriger l'affichage public des logos ONG sur la page d'accueil.
6. Retirer les domaines d'intervention des cartes ONG publiques.
7. Rendre les avis visiteurs visibles immediatement, avec suppression possible par l'admin.

### Phase 2 - Notifications et indicateurs admin/ONG

1. Ajouter des compteurs admin pour les nouvelles demandes de courrier, candidatures et activites a valider/publier.
2. Donner une vraie utilite a la cloche admin avec une vue ou un menu des actions en attente.
3. Creer une notification interne ONG chaque fois qu'un mail important lui est envoye depuis le site.

### Phase 3 - Workflow activites

1. Creer une page publique de detail pour chaque activite.
2. Faire pointer la decouverte d'activite vers la page detail activite, pas vers l'association.
3. Ajouter un statut de traitement aux activites: brouillon/en attente, publiee, correction demandee, rejetee.
4. Permettre a l'ONG de modifier puis resoumettre une activite apres blame/demande de correction.
5. Bloquer au maximum 3 demandes de correction/rejet pour une meme activite.

### Phase 4 - Profils et comptes

1. Permettre a l'ONG de modifier ses informations depuis son espace.
2. Ajouter un onglet profil admin pour modifier son mot de passe.

### Phase 5 - Gestion des admins par le super admin

1. Ajouter les champs nom et prenom aux admins.
2. Revoir le CRUD admin pour afficher et modifier nom, prenom, email, role et mot de passe.
3. Conserver les protections contre la suppression ou la degradation du dernier super admin.

### Phase 6 - Exports PDF et tableau de bord

1. Diagnostiquer l'export PDF ONG: dependance PDF, vues PDF et donnees envoyees.
2. Installer ou activer la dependance PDF manquante si necessaire.
3. Remplir les vues PDF actuellement vides.
4. Permettre au super admin d'exporter le tableau de bord.

### Phase 7 - Logs d'audit

1. Creer une table de logs d'actions.
2. Enregistrer les actions importantes: connexion, approbation, rejet, publication, suppression, export, modification de profil.
3. Ajouter une page super admin de consultation des logs.
4. Ajouter un export CSV, puis Excel si la dependance projet le permet, filtre par periode.

### Verification prevue

- `php artisan route:list`
- `php artisan test`
- Verification manuelle des principaux workflows dans le navigateur si le serveur local est disponible.
- Rapport final en Markdown apres execution du plan.
