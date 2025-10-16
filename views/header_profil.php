<?php
// Profil centré, pas de colonne blanche
$people_id = intval($_SESSION['user']['people_id'] ?? ($_SESSION['user']['id'] ?? 0));
$firstname = htmlspecialchars($_SESSION['user']['firstname'] ?? '');
$name = htmlspecialchars($_SESSION['user']['name'] ?? '');
$email = htmlspecialchars($_SESSION['user']['email'] ?? '');
$phone = htmlspecialchars($_SESSION['user']['phone'] ?? '');
$address = htmlspecialchars($_SESSION['user']['address'] ?? '');
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Accueil - Plateforme Emplois</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

  <!-- Font Awesome (icônes réseaux sociaux) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

  <link rel="stylesheet" href="css/style.css">

  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../public/css/profil_user.css" rel="stylesheet">
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
          <?php if (isset($_SESSION['user'])): ?> 
            <?php if ($_SESSION['user']['admin'] === 'user'): ?>
              <li class="nav-item"><a class="nav-link" href="index.php?page=profil_user">Profil</a></li>
            <?php elseif ($_SESSION['user']['admin'] === 'company'): ?>
              <li class="nav-item"><a class="nav-link" href="index.php?page=profil_companies">Profil</a></li>
            <?php endif; ?>
          <?php endif; ?>
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