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
  <meta charset="utf-8">
  <title>Mon profil — <?= $firstname ?> <?= $name ?></title>
  <meta name="viewport" content="width=device-width,initial-scale=1">

  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="../public/css/profil_user.css" rel="stylesheet">
</head>