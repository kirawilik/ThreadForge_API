# ThreadForge API 🚀

> **Headless REST API** développée avec **Laravel** permettant de transformer automatiquement des notes techniques, des articles de blog ou des README GitHub en publications optimisées pour **X (Twitter)** grâce à l'IA.

---

## 📖 À propos

ThreadForge API est un outil interne destiné aux créateurs de contenu technique souhaitant automatiser la création de publications pour X.

L'application sépare complètement **la logique métier**, **les règles de style** et **la génération IA** grâce à une architecture headless basée sur Laravel.

Elle permet de :

* Transformer du contenu brut en publication optimisée
* Centraliser des règles de rédaction réutilisables (Blueprints)
* Générer les contenus de manière asynchrone via les Queues Laravel
* Dialoguer avec un assistant IA capable de modifier les publications tout en conservant le contexte de la conversation
* Utiliser des outils (Tools) Laravel pour éviter les hallucinations de l'IA

---

# ✨ Fonctionnalités

## 🔐 Authentification

* Inscription
* Connexion
* Déconnexion
* Authentification via Laravel Sanctum
* Bearer Token

---

## 📋 Campaign Blueprints

Chaque utilisateur peut créer plusieurs Blueprints contenant ses règles éditoriales :

Exemple :

* Audience cible
* Ton
* Longueur maximale
* Nombre maximal de hashtags
* Contraintes de rédaction
* Objectifs marketing

Ces Blueprints seront utilisés automatiquement lors de la génération des posts.

---

## 🤖 Génération IA

À partir :

* d'un article Markdown
* d'un README GitHub
* de notes techniques
* d'un texte libre

ThreadForge génère automatiquement :

* Hook
* Corps du post
* Hashtags
* Score de lisibilité
* Justification du respect du ton

Le traitement est effectué **en arrière-plan** grâce aux Jobs Laravel.

Le client reçoit immédiatement :

```http
202 Accepted
```

---

## 💬 Ghostwriter Assistant

Chaque post possède son propre assistant conversationnel.

Exemples :

> Donne-moi 3 hooks plus agressifs

> Ajoute un CTA

> Simplifie ce thread

> Rends ce post plus viral

L'assistant dispose :

* d'une mémoire de conversation
* d'outils Laravel
* du contexte du Blueprint
* de l'historique des versions

---

# 🏗 Architecture

```
Client

    │

REST API

    │

Laravel

├── Auth (Sanctum)

├── Campaign Blueprints

├── Posts

├── AI Generation

├── Chat Agent

└── Queue Jobs

          │

      laravel/ai SDK

          │

       API Grok
```

---

# 📦 Stack Technique

* Laravel 12
* PHP 8.3+
* Laravel Sanctum
* Laravel Queues
* Laravel API Resources
* Laravel Form Requests
* laravel/ai SDK
* MySQL
* Redis (Queue)
* Eloquent Casts JSON

---

# 📂 Structure du projet

```
app/

├── Actions/

├── Http/

│   ├── Controllers/

│   ├── Requests/

│   └── Resources/

├── Jobs/

├── Models/

├── Services/

├── AI/

│   ├── Agents/

│   ├── Tools/

│   └── Prompts/

└── Policies/
```

---

# 🧠 Structured Output

La génération IA respecte obligatoirement le contrat suivant :

```json
{
  "hook_propose": "string",
  "body_points": [
    "string"
  ],
  "technicalreadabilityscore": 85,
  "suggested_hashtags": [
    "Laravel",
    "PHP"
  ],
  "tonecompliancejustification": "..."
}
```

Les données complexes sont stockées dans des colonnes **JSON** et converties automatiquement grâce aux **Eloquent Casts**.

---

# 🛠 Tools IA

L'agent conversationnel possède plusieurs outils réels.

## getCampaignRules(int $campaignId)

Retourne les règles de rédaction du Blueprint.

Exemple :

* ton
* audience
* hashtags maximum
* longueur maximale

---

## getPostHistory(int $postId)

Retourne toutes les versions précédentes du post afin de permettre à l'IA de comprendre son historique.

---

# 🔄 Cycle de vie d'un post

```
Draft

   ↓

Generated

   ↓

Archived

   ↓

Posted
```

Chaque statut est modifiable via l'API.

---

# 📡 API REST

## Auth

| Méthode | Endpoint      |
| ------- | ------------- |
| POST    | /api/register |
| POST    | /api/login    |
| POST    | /api/logout   |

---

## Blueprints

| Méthode | Endpoint            |
| ------- | ------------------- |
| GET     | /api/campaigns      |
| POST    | /api/campaigns      |
| GET     | /api/campaigns/{id} |
| PUT     | /api/campaigns/{id} |
| DELETE  | /api/campaigns/{id} |

---

## Posts

| Méthode | Endpoint               |
| ------- | ---------------------- |
| POST    | /api/posts             |
| GET     | /api/posts             |
| GET     | /api/posts/{id}        |
| PATCH   | /api/posts/{id}/status |

---

## Chat

| Méthode | Endpoint             |
| ------- | -------------------- |
| POST    | /api/posts/{id}/chat |

---

# 🔐 Sécurité

Toutes les routes privées utilisent :

```
auth:sanctum
```

Les réponses sont exclusivement au format JSON.

---

# ⚙ Installation

```bash
git clone https://github.com/username/threadforge-api.git

cd threadforge-api

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan storage:link
```

Configurer ensuite les variables :

```
DB_DATABASE=

DB_USERNAME=

DB_PASSWORD=

AI_API_KEY=

QUEUE_CONNECTION=redis
```

Lancer le serveur :

```bash
php artisan serve
```

Démarrer le worker :

```bash
php artisan queue:work
```

---

# 🧪 Tests

```bash
php artisan test
```

---

# 🎯 Objectifs pédagogiques

Ce projet met en pratique :

* Architecture REST Headless
* Laravel Sanctum
* Laravel Queues
* API Resources
* Form Requests
* Eloquent Relationships
* Eloquent Casts
* Structured Output IA
* Agents IA
* Function Calling
* Memory Management
* Clean Architecture
* SOLID
* Repository Pattern (optionnel)

---

# 🚀 Évolutions futures

* Génération de threads complets
* Planification de publication
* Intégration de l'API X
* Analytics des performances
* Support LinkedIn
* Support Bluesky
* Suggestions automatiques de sujets
* Multi-modèles IA

---

# 👨‍💻 Auteur

Développé dans le cadre d'un projet de démonstration autour de **Laravel**, **REST API**, **Intelligence Artificielle** et **Automatisation de contenu**.

---

# 📄 Licence

Projet distribué sous licence **MIT**.
