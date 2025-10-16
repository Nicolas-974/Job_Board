<h1 id="companiesTitle" class="mb-4">Liste des entreprises</h1>

<p>
  <button id="btnToggleCompaniesCreate" class="btn btn-success mb-3">
    ➕ Ajouter une entreprise
  </button>
</p>

<!-- Formulaire de création (caché par défaut) -->
<div id="formCompaniesCreate" style="display: none;">
  <?php include __DIR__ . '/create.php'; ?>
</div>


<!-- Liste des utilisateurs -->
<div id="companiesList">
  <table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Entreprise</th>
        <th>Secteur</th>
        <th>Lieu</th>
        <th>Téléphone</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($companies as $company): ?>
        <tr>
          <td><?= htmlspecialchars($company['company_id']) ?></td>
          <td><?= htmlspecialchars($company['name']) ?></td>
          <td><?= htmlspecialchars($company['sector']) ?></td>
          <td><?= htmlspecialchars($company['location']) ?></td>
          <td><?= htmlspecialchars($company['phone']) ?></td>
          <td><?= htmlspecialchars($company['email']) ?></td>
          <td>
            <a href="admin.php?section=companies&action=show&id=<?= $company['company_id'] ?>"
              class="btn btn-sm btn-info">Voir</a>
            <a href="admin.php?section=companies&action=edit&id=<?= $company['company_id'] ?>"
              class="btn btn-sm btn-warning">Modifier</a>
            <a href="admin.php?section=companies&action=delete&id=<?= $company['company_id'] ?>"
              class="btn btn-sm btn-danger" onclick="return confirm('Voulez-vous vraiment supprimer l\'entreprise ?');">
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
          <a class="page-link" href="admin.php?section=companies&page_num=<?= $i ?>">
            <?= $i ?>
          </a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>
</div>