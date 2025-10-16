<h2 class="mb-4">Détails de l'utilisateur</h2>

<div class="card">
  <div class="card-body">
    <h5 class="card-title"><?= htmlspecialchars($user['name']) ?> <?= htmlspecialchars($user['firstname']) ?></h5>
    <p class="card-text"><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
    <p class="card-text"><strong>Téléphone :</strong> <?= htmlspecialchars($user['phone']) ?></p>
    <p class="card-text"><strong>Adresse :</strong> <?= htmlspecialchars($user['address']) ?></p>
    <p class="card-text"><strong>Rôle :</strong> <?= $user['admin'] == 1 ? 'Admin' : 'Utilisateurs' ?></p>
  </div>
</div>

<p class="mt-3">
  <a href="index.php?page=admin&section=users" class="btn btn-secondary">← Retour à la liste</a>
</p>