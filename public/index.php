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
                        header('Location: index.php?page=offres');
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

        // Protection d'accès
        if (!isset($_SESSION['user']) || $_SESSION['user']['admin'] !== 'user') {
            header('Location: index.php?page=login');
            exit;
        }

        include __DIR__ . '/../views/header_profil.php';
        include __DIR__ . '/../views/profil_user.php';
        break;

    case 'profil_companies':
        // Protection d'accès
        if (!isset($_SESSION['user']) || $_SESSION['user']['admin'] !== 'company') {
            header('Location: index.php?page=login');
            exit;
        }

        require_once __DIR__ . '/../app/Model/Company.php';
        require_once __DIR__ . '/../app/Model/Advertisement.php'; // <-- manquait ici

        $companyModel = new Company($pdo);
        $adModel = new Advertisement($pdo);

        // Récupération de l'entreprise via l'email du user en session
        $company = $companyModel->findByEmail($_SESSION['user']['email']);

        // Récupération des annonces
        $ads = [];
        if ($company && isset($company['company_id'])) {
            $ads = $adModel->findByCompanyId((int) $company['company_id']);
        }

        include __DIR__ . '/../views/header_companies.php';
        include __DIR__ . '/../views/profil_companies.php';
        break;


    case 'ad_show':
        require_once __DIR__ . '/../app/Model/Advertisement.php';
        $adModel = new Advertisement($pdo);
        $id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        $ad = null;
        if ($id > 0) {
            // À écrire: find($id) dans Advertisement
            $ad = $adModel->find($id);
        }
        include __DIR__ . '/../views/header_companies.php';
        include __DIR__ . '/../views/ad_show.php';
        break;

    case 'offres':
        require_once __DIR__ . '/../app/Controller/AdvertisementController.php';
        $adController = new AdvertisementController($pdo);
        $adController->offres();

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

