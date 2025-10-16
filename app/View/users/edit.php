<h2 class="mb-4">Modifier l'utilisateur</h2>

<form action="index.php?page=admin&section=users&action=update&id=<?= $user['people_id'] ?>" method="post" class="row g-3">

  <div class="col-md-6">
    <label for="name" class="form-label">Nom :</label>
    <input type="text" id="name" name="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
  </div>

  <div class="col-md-6">
    <label for="firstname" class="form-label">Prénom :</label>
    <input type="text" id="firstname" name="firstname" class="form-control" value="<?= htmlspecialchars($user['firstname']) ?>" required>
  </div>

  <div class="col-md-6">
    <label for="phone" class="form-label">Téléphone :</label>
    <input type="text" id="phone" name="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>">
  </div>

  <div class="col-md-6">
    <label for="address" class="form-label">Adresse :</label>
    <input type="text" id="address" name="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>">
  </div>

  <div class="col-md-6">
    <label for="email" class="form-label">Email :</label>
    <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
  </div>

  <div class="col-md-6">
    <label for="password" class="form-label">Mot de passe :</label>
    <input type="password" id="password" name="password" class="form-control" value="<?= htmlspecialchars($user['password']) ?>" required>
  </div>

  <div class="col-md-6">
    <label for="admin" class="form-label">Rôle :</label>
    <select id="admin" name="admin" class="form-select">
      <option value="user" <?= $user['admin'] == "user" ? 'selected' : '' ?>>Utilisateur</option>
      <option value="company" <?= $user['admin'] == "company" ? 'selected' : '' ?>>Companie</option>
      <option value="admin" <?= $user['admin'] == "admin" ? 'selected' : '' ?>>Administrateur</option>
    </select>
  </div>

  <div class="col-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
  </div>
</form>