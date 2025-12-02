# Job Board

Bienvenue sur le projet **Job Board**. Ce projet est une plateforme web permettant la gestion et la consultation d'offres d'emploi en ligne. Il a été réalisé dans le cadre du module T-WEB-501.

## 📋 Description

[cite_start]L'objectif de ce projet est de développer une application web complète comprenant une base de données, une interface utilisateur (Front-end) et une API (Back-end)[cite: 11].

[cite_start]L'application permet aux utilisateurs de consulter des offres, de s'inscrire et de postuler, tout en offrant aux administrateurs un tableau de bord complet pour gérer le contenu via des opérations CRUD[cite: 13, 16, 18].

## 🛠️ Technologies Utilisées

* [cite_start]**Back-end :** PHP (Architecture API RESTful / CRUD)[cite: 49, 53].
* [cite_start]**Base de données :** MySQL[cite: 29].
* [cite_start]**Front-end :** HTML5, CSS3, JavaScript (Affichage dynamique sans rechargement)[cite: 14, 38, 42].

## ✨ Fonctionnalités

### Partie Publique (Utilisateur)
* [cite_start]**Liste des offres :** Affichage des annonces avec titre et courte description[cite: 38].
* [cite_start]**Détails dynamiques :** Bouton "Learn more" affichant les détails complets (salaire, lieu, etc.) sans recharger la page.
* [cite_start]**Candidature :** Formulaire pour postuler à une offre (nom, email, message)[cite: 56, 57].
* **Authentification :** Pages de connexion et d'inscription. [cite_start]Une fois connecté, les champs de candidature sont pré-remplis[cite: 60, 61].

### Partie Administration (Admin)
* [cite_start]**Tableau de bord :** Accessible uniquement aux administrateurs[cite: 67].
* [cite_start]**Gestion (CRUD) :** Création, lecture, mise à jour et suppression des données pour[cite: 49, 66]:
    * [cite_start]Les publicités (Advertisements)[cite: 31].
    * [cite_start]Les entreprises (Companies)[cite: 33].
    * [cite_start]Les utilisateurs (People)[cite: 34].
    * [cite_start]Les candidatures (Applications)[cite: 35].
* [cite_start]**Pagination :** Gestion de l'affichage pour les longues listes d'enregistrements[cite: 68].

## 🗄️ Structure de la Base de Données

[cite_start]Le projet repose sur une base de données relationnelle SQL contenant les tables suivantes [cite: 30-35] :
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