# TaskFlow - Kanban Todo Application

TaskFlow est une application de gestion de tâches Kanban qui permet aux équipes de collaborer efficacement en créant, assignant, et suivant les tâches. Cette documentation explique comment configurer, utiliser et maintenir le projet.

## Fonctionnalités principales

*   **Système d'authentification :** Inscription et connexion des utilisateurs.
*   **Gestion des projets :** Création et gestion des projets.
*   **Ajout de membres :** Attribution de membres à un projet.
*   **Gestion des tâches :** Création, modification, suppression et affectation de tâches aux membres de l'équipe.
*   **Kanban Board :** Visualisation des tâches par état (Todo, Doing, Done).

## Structure du projet

*   `config/` : Contient les fichiers de configuration.
*   `init.sql` : Script SQL pour initialiser la base de données.
*   `database.php` : Connexion à la base de données.
*   `controllers/` : Contient les scripts PHP qui gèrent la logique de l'application.
*   `task/` : Contrôleurs pour la gestion des tâches.
*   Exemples : `addmember.php`, `addteams.php`, `delete_task.php`, `task.php`.
*   `CSS/` : Contient les fichiers CSS générés par Tailwind CSS.
*   `input.css` : Fichier source CSS.
*   `output.css` : Fichier compilé CSS.
*   `models/` : Contient les modèles pour l’accès aux données.
*   `views/` : Contient les fichiers de vue pour afficher l’interface utilisateur.
*   `.htaccess` : Fichier de configuration Apache pour router toutes les requêtes via `index.php`.
*   `index.php` : Point d'entrée principal de l'application.
*   `main.js` : Fichier JavaScript pour la gestion des interactions frontend.

## Approche de développement

Le projet est structuré selon le modèle MVC (Modèle-Vue-Contrôleur) pour séparer la logique métier, les interfaces utilisateur et les interactions. Il utilise également des principes de Programmation Orientée Objet (OOP) pour améliorer la modularité et la réutilisabilité du code.

## Configuration

### Prérequis

*   **Environnement Laragon :** Assurez-vous que Laragon est installé et configuré sur votre machine.
*   **PHP :** Version 7.4 ou supérieure.

### Installation

1.  Clonez le dépôt dans le dossier `www` de Laragon :

    ```bash
    git clone <url-du-depot> TaskFlow
    ```

2.  Configurez le fichier `database.php` :

    ```php
    define('DB_HOST', 'localhost');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    define('DB_NAME', 'TaskFlow');
    ```

3.  Configurez le fichier `.htaccess` :

    ```apache
    RewriteEngine On
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.*)$ index.php [QSA,L]
    ```

4. executer la commande (tailwind):

    ```bash
   npm start
    ```

5.  Configurez Laragon pour que le dossier `TaskFlow` soit le root, puis accédez à l'application via `http://localhost/`.

## Base de données

## Tables principales

*   `users` : Stocke les informations des utilisateurs (nom, email, mot de passe, rôle).
*   `projects` : Contient les projets (nom, description, visibilité, date d'échéance, utilisateur responsable).
*   `categories` : Stocke les catégories de tâches (par exemple, "Développement", "Design").
*   `tags` : Stocke les tags associés aux tâches (par exemple, "Urgent", "Frontend").
*   `tasks` : Contient les tâches à réaliser (titre, description, statut, date d'échéance).
*   `project_users` : Associe les utilisateurs aux projets.
*   `task_users` : Associe les utilisateurs aux tâches.
*   `task_tags` : Associe les tags aux tâches.

## Utilisation

### Connexion
- Créez un compte ou connectez-vous avec vos identifiants.

### Créer un projet
- Allez sur la page **"home"** et créez un projet.

### Ajouter des membres
- Ajoutez des membres à votre projet via l’interface.

### Gérer les tâches
- Créez une nouvelle tâche.
- Assignez la tâche à un ou plusieurs membres.
- Modifiez ou supprimez une tâche si nécessaire.

### Suivre les tâches
- Consultez le tableau **Kanban** pour visualiser l’état des tâches.
---

## Contribution

1. Forkez le dépôt.
2. Créez une branche pour vos modifications :

    ```bash
    git checkout -b feature/nouvelle-fonctionnalite
    ```

3. Soumettez une pull request pour examen.

---

## Support
Pour toute question ou assistance, veuillez contacter l’équipe de développement via **ayoubakraou@gmail.com**.


