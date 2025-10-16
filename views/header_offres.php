<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dernières Offres</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Font Awesome (icônes réseaux sociaux) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <link rel="stylesheet" href="css/style.css">
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
          <li class="nav-item"><a class="nav-link" href="index.php?page=home">Accueil</a></li>
          <li class="nav-item"><a class="nav-link" href="index.php?page=offres">Offres</a></li>
        </ul>

        <div class="d-flex">
          <?php if (isset($_SESSION['user'])): ?>
            <?php if ($_SESSION['user']['admin'] === 'user'): ?>
              <span class="me-3">Connecté en tant que 
                <strong><?= htmlspecialchars($_SESSION['user']['name']) ?></strong>
              </span>
              <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm">Se déconnecter</a>

            <?php elseif ($_SESSION['user']['admin'] === 'company'): ?>
              <span class="me-3">Entreprise : 
                <strong><?= htmlspecialchars($_SESSION['user']['name']) ?></strong>
              </span>
              <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm">Se déconnecter</a>

            <?php elseif ($_SESSION['user']['admin'] === 'admin'): ?>
              <span class="me-3">Connecté en tant qu’<strong>Administrateur</strong></span>
              <a href="index.php?page=logout" class="btn btn-outline-danger btn-sm">Se déconnecter</a>
            <?php endif; ?>
          <?php else: ?>
            <a href="index.php?page=login" class="btn btn-outline-primary me-2">Sign in</a>
            <a href="index.php?page=register" class="btn btn-primary">Register</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <main class="container my-5">