<h2 class="mb-4">Ajouter une nouvelle entreprise</h2>

<form action="admin.php?section=companies&action=store" method="post" class="row g-3">

  <!-- Nom -->
  <div class="col-md-6">
    <label for="name" class="form-label">Nom :</label>
    <input type="text" id="name" name="name" class="form-control" required>
  </div>

  <!-- Prénom -->
  <div class="col-md-6">
    <label for="Secteur" class="form-label">Secteur :</label>
    <input type="text" id="sector" name="sector" class="form-control" required>
  </div>

  <!-- Adresse -->
  <div class="col-md-6">
    <label for="location" class="form-label">Ville :</label>
    <input type="text" id="location" name="location" class="form-control">
  </div>

    <!-- Email -->
  <div class="col-md-6">
    <label for="email" class="form-label">Email :</label>
    <input type="email" id="email" name="email" class="form-control" required>
  </div>


  <!-- Téléphone -->
  <div class="col-md-6">
    <label for="phone" class="form-label">Téléphone :</label>
    <input type="text" id="phone" name="phone" class="form-control">
  </div>

  <!-- Bouton -->
  <div class="col-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Créer</button>
  </div>
</form>