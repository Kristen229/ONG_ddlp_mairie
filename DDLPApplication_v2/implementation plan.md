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
