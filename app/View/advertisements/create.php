<h2 class="mb-4">Créer une nouvelle annonce</h2>

<form action="index.php?page=admin&section=offers&action=store" method="post" class="row g-3">

  <!-- Titre -->
  <div class="col-md-6">
    <label for="title" class="form-label">Titre :</label>
    <input type="text" id="title" name="title" class="form-control" required>
  </div>

  <!-- Entreprise -->
  <div class="col-md-6">
    <label for="company_id" class="form-label">Entreprise :</label>
    <select id="company_id" name="company_id" class="form-select" required>
      <option value="">-- Sélectionnez une entreprise --</option>
      <?php foreach ($companies as $company): ?>
        <option value="<?= $company['company_id'] ?>">
          <?= htmlspecialchars($company['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Lieu -->
  <div class="col-md-6">
    <label for="location" class="form-label">Lieu :</label>
    <input type="text" id="location" name="location" class="form-control" required>
  </div>

  <!-- Type de contrat -->
  <div class="col-md-6">
    <label for="contract_type" class="form-label">Type de contrat :</label>
    <select id="contract_type" name="contract_type" class="form-select" required>
      <option value="CDI">CDI</option>
      <option value="CDD">CDD</option>
      <option value="Stage">Stage</option>
      <option value="Freelance">Freelance</option>
    </select>
  </div>

  <!-- Salaire -->
  <div class="col-md-6">
    <label for="salary" class="form-label">Salaire (€) :</label>
    <input type="number" id="salary" name="salary" class="form-control" min="0" step="100" required>
  </div>

  <!-- Description -->
  <div class="col-12">
    <label for="description" class="form-label">Description :</label>
    <textarea id="description" name="description" rows="5" class="form-control" required></textarea>
  </div>

  <!-- Boutons -->
  <div class="col-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Envoyer</button>
  </div>
</form>