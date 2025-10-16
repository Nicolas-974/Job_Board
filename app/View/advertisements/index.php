<h1 id="offersTitle" class="mb-4">Liste des annonces</h1>

<!-- Bouton qui bascule l'affichage -->
<p>
  <button class="btn btn-success mb-3" id="btnToggleCreate">➕ Créer une nouvelle annonce</button>
</p>

<!-- Formulaire de création (caché par défaut) -->
<div id="formCreate" style="display: none;">
  <?php include __DIR__ . '/create.php'; ?>
</div>

<!-- Liste des offres (visible par défaut) -->
<div id="offersList">
  <table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Entreprise</th>
        <th>Lieu</th>
        <th>Contrat</th>
        <th>Salaire</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($ads as $ad): ?>
        <tr>
          <td><?= htmlspecialchars($ad['ad_id']) ?></td>
          <td><?= htmlspecialchars($ad['title']) ?></td>
          <td><?= htmlspecialchars($ad['company_name']) ?></td>
          <td><?= htmlspecialchars($ad['location']) ?></td>
          <td><?= htmlspecialchars($ad['contract_type']) ?></td>
          <td><?= htmlspecialchars($ad['salary']) ?> €</td>
          <td>
            <a href="index.php?page=admin&section=offers&action=show&id=<?= $ad['ad_id'] ?>" class="btn btn-sm btn-info">Voir</a>
            <a href="index.php?page=admin&section=offers&action=edit&id=<?= $ad['ad_id'] ?>"
              class="btn btn-sm btn-warning">Modifier</a>
            <a href="index.php?page=admin&section=offers&action=delete&id=<?= $ad['ad_id'] ?>" class="btn btn-sm btn-danger"
              onclick="return confirm('Voulez-vous vraiment supprimer cette annonce ?');">
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
          <a class="page-link" href="index.php?page=admin&section=offers&page_num=<?= $i ?>">
            <?= $i ?>
          </a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>

</div>