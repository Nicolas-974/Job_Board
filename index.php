<?php

    //Charger la config (connexion sur le PDO)
    require_once __DIR__ . '/config/config.php';

    //On charge le controlleur 
    require_once __DIR__ . '/app/Controller/AdvertisementController.php';



    // On crée le contrôleur
    $controller = new AdvertisementController($pdo);

    // On lit l’action dans l’URL, par défaut "index"
    $action = $_GET['action'] ?? 'index';
    $id = isset($_GET['id']) ? (int)$_GET['id'] : null;   // ✅ défini avant usage
    

    // On appelle la bonne méthode du contrôleur
    switch ($action) {
    case 'show':
        $id ? $controller->show($id) : $controller->index();
        break;
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store();
        break;
    case 'edit':
        $id ? $controller->edit($id) : $controller->index();
        break;
    case 'update':
        $id ? $controller->update($id) : $controller->index();
        break;
    case 'delete':
        $id ? $controller->delete($id) : $controller->index();
        break;
    default:
        $controller->index();
}

?>