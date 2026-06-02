# 📘 DOCUMENTATION — Plateforme Mairie de Cotonou

> Guide complet de fonctionnement de la plateforme de gestion des Associations et ONG de la Mairie de Cotonou.

---

## Table des matières

1. [Présentation générale](#1-présentation-générale)
2. [Architecture technique](#2-architecture-technique)
3. [Les acteurs de la plateforme](#3-les-acteurs-de-la-plateforme)
4. [Workflow d'inscription d'une ONG](#4-workflow-dinscription-dune-ong)
5. [Espace Administrateur (Mairie)](#5-espace-administrateur-mairie)
6. [Espace Association / ONG](#6-espace-association--ong)
7. [Espace Visiteur (Public)](#7-espace-visiteur-public)
8. [Système de Notifications](#8-système-de-notifications)
9. [Gestion des Activités](#9-gestion-des-activités)
10. [Gestion des Demandes (Courriers)](#10-gestion-des-demandes-courriers)
11. [Système d'Avis Citoyens](#11-système-davis-citoyens)
12. [Exports PDF](#12-exports-pdf)
13. [Base de données](#13-base-de-données)
14. [Configuration Email](#14-configuration-email)

---

## 1. Présentation générale

La plateforme **Mairie de Cotonou** est une application web permettant à la Mairie de gérer, suivre et évaluer les Associations et ONG enregistrées sur son territoire. Elle offre trois espaces distincts :

- **Espace Public** : Vitrine accessible à tous les visiteurs, présentant les ONG/Associations approuvées et leurs activités.
- **Espace ONG/Association** : Tableau de bord privé permettant à chaque organisation de gérer son profil, publier des activités et suivre ses demandes.
- **Espace Administrateur (Mairie)** : Console d'administration permettant de modérer les inscriptions, évaluer les activités, traiter les demandes et générer des rapports.

---

## 2. Architecture technique

| Composant | Technologie |
|---|---|
| **Backend** | Laravel (PHP) |
| **Frontend** | Blade + TailwindCSS |
| **Interactivité** | AlpineJS |
| **Base de données** | MySQL |
| **Serveur de dev** | `php artisan serve` + `npm run dev` (Vite) |
| **Email** | SMTP (Gmail) via `Mail::raw()` |

### Structure des dossiers clés

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Auth/              → Connexion, Inscription, Mot de passe
│   │   ├── Admin/             → Dashboard, Associations, Activités, Candidatures
│   │   ├── ActivityController → Gestion activités côté ONG
│   │   ├── UserController     → Pages publiques et espace ONG
│   │   └── NotificationController → Notifications (envoi + lecture)
│   └── Requests/              → Validation des formulaires (FormRequest)
├── Models/                    → User, Activity, Notification, Review, AssociationRequest
├── Enums/                     → UserGroup, RequestStatus, EvaluationStatus
└── Services/                  → StatsService (statistiques dashboard)

resources/views/
├── layouts/                   → app.blade.php, admin.blade.php
├── auth/                      → Login, Inscription (3 étapes), Confirmation, Changement MDP
├── pages/                     → Accueil, Associations, Détails, FAQ, Contact, À propos
├── user/                      → show.blade.php (Dashboard ONG avec onglets)
└── admin/                     → Dashboard, Associations, Activités, Candidatures, Avis
```

---

## 3. Les acteurs de la plateforme

### 👤 Visiteur (non authentifié)
- Consulte la liste des associations et ONG **approuvées**.
- Consulte le détail d'une association et ses activités **publiées**.
- Laisse un avis (nom, note, commentaire) sur une ONG ou une activité.
- Accède aux pages : Accueil, Associations, FAQ, Contact, À propos.

### 🏢 Association / ONG (authentifié)
- Gère son profil (informations, logo, bureau exécutif).
- Publie des propositions d'activités (soumises à validation).
- Génère des demandes de courrier à la Mairie.
- Consulte ses notifications (évaluations, avertissements, publications).
- Change son mot de passe.

### 🏛️ Administrateur Mairie (authentifié, guard `admin`)
- Valide ou rejette les inscriptions d'ONG.
- Modère les activités : évaluation (score), publication, avertissement, suppression.
- Traite les demandes de courrier (approuver/rejeter).
- Crée des ONG directement (auto-approuvées).
- Consulte les statistiques globales.
- Exporte des rapports en PDF.

### 5.8 Gestion des Administrateurs (`/admin/super-admin`) — Super Admin uniquement
- CRUD complet des comptes administrateurs (créer, modifier, supprimer).
- Attribution du rôle Super Administrateur via une case à cocher.
- Un Super Admin ne peut pas se supprimer lui-même.
- Interface avec modaux interactifs (Alpine.js) pour la création et la modification.

---

## 4. Workflow d'inscription d'une ONG

C'est le processus le plus critique de la plateforme, conçu pour garantir la sécurité.

### Étape 1 — L'ONG s'inscrit (formulaire en 3 étapes)

```
Étape 1/3 : Informations générales
  → Groupe (Association/ONG), Nom, Domaine, Dénomination, Date de création, 3 Objectifs

Étape 2/3 : Coordonnées
  → Siège, Email, Téléphones
  ⚠️ L'ONG ne définit PAS de mot de passe (un mot de passe aléatoire est généré en interne)

Étape 3/3 : Bureau exécutif & Pièces jointes
  → Président, Vice-Président, Secrétaire Général, Trésorier Général
  → Logo, Couverture, Pièces justificatives
```

### Étape 2 — Page de confirmation

À la fin de l'inscription, l'ONG voit un message :
> *"Votre candidature a été soumise. La Mairie va examiner votre dossier. Vous recevrez un email une fois votre inscription validée."*

**L'ONG ne peut PAS se connecter à ce stade.** Si elle essaie, elle voit :
> *"Votre candidature est en cours d'examen par la Mairie."*

**L'ONG n'apparaît PAS sur le site public.**

### Étape 3 — L'administrateur examine le dossier

L'admin accède à la page **Candidatures en attente** (`/admin/candidates`) et consulte toutes les informations renseignées par l'ONG.

- **Approuver** :
  1. Un mot de passe aléatoire est généré.
  2. Le compte est marqué comme approuvé (`is_approved = true`).
  3. Un email est envoyé à l'ONG avec ses identifiants (email + mot de passe temporaire + lien de connexion).
  4. Une notification interne est créée.

- **Rejeter** (motif obligatoire) :
  1. Un email de rejet est envoyé à l'ONG avec le motif.
  2. Le compte est **supprimé** de la base de données.

### Étape 4 — Première connexion de l'ONG

1. L'ONG se connecte avec le mot de passe reçu par email.
2. Elle est **automatiquement redirigée** vers la page de changement de mot de passe.
3. Une fois le mot de passe changé, elle accède à son espace normalement.
4. L'ONG est désormais **visible** sur le site public.

### Cas particulier : Création par l'Admin

Quand l'admin crée une ONG lui-même via son interface, celle-ci est **automatiquement approuvée** (pas besoin de validation).

---

## 5. Espace Administrateur (Mairie)

**URL** : `/admin`  
**Guard** : `auth:admin`

### 5.1 Tableau de bord (`/admin`)
- **Statistiques** : Nombre total d'associations, ONG, demandes (en attente/traitées), activités, avis.
- **Graphiques** : Évolution mensuelle des inscriptions, demandes et activités.
- **Aperçu rapide** : Dernières inscriptions, demandes récentes, notifications.

### 5.2 Gestion des Associations (`/admin/associations`)
- Liste paginée de toutes les associations/ONG.
- Actions : Voir le profil, Modifier, Supprimer.
- Création d'une nouvelle ONG en 3 étapes (auto-approuvée).

### 5.3 Candidatures en attente (`/admin/candidates`)
- Liste des ONG avec `is_approved = false`.
- Vue détaillée de chaque dossier (infos, objectifs, coordonnées, bureau, pièces jointes).
- Boutons **Approuver** et **Rejeter** (avec modale de justification).

### 5.4 Gestion des Activités (`/admin/activities`)
- Grille de toutes les activités soumises par les ONG.
- **Modale de détails** : Titre, Description, Budget, Bénéficiaires, Public cible, Score.
- Actions :
  - **Publier** : Rend l'activité visible du public (`is_visible = true`).
  - **Évaluer** : Attribution d'un score sur 100 avec commentaire et statut (Conforme / À suivre / Non conforme).
  - **Avertir** : Envoie un avertissement justifié à l'ONG.
  - **Supprimer** : Supprime l'activité avec notification justifiée à l'ONG.

### 5.5 Gestion des Demandes (`/admin/requests`)
- Liste des courriers/demandes soumis par les ONG.
- Actions : Approuver, Rejeter.

### 5.6 Modération des Avis (`/admin/reviews`)
- Liste de tous les avis citoyens.
- Action : Supprimer les avis inappropriés.

### 5.7 Exports PDF
- Export du profil d'une association.
- Export par domaine d'activité.
- Export des statistiques globales.

---

## 6. Espace Association / ONG

**URL** : `/user/{id}`  
**Guard** : `auth`

L'espace ONG est organisé en **4 onglets** via une sidebar latérale :

### 6.1 Mon Profil
- Affiche toutes les informations de l'association.
- Permet la modification du profil (infos générales, coordonnées, bureau exécutif).

### 6.2 Mes Activités
- Liste des activités créées par l'ONG (visibles et en attente).
- **Bouton "Nouvelle Activité"** ouvrant une modale avec :
  - Titre, Description, Lieu, Date de début/fin, Image.
  - **Budget prévu** (montant en FCFA).
  - **Bénéficiaires espérés** (nombre de personnes).
  - **Public cible** (Jeunes, Femmes, Orphelins, Personnes âgées, Tous publics...).
- ⚠️ Toute activité soumise a `is_visible = false` par défaut. Elle ne sera visible du public qu'après validation par l'admin.
- **Données visibles uniquement par l'ONG et l'Admin** : Budget, Bénéficiaires. Ces données ne sont **jamais affichées** aux visiteurs publics.

### 6.3 Mes Demandes
- Formulaire de génération de courrier officiel à la Mairie.
- Suivi du statut des demandes (En attente, Approuvé, Rejeté).

### 6.4 Mes Notifications
- **Badge rouge** sur l'onglet indiquant le nombre de notifications **non lues**.
- Liste des notifications ordonnées par date (les plus récentes en premier).
- **Indicateurs visuels** :
  - Non lue : fond coloré + bordure verte + point lumineux.
  - Lue : fond blanc, texte atténué.
- **Lecture interactive** : un clic sur une notification la marque comme "lue" (appel asynchrone au serveur), le badge se décrémente instantanément sans rechargement de page.
- **Icônes contextuelles** :
  - 🔴 Rouge : Suppression d'activité / Rejet.
  - 🟡 Ambre : Avertissement.
  - 🔵 Bleu : Information générale (évaluation, publication, bienvenue).

---

## 7. Espace Visiteur (Public)

### 7.1 Page d'accueil (`/accueil`)
- Présentation des ONG/Associations **approuvées**.
- Section "Activités Récentes" (grille 3 colonnes, activités publiées uniquement).
- Section "Derniers Avis" du public.
- Modale d'avis permettant de noter une ONG et/ou une activité.

### 7.2 Associations et ONG (`/association-et-ong`)
- Liste complète des organisations **approuvées**.
- Cartes avec logo, nom, domaine.

### 7.3 Détails d'une Association (`/association/{id}`)
- Informations de l'ONG (uniquement si approuvée).
- Activités publiées (titre, description, lieu, date, public cible — **pas de budget ni de bénéficiaires**).
- Avis citoyens et formulaire pour en laisser un.

### 7.4 Autres pages
- **À propos** (`/apropos`) : Présentation de la Mairie.
- **FAQ** (`/faq`) : Questions fréquentes.
- **Contact** (`/contact`) : Formulaire de contact.

---

## 8. Système de Notifications

Les notifications sont **internes uniquement** (pas d'email) pour les actions de modération des activités.

| Action Admin | Notification ONG |
|---|---|
| Activité évaluée | Score, statut et commentaire |
| Activité publiée | Message de félicitations |
| Avertissement envoyé | Motif de l'avertissement |
| Activité supprimée | Motif de la suppression |
| Inscription validée | Message de bienvenue |

L'email est réservé aux communications officielles :
- Approbation d'inscription (avec mot de passe).
- Rejet d'inscription (avec motif).
- Courriers officiels.

---

## 9. Gestion des Activités

### Cycle de vie d'une activité

```
┌─────────────────┐     ┌─────────────────┐     ┌─────────────────┐
│   ONG soumet    │     │  Admin modère   │     │  Visiteur voit  │
│   l'activité    │────▶│  et évalue      │────▶│  l'activité     │
│ (is_visible=0)  │     │  Score /100     │     │ (is_visible=1)  │
└─────────────────┘     │  Publication    │     └─────────────────┘
                        └─────────────────┘
```

### Données d'une activité

| Champ | Visible Public | Visible ONG | Visible Admin |
|---|---|---|---|
| Titre | ✅ | ✅ | ✅ |
| Description | ✅ | ✅ | ✅ |
| Lieu | ✅ | ✅ | ✅ |
| Date début/fin | ✅ | ✅ | ✅ |
| Image | ✅ | ✅ | ✅ |
| Public cible | ✅ | ✅ | ✅ |
| **Budget prévu** | ❌ | ✅ | ✅ |
| **Bénéficiaires espérés** | ❌ | ✅ | ✅ |
| Score d'évaluation | ❌ | ✅ (via notification) | ✅ |

---

## 10. Gestion des Demandes (Courriers)

Les ONG peuvent soumettre des demandes officielles à la Mairie (courriers administratifs).

- **Soumission** par l'ONG via le formulaire dédié.
- **Traitement** par l'Admin : Approuver ou Rejeter.
- **Suivi** : L'ONG peut voir le statut de ses demandes (En attente / Approuvé / Rejeté).
- **Statuts** définis par l'Enum `RequestStatus` : `PENDING`, `APPROVED`, `REJECTED`.

---

## 11. Système d'Avis Citoyens

- Tout visiteur (sans inscription) peut laisser un avis sur une ONG.
- L'avis comprend : Nom de l'auteur, Note (1 à 5 étoiles), Commentaire.
- Un avis peut être associé à une activité spécifique ou à l'ONG en général.
- L'admin peut supprimer les avis inappropriés depuis l'interface de modération.

---

## 12. Exports PDF

L'administrateur peut générer des documents PDF :

| Export | Route | Description |
|---|---|---|
| Profil Association | `/pdf/{id}` | Fiche complète d'une association |
| Par domaine | `/admin/export/domaine` | Liste des associations par domaine |
| Statistiques | `/admin/stats/pdf` | Rapport statistique global |

---

## 13. Base de données

### Tables principales

| Table | Description |
|---|---|
| `users` | Associations et ONG (avec `is_approved`, `must_change_password`) |
| `admins` | Comptes administrateurs Mairie |
| `activities` | Activités des ONG (avec `is_visible`, `budget_expected`, `beneficiaries_expected`, `target_audience`) |
| `requests` | Demandes de courrier |
| `notifications` | Notifications internes (avec `is_read`) |
| `reviews` | Avis citoyens |

### Enums

| Enum | Valeurs |
|---|---|
| `UserGroup` | `association`, `ong` |
| `RequestStatus` | `PENDING`, `APPROVED`, `REJECTED` |
| `EvaluationStatus` | `COMPLIANT`, `WARNING`, `NON_COMPLIANT` |

---

## 14. Configuration Email

Le système utilise Gmail SMTP pour l'envoi d'emails. Configuration dans le fichier `.env` :

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME="votre-adresse@gmail.com"
MAIL_PASSWORD="votre-mot-de-passe-application"
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="votre-adresse@gmail.com"
MAIL_FROM_NAME="${APP_NAME}"
```

> **Note** : Le `MAIL_PASSWORD` doit être un **mot de passe d'application** Gmail (pas votre mot de passe habituel). Vous pouvez le générer dans les paramètres de sécurité de votre compte Google : *Compte Google → Sécurité → Mots de passe des applications*.

L'adresse dans `MAIL_FROM_ADDRESS` est l'expéditeur. Les emails sont envoyés à **n'importe quelle adresse** renseignée par l'ONG lors de son inscription.
