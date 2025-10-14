<?php

session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['admin'] !== 'admin') {
    header('Location: public/index.php?page=login');
    exit;
}


// Connexion PDO
require_once __DIR__ . '/config/config.php';

// Import du contrôleur des annonces
require_once __DIR__ . '/app/Controller/AdvertisementController.php';
require_once __DIR__ . '/app/Controller/UserController.php';
require_once __DIR__ . '/app/Controller/CompanyController.php';
require_once __DIR__ . '/app/Controller/JobController.php';




// On récupère la section demandée dans l’URL (ex: admin.php?section=offers)
$section = $_GET['section'] ?? null;
$action = $_GET['action'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Page Admin - Job Board</title>
  <link rel="stylesheet" type="text/css" media="screen" href="public/css/admin.css">
  <!-- Lien vers Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

  <!-- Header -->
  <header>
    <h1>Page Admin</h1>
  </header>

  <!-- Contenu principal -->
  <div class="container-fluid">

    <div class="row">
      
      <!-- Sidebar -->
      <nav class="col-md-3 col-lg-2 sidebar">
        <h5>Tableaux de Bord</h5>
        <a href="admin.php?section=users">Utilisateurs</a>
        <a href="admin.php?section=offers">Offres</a>
        <a href="admin.php?section=companies">Entreprises</a>
        <a href="admin.php?section=jobs">Candidatures</a><br><br>

        <a href="public/index.php?page=logout" class="btn btn-danger">Se déconnecter</a>
      </nav>

      <!-- Zone centrale -->
      <main class="col-md-9 col-lg-10">
        <?php
        
          //Sections Offres
          if ($section === 'offers') {
              $controller = new AdvertisementController($pdo);

              // ⚠️ On traite les actions qui ne doivent pas afficher de HTML
              if ($action === 'store') {
                $controller->store();
                exit;
              } 
              
              elseif ($action === 'update') {
                $controller->update((int)$_GET['id']);
                exit;
              } 
              
              elseif ($action === 'delete') {
                $controller->delete((int)$_GET['id']);
                exit;
              }

              // ⚠️ Les actions qui affichent une vue
              if ($action === 'edit') {
                $controller->edit((int)$_GET['id']);
              } 
              
              elseif ($action === 'show') {
                $controller->show((int)$_GET['id']);
              } 
              
              else {
                $controller->index(); // par défaut, on affiche la liste + formulaire
              }
          }

          //Sections Utilisateurs
          elseif ($section === 'users') {
            $controller = new UserController($pdo);

            if ($action === 'store') {
              $controller->store();
              exit;
            } 
            
            elseif ($action === 'update') {
              $controller->update((int)$_GET['id']); // ✅ manquant
              exit;
            } 
            
            elseif ($action === 'edit') {
              $controller->edit((int)$_GET['id']); // ✅ manquant
            } 
            
            elseif ($action === 'show') {
              $controller->show((int)$_GET['id']);
            } 
            
            elseif ($action === 'delete') {
              $controller->delete((int)$_GET['id']);
              exit;
            } 
            
            else {
              $controller->index(); // affiche la liste + formulaire (caché par défaut)
            }
          }
            
          //Sections Entreprises
          elseif ($section === 'companies'){
            $controller = new CompanyController($pdo);

            if ($action === 'store') {
              $controller->store();
              exit;
            } 
            
            elseif ($action === 'update') {
              $controller->update((int)$_GET['id']); // ✅ manquant
              exit;
            } 
            
            elseif ($action === 'edit') {
              $controller->edit((int)$_GET['id']); // ✅ manquant
            } 
            
            elseif ($action === 'show') {
              $controller->show((int)$_GET['id']);
            } 
            
            elseif ($action === 'delete') {
              $controller->delete((int)$_GET['id']);
              exit;
            } 
            
            else {
              $controller->index(); // affiche la liste + formulaire (caché par défaut)
            }
          }

          //Sections Candidature
          elseif ($section === 'jobs'){
            $controller = new JobController($pdo);

            if ($action === 'store') {
              $controller->store();
              exit;
            } 
            
            elseif ($action === 'update') {
              $controller->update((int)$_GET['id']); // ✅ manquant
              exit;
            } 
            
            elseif ($action === 'edit') {
              $controller->edit((int)$_GET['id']); // ✅ manquant
            } 
            
            elseif ($action === 'show') {
              $controller->show((int)$_GET['id']);
            } 
            
            elseif ($action === 'delete') {
              $controller->delete((int)$_GET['id']);
              exit;
            } 
            
            else {
              $controller->index(); // affiche la liste + formulaire (caché par défaut)
            }
          }
          
          else {
            echo "<h2>Bienvenue sur le tableau de bord</h2>";
            echo "<p>Ici, tu pourras gérer les utilisateurs, les offres et les entreprises.</p>";
          }
        ?>
      </main>

    </div>

  </div>

  <script src="public/assets/js/admin.js"></script>
  <!-- Script Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  
</body>
</html>