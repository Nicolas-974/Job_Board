<h2 class="mb-4">Modifier l'entreprise</h2>

<form action="index.php?page=admin&section=companies&action=update&id=<?= $company['company_id'] ?>" method="post" class="row g-3">

  <div class="col-md-6">
    <label for="name" class="form-label">Nom :</label>
    <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($company['name']) ?>" required>
  </div>

  <div class="col-md-6">
    <label for="firstname" class="form-label">Secteur :</label>
    <input type="text" id="sector" name="sector" class="form-control" value="<?= htmlspecialchars($company['sector']) ?>" required>
  </div>

  <div class="col-md-6">
    <label for="location" class="form-label">Ville :</label>
    <input type="text" id="location" name="location" class="form-control" value="<?= htmlspecialchars($company['location']) ?>">
  </div>

  <div class="col-md-6">
    <label for="email" class="form-label">Email :</label>
    <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($company['email']) ?>" required>
  </div>


  <div class="col-md-6">
    <label for="phone" class="form-label">Téléphone :</label>
    <input type="text" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($company['phone']) ?>">
  </div>

  <div class="col-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
  </div>
</form>