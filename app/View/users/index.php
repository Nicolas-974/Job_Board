<h1 id="usersTitle" class="mb-4">Liste des utilisateurs</h1>

<p>
  <button id="btnToggleUserCreate" class="btn btn-success mb-3">
    ➕ Créer un nouvel utilisateur
  </button>
</p>

<!-- Formulaire de création (caché par défaut) -->
<div id="formUserCreate" style="display: none;">
  <?php include __DIR__ . '/create.php'; ?>
</div>


<!-- Liste des utilisateurs -->
<div id="usersList">
  <table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Téléphone</th>
        <th>Adresse</th>
        <th>Admin</th>
        <th>Mot de passe (⚠️)</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user): ?>
        <tr>
          <td><?= htmlspecialchars($user['people_id']) ?></td>
          <td><?= htmlspecialchars($user['name']) ?></td>
          <td><?= htmlspecialchars($user['firstname']) ?></td>
          <td><?= htmlspecialchars($user['email']) ?></td>
          <td><?= htmlspecialchars($user['phone']) ?></td>
          <td><?= htmlspecialchars($user['address']) ?></td>
          <td><?= $user['admin'] == 1 ? 'Oui' : 'Non' ?></td>
          <td>
            <input type="password" value="<?= htmlspecialchars($user['password']) ?>" readonly
              class="form-control-plaintext border-0 bg-transparent" style="width:150px;">
          </td>
          <td>
            <a href="admin.php?section=users&action=show&id=<?= $user['people_id'] ?>"
              class="btn btn-sm btn-info">Voir</a>
            <a href="admin.php?section=users&action=edit&id=<?= $user['people_id'] ?>"
              class="btn btn-sm btn-warning">Modifier</a>
            <a href="admin.php?section=users&action=delete&id=<?= $user['people_id'] ?>" class="btn btn-sm btn-danger"
              onclick="return confirm('Voulez-vous vraiment supprimer cet utilisateur ?');">
              Supprimer
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <!-- Pagination -->
  <nav>
    <ul class="pagination">
      <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <li class="page-item <?= ($i === $page) ? 'active' : '' ?>">
          <a class="page-link" href="admin.php?section=users&page_num=<?= $i ?>">
            <?= $i ?>
          </a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>

</div>