<?php

session_start();
require_once __DIR__ . '/../app/Controller/UserController.php';
require_once __DIR__ . '/../config/config.php'; // ton fichier de connexion PDO
$controller = new UserController($pdo);
// index.php

// On récupère la page demandée dans l’URL
$page = $_GET['page'] ?? 'home';


// On affiche la bonne page selon $page
switch ($page) {
    case 'login':
        include __DIR__ . '/../views/header_login.php';
        include __DIR__ . '/../views/login.php';
        break;


    case 'register':
        include __DIR__ . '/../views/header_register.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller->storePublic();
        } else {
            include __DIR__ . '/../views/register.php';
        }
        break;

    case 'profil_user':
        include __DIR__ . '/../views/header_profil.php';
        include __DIR__ . '/../views/profil_user.php';
        break;

    case 'logout':
        session_destroy(); // Supprime toutes les données de session
        header('Location: index.php?page=login'); // Redirige vers la page de connexion
        exit;

        
    case 'home':
    default:
        include __DIR__ . '/../views/header.php';
        include __DIR__ . '/../views/home.php';
        break;
}

// On inclut le footer commun
include __DIR__ . '/../views/footer.php';