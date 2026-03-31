# 🏀 BasketManager — Application de gestion d'équipements & terrains

> Application web développée avec **Laravel 12** permettant la gestion complète d'une salle de basket : emprunts d'équipements, réservations de terrains, suivi de statistiques de tir, et administration centralisée.

---

## 📋 Table des matières

- [Aperçu](#aperçu)
- [Fonctionnalités](#fonctionnalités)
- [Stack technique](#stack-technique)
- [Prérequis](#prérequis)
- [Installation](#installation)
- [Configuration](#configuration)
- [Lancement en développement](#lancement-en-développement)
- [Structure du projet](#structure-du-projet)
- [Schéma de base de données](#schéma-de-base-de-données)
- [Routes principales](#routes-principales)
- [Rôles & permissions](#rôles--permissions)
- [Tests](#tests)
- [Contribuer](#contribuer)

---

## Aperçu

BasketManager est une application MVC full-stack destinée aux clubs et salles de basket. Elle centralise la gestion du matériel (ballons, chaussures), la réservation des terrains, et offre aux joueurs un tableau de bord personnel avec le suivi de leurs statistiques de tir.

---

## Fonctionnalités

### 👤 Espace utilisateur (authentifié)
- Inscription / connexion sécurisée
- Tableau de bord personnel (`/compte`)
- **Emprunt de chaussures** avec suivi de l'état du matériel
- **Réservation de terrains** avec gestion des créneaux
- **Simulation de session de tir** : génération automatique de statistiques (raquette, mid-range, 3 points)
- Historique des emprunts et retours

### 🔧 Espace administration (`/admin`)
- Gestion des utilisateurs (CRUD complet)
- Gestion des terrains (création, modification, suppression)
- Gestion du parc de chaussures
- Supervision des réservations

### 🌐 Accès public
- Catalogue des ballons disponibles
- Catalogue des chaussures
- Liste des terrains

---

## Stack technique

| Couche | Technologie |
|---|---|
| Framework backend | Laravel 12 |
| Langage | PHP 8.2+ |
| Base de données | MariaDB / MySQL |
| Frontend | Blade + Vite |
| CSS | Tailwind CSS (via Vite) |
| Tests | PHPUnit 11 |
| Qualité de code | Laravel Pint |
| Dev tooling | Laravel Sail, Pail |

---

## Prérequis

Avant de commencer, assurez-vous d'avoir installé :

- **PHP** >= 8.2
- **Composer** >= 2.x
- **Node.js** >= 18.x & **npm**
- **MariaDB** ou **MySQL** >= 8.x
- Extension PHP : `pdo_mysql`, `mbstring`, `openssl`, `tokenizer`, `xml`

---

## Installation

### 1. Cloner le dépôt

```bash
git clone https://github.com/votre-organisation/basketball-manager.git
cd basketball-manager
```

### 2. Installation automatique (recommandée)

Un script Composer `setup` prend en charge l'ensemble de l'installation :

```bash
composer run setup
```

Ce script exécute dans l'ordre :
1. `composer install` — installation des dépendances PHP
2. Copie de `.env.example` vers `.env`
3. `php artisan key:generate` — génération de la clé applicative
4. `php artisan migrate --seed --force` — exécution des migrations et chargement des données
5. `npm install` — installation des dépendances JS
6. `npm run build` — compilation des assets

### 3. Installation manuelle (alternative)

```bash
# Dépendances PHP
composer install

# Environnement
cp .env.example .env
php artisan key:generate

# Base de données
php artisan migrate --seed

# Assets front-end
npm install
npm run build
```

---

## Configuration

Copiez et éditez le fichier `.env` :

```bash
cp .env.example .env
```

Variables essentielles à renseigner :

```env
APP_NAME="BasketManager"
APP_ENV=local
APP_URL=http://localhost:8000

DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_app
DB_USERNAME=root
DB_PASSWORD=votre_mot_de_passe
```

> **⚠️ Important** : Ne committez jamais le fichier `.env` sur le dépôt Git. Il est déjà listé dans le `.gitignore`.

---

## 👤 Comptes de test

Après l'installation avec `db:seed`, vous pouvez utiliser les comptes suivants :

| Rôle | Email | Mot de passe |
|---|---|---|
| **Administrateur** | `test@example.com` | `password` |

---

## Lancement en développement

La commande suivante démarre simultanément le serveur PHP, la queue, les logs en temps réel et Vite :

```bash
composer run dev
```

Processus lancés en parallèle :
- `php artisan serve` — serveur applicatif sur `http://localhost:8000`
- `php artisan queue:listen` — traitement des jobs en arrière-plan
- `php artisan pail` — agrégateur de logs en temps réel
- `npm run dev` — compilation HMR des assets (Vite)

---

## Structure du projet

```
laravel-app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── Admin/              # Contrôleurs administration
│   │       ├── AuthController.php  # Authentification
│   │       ├── BallonController.php
│   │       ├── ChaussureController.php
│   │       ├── CompteController.php
│   │       ├── EmpruntController.php
│   │       ├── ReservationController.php
│   │       ├── StatistiqueController.php
│   │       └── TerrainController.php
│   └── Models/             # Modèles Eloquent (User, Chaussure, Terrain...)
├── database/
│   ├── migrations/         # Historique complet du schéma BDD
│   └── seeders/            # Données de test (DatabaseSeeder)
├── resources/
│   ├── css/                # Styles (Tailwind via Vite)
│   └── views/              # Templates Blade
├── routes/
│   └── web.php             # Définition de toutes les routes
├── tests/                  # Tests unitaires et fonctionnels
└── vite.config.js
```

---

## Schéma de base de données

```
users               — Comptes utilisateurs
ballons             — Parc de ballons (marque, taille, état)
chaussures          — Parc de chaussures (marque, modèle, pointure, état)
terrains            — Terrains disponibles (nom, type de sol)
emprunts            — Emprunts de chaussures par les utilisateurs
reservations        — Réservations de terrains (date_debut, date_fin, statut)
session_stats       — Statistiques de tir par session
historiques         — Journal des événements
```

---

## Routes principales

| Méthode | URI | Description | Auth |
|---|---|---|---|
| `GET` | `/` | Page d'accueil | Non |
| `GET` | `/ballons` | Liste des ballons | Non |
| `GET` | `/chaussures` | Liste des chaussures | Non |
| `GET` | `/terrains` | Liste des terrains | Non |
| `GET` | `/login` | Formulaire de connexion | Non |
| `GET` | `/register` | Formulaire d'inscription | Non |
| `GET` | `/compte` | Tableau de bord utilisateur | ✅ Oui |
| `POST` | `/stats/simuler` | Simuler une session de tir | ✅ Oui |
| `POST` | `/chaussures/{id}/emprunter` | Emprunter une paire | ✅ Oui |
| `POST` | `/emprunts/{id}/retour` | Rendre un équipement | ✅ Oui |
| `POST` | `/terrains/{id}/reserver` | Réserver un terrain | ✅ Oui |
| `DELETE` | `/reservations/{id}` | Annuler une réservation | ✅ Oui |
| `GET` | `/admin` | Dashboard administrateur | ✅ Admin |
| `GET` | `/admin/users` | Gestion des utilisateurs | ✅ Admin |
| `GET` | `/admin/terrains` | Gestion des terrains | ✅ Admin |
| `GET` | `/admin/chaussures` | Gestion du catalogue de chaussures | ✅ Admin |
| `GET` | `/admin/reservations` | Supervision des réservations | ✅ Admin |

---

## Rôles & permissions

L'application distingue deux niveaux d'accès :

| Rôle | Middleware | Accès |
|---|---|---|
| **Utilisateur** | `auth` | Espace personnel, emprunts, réservations, statistiques |
| **Administrateur** | `auth` + `is_admin` | Toutes les routes `/admin/*` via resources CRUD |

---

## Tests

```bash
# Lancer la suite de tests complète
composer run test

# Analyse du style de code (Linter)
./vendor/bin/pint

# Tests avec couverture de code
php artisan test --coverage
```

---

## Contribuer

1. Créez une branche depuis `main` : `git checkout -b feature/ma-fonctionnalite`
2. Effectuez vos modifications et commitez : `git commit -m "feat: description claire"`
3. Vérifiez le style de code : `./vendor/bin/pint`
4. Lancez les tests : `composer run test`
5. Ouvrez une Pull Request avec une description détaillée

---

## Licence

Distribué sous licence **MIT**. Voir le fichier `LICENSE` pour plus d'informations.
