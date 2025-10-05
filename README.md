# 🧩 Pokédex — Symfony 7.3.x + API Platform + Bootstrap 5.3.x

![Symfony](https://img.shields.io/badge/Symfony-7.3.x-111827?style=for-the-badge&logo=symfony)
![API Platform](https://img.shields.io/badge/API%20Platform-3.x-2f95ff?style=for-the-badge&logo=apachespark)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3.x-7952B3?style=for-the-badge&logo=bootstrap)
![PHP](https://img.shields.io/badge/PHP-8.3-777BB4?style=for-the-badge&logo=php)
![Made by WebAlex Solutions](https://img.shields.io/badge/Made%20by-WebAlex%20Solutions-f1c40f?style=for-the-badge)

---

## 🎮 Description

**Pokédex** est un projet complet réalisé avec **Symfony 7.3.x** et **API Platform 3.x**, combinant une interface web rétro en **Bootstrap 5.3.x** et une **API RESTful versionnée** (`/api/v1`).

Ce projet reproduit un Pokédex interactif inspiré des versions originales, avec :
- Un **design CRT rétro**, effets lumineux et sonores.
- Une **base complète de 1025 Pokémon** importée depuis la [PokéAPI officielle](https://pokeapi.co/).
- Une **interface bilingue FR/EN** avec bascule de langue dynamique.
- Un **système d’API documentée** et versionnée, prête pour intégration.

---

## 🚀 Fonctionnalités

### 🧠 Côté API (Back-end)
- ✅ Développée avec **Symfony 7.3.x** et **API Platform 3.x**
- 🔹 Endpoints RESTful (`/api/v1/pokemons`)
- 🔹 Pagination, tri et filtrage automatiques
- 🔹 Import des Pokémon depuis la PokéAPI (command CLI)
- 🔹 Versionnage propre (`v1`, extensible pour v2)
- 🔹 Champs bilingues : `name`, `nameFr`, `type`, `typeFr`, `hp`, `attack`, `defense`, `sprite`

### 🖥️ Côté Front (Interface utilisateur)
- 🎨 Design Pokédex rétro (effet CRT, LEDs animées)
- 🔊 Effet sonore au démarrage (`beep.mp3`)
- 🔄 Navigation entre Pokémon (flèches haut/bas)
- 🔍 Recherche en temps réel
- 🌐 Sélecteur de langue 🇫🇷 / 🇬🇧
- 📱 Responsive, mobile-friendly et fluide

---

## 🧩 Structure du projet

```bash
pokedex/
│
├── public/
│   ├── assets/
│   │   ├── css/
│   │   │   └── pokedex.css
│   │   ├── js/
│   │   │   └── pokedex.js
│   │   └── beep.mp3
│   └── index.php
│
├── src/
│   ├── Command/
│   │   └── ImportPokemonsCommand.php
│   ├── Controller/
│   │   └── PokedexController.php
│   ├── Entity/
│   │   └── Pokemon.php
│   └── Repository/
│       └── PokemonRepository.php
│
└── templates/
    ├── base.html.twig
    └── pokedex/
        └── index.html.twig
```

---

## ⚙️ Installation locale
### 1️⃣ Cloner le dépôt
```bash
git clone https://github.com/WebAlexSolutions/pokedex.git
cd pokedex
composer install
```

### 2️⃣ Configurer la base de données
Dans le fichier .env :
```env
DATABASE_URL="mysql://root:@127.0.0.1:3306/pokedex?serverVersion=8.0"
```
Ensuite dans la console :
```bash
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
```
ou en plus rapide et moins long :
```bash
php bin/console d:d:c
php bin/console d:m:m
```

### 3️⃣ Importer les Pokémon depuis la PokéAPI
Cette commande va importer les **1025 Pokémon** avec noms FR/EN et statistiques :
```bash
php bin/console app:import-pokemons
```

### 4️⃣ Lancer le serveur local Symfony
```bash
symfony server:start
```
ou pour lancer en arrière plan et continuer à utiliser la console sans être bloquée ou devoir éteindre le serveur symfony :
```bash
symfony server:start -d
```
Puis rendez-vous sur :
👉 http://localhost:8000

---

## 📚 API Documentation
Rendez-vous sur :
👉 http://localhost:8000/api

| Méthode | Endpoint | Description |
|----------|-----------|-------------|
| `GET` | `/api/v1/pokemons` | Liste paginée des Pokémon |
| `GET` | `/api/v1/pokemons/{id}` | Détails d’un Pokémon |
| `POST` | `/api/v1/pokemons` | Ajout d’un Pokémon |
| `PATCH` | `/api/v1/pokemons/{id}` | Mise à jour d’un Pokémon |
| `DELETE` | `/api/v1/pokemons/{id}` | Suppression d’un Pokémon |

### 🧾 Exemple de réponse JSON
```json
{
  "id": 25,
  "name": "pikachu",
  "nameFr": "Pikachu",
  "type": "electric",
  "typeFr": "Électrik",
  "hp": 35,
  "attack": 55,
  "defense": 40,
  "sprite": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/25.png"
}
```

---

## 📸 Aperçu du Pokédex

**Pokédex allumé - Langue française**

<img width="633" height="626" alt="image" src="https://github.com/user-attachments/assets/008de0c3-98c4-4e49-b74a-8a799f61d74f" />

**Pokédex allumé - Langue anglaise**

<img width="519" height="616" alt="image" src="https://github.com/user-attachments/assets/1a4a0272-bf5e-4724-9a9b-a9f534cc0874" />

---

## 🧠 Technologies utilisées
| Technologie | Version | Description |
|--------------|----------|-------------|
| **Symfony** | 7.3.x | Framework PHP principal |
| **API Platform** | 3.x | Exposition REST + Swagger |
| **Doctrine ORM** | latest | Gestion de la base de données |
| **Twig** | latest | Templates front-end |
| **Bootstrap** | 5.3.x | UI responsive et moderne |
| **PokéAPI** | — | Source de données officielle Pokémon |

---

## 🧭 Feuille de route & améliorations futures

Voici les prochaines étapes prévues pour le projet **Pokédex Rétro** 👇

| Statut | Fonctionnalité prévue | Description |
|:-------:|------------------------|--------------|
| ✅ | **Version API v1** | Version stable actuelle (FR/EN, 1025 Pokémon) |
| 🚧 | **Version API v2** | Ajout des évolutions, capacités et descriptions détaillées |
| 🧠 | **Système de filtrage avancé** | Recherche par type, génération, région ou statistiques |
| 🛠️ | **Espace d’administration (Back-Office)** | Gestion des Pokémon, utilisateurs, et paramètres de personnalisation |
| 🎨 | **Refonte du design** | Interface encore plus soignée, animations modernisées et effets visuels améliorés |
| 🌍 | **Amélioration multilingue** | Extension à d'autres langues (ES, DE, IT...) |
| 💾 | **Sauvegarde locale / Historique** | Mémorisation du dernier Pokémon consulté |
| 🔐 | **Authentification JWT** | Sécurisation des accès API et espace admin |
| 📦 | **Optimisation et performances** | Réduction du poids des ressources, mise en cache, lazy loading |
| 🧩 | **Amélioration UX/UI** | Ajustements sur la navigation, le scroll et les transitions |

---

## 🧑‍💻 Crédits

Développé avec ❤️ par WebAlex Solutions

“Attrapez-les tous — version Symfony !”
