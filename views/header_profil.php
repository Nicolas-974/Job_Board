<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Profil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/profil_user.css"> <!-- ton CSS global -->
</head>

<body>
  <div class="container mt-3 text-end">
    <?php if (isset($_SESSION['user'])): ?>
      <a href="index.php" class="btn btn-outline-danger">Se déconnecter</a>
    <?php endif; ?>
  </div>
