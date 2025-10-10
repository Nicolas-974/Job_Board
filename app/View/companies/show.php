<h2 class="mb-4">Détails de l'entreprise</h2>

<div class="card">
  <div class="card-body">
    <h5 class="card-title"><?= htmlspecialchars($company['name']) ?></h5>
    <p class="card-text"><strong>Secteur :</strong> <?= htmlspecialchars($company['sector']) ?></p>
    <p class="card-text"><strong>Ville :</strong> <?= htmlspecialchars($company['location']) ?></p>
    <p class="card-text"><strong>Email :</strong> <?= htmlspecialchars($company['email']) ?></p>
    <p class="card-text"><strong>Téléphone :</strong> <?= htmlspecialchars($company['phone']) ?></p>
  </div>
</div>

<p class="mt-3">
  <a href="admin.php?section=companies" class="btn btn-secondary">← Retour à la liste</a>
</p>