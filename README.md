# Job Board

Bienvenue sur le projet **Job Board**. Ce projet est une plateforme web permettant la gestion et la consultation d'offres d'emploi en ligne. Il a été réalisé dans le cadre du module T-WEB-501.

## 📋 Description

L'objectif de ce projet est de développer une application web complète comprenant une base de données, une interface utilisateur (Front-end) et une API (Back-end)

L'application permet aux utilisateurs de consulter des offres, de s'inscrire et de postuler, tout en offrant aux administrateurs un tableau de bord complet pour gérer le contenu via des opérations CRUD

## 🛠️ Technologies Utilisées

* **Back-end :** PHP (Architecture API RESTful / CRUD).
* **Base de données :** MySQL.
* **Front-end :** HTML5, CSS3, JavaScript (Affichage dynamique sans rechargement).

## ✨ Fonctionnalités

### Partie Publique (Utilisateur)
* **Liste des offres :** Affichage des annonces avec titre et courte description.
* **Détails dynamiques :** Bouton "Learn more" affichant les détails complets (salaire, lieu, etc.) sans recharger la page.
* **Candidature :** Formulaire pour postuler à une offre (nom, email, message).
* **Authentification :** Pages de connexion et d'inscription. Une fois connecté, les champs de candidature sont pré-remplis.

### Partie Administration (Admin)
* **Tableau de bord :** Accessible uniquement aux administrateurs.
* **Gestion (CRUD) :** Création, lecture, mise à jour et suppression des données pour:
    * Les publicités (Advertisements).
    * Les entreprises (Companies).
    * Les utilisateurs (People).
    * Les candidatures (Applications).
* **Pagination :** Gestion de l'affichage pour les longues listes d'enregistrements.

## 🗄️ Structure de la Base de Données

Le projet repose sur une base de données relationnelle SQL contenant les tables suivantes :
1.  `advertisements` (Offres d'emploi)
2.  `companies` (Entreprises)
3.  `people` (Utilisateurs / Admin)
4.  `applications` (Suivi des candidatures et messages)

## 🚀 Installation et Lancement

1.  **Cloner le dépôt :**
    ```bash
    git clone [https://github.com/Nicolas-974/Job_Board.git](https://github.com/Nicolas-974/Job_Board.git)
    ```

2.  **Configuration de la Base de Données :**
    * Importer le fichier SQL fourni (ex: `database.sql` ou `schema.sql`) dans votre serveur MySQL local.
    * Configurer les identifiants de connexion (host, user, password) dans votre fichier de configuration PHP (ex: `db_connect.php` ou `config.php`).

3.  **Lancement :**
    * Placez le dossier du projet dans votre répertoire serveur (ex: `www` pour WAMP ou `htdocs` pour XAMPP) ou lancez un serveur PHP local :
    ```bash
    php -S localhost:8000
    ```
    * Accédez à l'URL : `http://localhost:8000`

## 👤 Auteur

* **Nicolas-974** - *Projet Epitech T-WEB-501*