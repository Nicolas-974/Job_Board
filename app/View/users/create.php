<h2 class="mb-4">Créer un nouvel utilisateur</h2>

<form action="admin.php?section=users&action=store" method="post" class="row g-3">

  <!-- Nom -->
  <div class="col-md-6">
    <label for="name" class="form-label">Nom :</label>
    <input type="text" id="name" name="name" class="form-control" required>
  </div>

  <!-- Prénom -->
  <div class="col-md-6">
    <label for="firstname" class="form-label">Prénom :</label>
    <input type="text" id="firstname" name="firstname" class="form-control" required>
  </div>

  <!-- Téléphone -->
  <div class="col-md-6">
    <label for="phone" class="form-label">Téléphone :</label>
    <input type="text" id="phone" name="phone" class="form-control">
  </div>

  <!-- Adresse -->
  <div class="col-md-6">
    <label for="address" class="form-label">Adresse :</label>
    <input type="text" id="address" name="address" class="form-control">
  </div>

  <!-- Email -->
  <div class="col-md-6">
    <label for="email" class="form-label">Email :</label>
    <input type="email" id="email" name="email" class="form-control" required>
  </div>

  <!-- Mot de passe -->
  <div class="col-md-6">
    <label for="password" class="form-label">Mot de passe :</label>
    <input type="password" id="password" name="password" class="form-control" required>
  </div>

  <!-- Admin -->
  <div class="col-md-6">
    <label for="admin" class="form-label">Rôle :</label>
    <select id="admin" name="admin" class="form-select">
      <option value="0">Utilisateur</option>
      <option value="1">Administrateur</option>
    </select>
  </div>

  <!-- Bouton -->
  <div class="col-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Créer</button>
  </div>
</form>