<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dernières Offres</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header class="bg-light border-bottom mb-4">
    <div class="container d-flex justify-content-between align-items-center py-3">
      <h1 class="h4 mb-0">Job Board</h1>

      <div>
        <?php if (isset($_SESSION['user'])): ?>
          <?php if ($_SESSION['user']['admin'] === 'user'): ?>
            <span class="me-3">
              Connecté en tant que <strong><?= htmlspecialchars($_SESSION['user']['name']) ?></strong>
            </span>
            <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm">Se déconnecter</a>
          <?php elseif ($_SESSION['user']['admin'] === 'company'): ?>
            <span class="me-3">
              Entreprise : <strong><?= htmlspecialchars($_SESSION['user']['name']) ?></strong>
            </span>
            <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm">Se déconnecter</a>
          <?php elseif ($_SESSION['user']['admin'] === 'admin'): ?>
            <span class="me-3">
              Connecté en tant qu’<strong>Administrateur</strong>
            </span>
            <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm">Se déconnecter</a>
          <?php endif; ?>
        <?php else: ?>
          <a href="index.php?page=login" class="btn btn-outline-primary btn-sm">Se connecter</a>
        <?php endif; ?>
      </div>
    </div>
  </header>