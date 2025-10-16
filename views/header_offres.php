<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Dernières Offres</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../public/css/style.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
      <a class="navbar-brand fw-bold" href="index.php?page=home">Logo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link" href="index.php?page=offres">Offres</a></li>
          <?php if (isset($_SESSION['user'])): ?> 
            <?php if ($_SESSION['user']['admin'] === 'user'): ?>
              <li class="nav-item"><a class="nav-link" href="index.php?page=profil_user">Profil</a></li>
            <?php elseif ($_SESSION['user']['admin'] === 'company'): ?>
              <li class="nav-item"><a class="nav-link" href="index.php?page=profil_companies">Profil</a></li>
            <?php endif; ?>
          <?php endif; ?>
        </ul>

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
  </nav>
  </header>