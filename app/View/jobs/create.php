<h2 class="mb-4">Nouvelle candidature</h2>

<form action="index.php?page=admin&section=jobs&action=store" method="post" class="row g-3">

  <!-- Sélection de l’utilisateur -->
  <div class="col-md-6">
    <label for="people_id" class="form-label">Candidat :</label>
    <select id="people_id" name="people_id" class="form-select" required>
      <option value="">-- Sélectionner un candidat --</option>
      <?php foreach ($users as $u): ?>
        <option value="<?= $u['people_id'] ?>">
          <?= htmlspecialchars($u['firstname'] . ' ' . $u['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Sélection de l’offre -->
  <div class="col-md-6">
    <label for="ad_id" class="form-label">Offre :</label>
    <select id="ad_id" name="ad_id" class="form-select" required>
      <option value="">-- Sélectionner une offre --</option>
      <?php foreach ($ads as $a): ?>
        <option value="<?= $a['ad_id'] ?>">
          <?= htmlspecialchars($a['title']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Date de candidature -->
  <div class="col-md-6">
    <label for="date_candidature" class="form-label">Date de candidature :</label>
    <input type="datetime-local" id="date_candidature" name="date_candidature" class="form-control" required>
  </div>

  <!-- Bouton -->
  <div class="col-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Créer</button>
  </div>
</form>