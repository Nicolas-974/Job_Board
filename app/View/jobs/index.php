<h1 id="jobsTitle" class="mb-4">Liste des candidatures</h1>

<!-- Bouton qui bascule l'affichage -->
<p>
  <button class="btn btn-success mb-3" id="btnToggleJobsCreate">➕ Créer une nouvelle candidature</button>
</p>

<!-- Formulaire de création (caché par défaut) -->
<div id="formJobCreate" style="display: none;">
  <?php include __DIR__ . '/create.php'; ?>
</div>

<!-- Liste des offres (visible par défaut) -->
<div id="jobsList">
  <table class="table table-bordered table-striped table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Emploi</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Date de Candidature</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($jobs as $job): ?>
        <tr>
          <td><?= htmlspecialchars($job['job_id']) ?></td>
          <td><?= htmlspecialchars($job['advertisement_title']) ?></td>
          <td><?= htmlspecialchars($job['people_name']) ?></td>
          <td><?= htmlspecialchars($job['people_firstname']) ?></td>
          <td><?= htmlspecialchars($job['date_candidature']) ?></td>
          <td>
            <a href="index.php?page=admin&section=jobs&action=show&id=<?= $job['job_id'] ?>" class="btn btn-sm btn-info">Voir</a>
            <a href="index.php?page=admin&section=jobs&action=edit&id=<?= $job['job_id'] ?>"
              class="btn btn-sm btn-warning">Modifier</a>
            <a href="index.php?page=admin&section=jobs&action=delete&id=<?= $job['job_id'] ?>" class="btn btn-sm btn-danger"
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
          <a class="page-link" href="index.php?page=admin&section=jobs&page_num=<?= $i ?>">
            <?= $i ?>
          </a>
        </li>
      <?php endfor; ?>
    </ul>
  </nav>
</div>