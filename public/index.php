<?php

session_start();
ob_start();
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

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            require_once __DIR__ . '/../app/Model/User.php';
            $userModel = new User($pdo);
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $user;

                switch ($user['admin']) {
                    case 'company':
                        header('Location: index.php?page=profil_companies');
                        break;

                    case 'admin':
                        header('Location: ../admin.php'); // ou index.php?page=admin si tu préfères
                        break;

                    case 'user':
                    default:
                        header('Location: index.php?page=profil_user');
                        break;
                }

                exit;
            }
        }

        include __DIR__ . '/../views/login.php';
        break;


    case 'register':
        include __DIR__ . '/../views/header_register.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['type']) && $_POST['type'] === 'company') {
                require_once __DIR__ . '/../app/Controller/CompanyController.php';
                $companyController = new CompanyController($pdo);
                $companyController->storePublic();
            } else {
                $controller->storePublic(); // user classique
            }
        } else {
            include __DIR__ . '/../views/register.php';
        }
        break;

    case 'profil_user':
        include __DIR__ . '/../views/header_profil.php';
        include __DIR__ . '/../views/profil_user.php';
        break;

    case 'profil_companies':
        include __DIR__ . '/../views/header_companies.php';
        include __DIR__ . '/../views/profil_companies.php';
        break;

    case 'logout':
        session_destroy(); // Supprime toutes les données de session
        header('Location: index.php?page=login'); // Redirige vers la page de connexion
        exit;


    case 'home':
    default:
        include __DIR__ . '/../views/header.php';

        require_once __DIR__ . '/../app/Model/Advertisement.php';
        $adModel = new Advertisement($pdo);
        $ads = $adModel->latest(6);

        include __DIR__ . '/../views/home.php';
        break;
}

// On inclut le footer commun
// include __DIR__ . '/../views/footer.php';

