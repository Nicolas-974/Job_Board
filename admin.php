<?php
// Connexion PDO
require_once __DIR__ . '/config/config.php';

// Import du contrôleur des annonces
require_once __DIR__ . '/app/Controller/AdvertisementController.php';
require_once __DIR__ . '/app/Controller/UserController.php';


// On récupère la section demandée dans l’URL (ex: admin.php?section=offers)
$section = $_GET['section'] ?? null;
$action = $_GET['action'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Page Admin - Job Board</title>
  <!-- Lien vers Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    header {
      background-color: #343a40;
      color: white;
      padding: 15px;
      text-align: center;
    }
    .sidebar {
      background-color: #f8f9fa;
      min-height: calc(100vh - 60px); /* hauteur totale - header */
      padding: 20px;
      border-right: 1px solid #ddd;
    }
    .sidebar h5 {
      margin-bottom: 20px;
    }
    .sidebar a {
      display: block;
      padding: 10px;
      margin-bottom: 10px;
      color: #333;
      text-decoration: none;
      border-radius: 5px;
    }
    .sidebar a:hover {
      background-color: #e9ecef;
    }
    main {
      padding: 20px;
    }
  </style>
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
      </nav>

      <!-- Zone centrale -->
      <main class="col-md-9 col-lg-10">
        <?php
        
            if ($section === 'offers') {
                $controller = new AdvertisementController($pdo);

                // ⚠️ On traite les actions qui ne doivent pas afficher de HTML
                if ($action === 'store') {
                    $controller->store();
                    exit;
                } elseif ($action === 'update') {
                    $controller->update((int)$_GET['id']);
                    exit;
                } elseif ($action === 'delete') {
                    $controller->delete((int)$_GET['id']);
                    exit;
                }

                // ⚠️ Les actions qui affichent une vue
                if ($action === 'edit') {
                    $controller->edit((int)$_GET['id']);
                } elseif ($action === 'show') {
                    $controller->show((int)$_GET['id']);
                } else {
                    $controller->index(); // par défaut, on affiche la liste + formulaire
                }
            }

            
            elseif ($section === 'users') {
              $controller = new UserController($pdo);

              if ($action === 'store') {
                  $controller->store();
                  exit;
              } elseif ($action === 'update') {
                  $controller->update((int)$_GET['id']); // ✅ manquant
                  exit;
              } elseif ($action === 'edit') {
                  $controller->edit((int)$_GET['id']); // ✅ manquant
              } elseif ($action === 'show') {
                  $controller->show((int)$_GET['id']);
              } elseif ($action === 'delete') {
                  $controller->delete((int)$_GET['id']);
                  exit;
              } else {
                  $controller->index(); // affiche la liste + formulaire (caché par défaut)
              }
            }
            
            elseif ($section === 'companies') {
                echo "<h2>Liste des entreprises (à venir)</h2>";
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