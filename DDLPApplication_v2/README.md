# 🏛️ Plateforme de Gestion des Associations et ONG - Mairie de Cotonou

Application web de gestion, suivi et évaluation des Associations et ONG enregistrées sur le territoire de la Mairie de Cotonou.

---

## 🚀 Démarrage rapide

### Prérequis

- **PHP** ≥ 8.2
- **Composer**
- **Node.js** ≥ 18 + **npm**
- **MySQL** ≥ 5.7
- **Git**

### Installation

```bash
# 1. Cloner le projet
git clone https://github.com/votre-repo/DDLPApplication_v2.git
cd DDLPApplication_v2

# 2. Installer les dépendances
composer install
npm install

# 3. Configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Configurer la base de données dans .env
# DB_DATABASE=ddlpmairieapplication
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Lancer les migrations
php artisan migrate

# 6. Créer le lien de stockage (pour les images/fichiers uploadés)
php artisan storage:link

# 7. Lancer le serveur de développement
php artisan serve     # Backend → http://localhost:8000
npm run dev           # Frontend (Vite) → compilation automatique
```

---

## 📁 Structure du projet

```
DDLPApplication_v2/
├── app/
│   ├── Enums/              # UserGroup, RequestStatus, EvaluationStatus
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/      # Dashboard, Associations, Activités, Candidatures
│   │   │   └── Auth/       # Login, Register, Mot de passe
│   │   └── Requests/       # Validation des formulaires
│   ├── Models/             # User, Activity, Notification, Review, AssociationRequest
│   └── Services/           # StatsService
├── database/migrations/    # Toutes les migrations
├── resources/views/
│   ├── admin/              # Vues administration
│   ├── auth/               # Connexion, Inscription, Confirmation
│   ├── pages/              # Pages publiques
│   └── user/               # Dashboard ONG
├── routes/web.php          # Toutes les routes
├── DOCUMENTATION.md        # Documentation complète
└── README.md               # Ce fichier
```

---

## 👥 Rôles utilisateurs

| Rôle | Accès | Guard |
|---|---|---|
| **Visiteur** | Pages publiques, avis | Aucun |
| **ONG / Association** | Dashboard, activités, demandes, notifications | `auth` |
| **Administrateur Mairie** | Administration complète | `auth:admin` |

---

## 🔐 Sécurité — Workflow d'inscription

L'inscription des ONG suit un processus sécurisé en plusieurs étapes :

1. **L'ONG remplit le formulaire** (3 étapes : Infos → Coordonnées → Bureau exécutif).
2. **Candidature soumise** — L'ONG ne peut pas se connecter, n'est pas visible publiquement.
3. **L'Admin examine et valide** — Un mot de passe temporaire est généré et envoyé par email.
4. **Première connexion** — L'ONG est redirigée vers le changement de mot de passe obligatoire.
5. **Accès complet** — L'ONG est visible publiquement et accède à son espace.

> Les ONG créées directement par l'Admin sont automatiquement approuvées.

---

## 📋 Fonctionnalités principales

### Pour les ONG
- ✅ Gestion du profil et des informations
- ✅ Publication d'activités (soumises à validation)
- ✅ Génération de demandes de courrier
- ✅ Notifications interactives (lu/non lu)

### Pour l'Administrateur
- ✅ Validation/Rejet des inscriptions (avec email)
- ✅ Évaluation des activités (score /100)
- ✅ Publication / Avertissement / Suppression d'activités
- ✅ Traitement des demandes de courrier
- ✅ Modération des avis citoyens
- ✅ Statistiques et graphiques
- ✅ Exports PDF

### Pour les Visiteurs
- ✅ Consultation des ONG et activités publiées
- ✅ Dépôt d'avis (nom + note + commentaire)
- ✅ Pages d'information (FAQ, Contact, À propos)

---

## ✉️ Configuration Email

Pour activer l'envoi d'emails (validation/rejet d'inscription), configurez Brevo dans `.env` :

```env
MAIL_MAILER=brevo
MAIL_FROM_ADDRESS="votre-adresse-verifiee@domaine.com"
MAIL_FROM_NAME="${APP_NAME}"
BREVO_API_KEY="votre_cle_api_brevo"
```

> ⚠️ L'adresse d'expédition (`MAIL_FROM_ADDRESS`) doit correspondre à un expéditeur ou domaine vérifié sur votre compte Brevo pour que les e-mails ne finissent pas dans les spams.

---

## 🗄️ Base de données

| Table | Description |
|---|---|
| `users` | Associations / ONG |
| `admins` | Comptes administrateurs |
| `activities` | Activités des ONG |
| `requests` | Demandes de courrier |
| `notifications` | Notifications internes |
| `reviews` | Avis citoyens |

### Commandes utiles

```bash
php artisan migrate              # Lancer les migrations
php artisan migrate:rollback     # Annuler la dernière migration
php artisan migrate:fresh        # Recréer toute la base (⚠️ perd les données)
```

---

## 🛠️ Commandes de développement

```bash
# Serveur de développement
php artisan serve
npm run dev

# Build production
npm run build

# Vider les caches
php artisan cache:clear
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Voir toutes les routes
php artisan route:list
```

---

## 📖 Documentation complète

Pour une description détaillée de chaque fonctionnalité, workflow et composant technique, consultez le fichier **[DOCUMENTATION.md](DOCUMENTATION.md)**.

---

## 📄 Licence

Ce projet est développé dans le cadre d'un stage à la Mairie de Cotonou. Tous droits réservés.
