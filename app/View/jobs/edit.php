<h2 class="mb-4">Modifier la candidature</h2>

<form action="admin.php?section=jobs&action=update&id=<?= $job['job_id'] ?>" method="post" class="row g-3">

  <!-- Sélection du candidat -->
  <div class="col-md-6">
    <label for="people_id" class="form-label">Candidat :</label>
    <select id="people_id" name="people_id" class="form-select" required>
      <?php foreach ($users as $u): ?>
        <option value="<?= $u['people_id'] ?>" <?= $u['people_id'] == $job['people_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($u['firstname'] . ' ' . $u['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Sélection de l’offre -->
  <div class="col-md-6">
    <label for="ad_id" class="form-label">Offre :</label>
    <select id="ad_id" name="ad_id" class="form-select" required>
      <?php foreach ($ads as $a): ?>
        <option value="<?= $a['ad_id'] ?>" <?= $a['ad_id'] == $job['ad_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($a['title']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <!-- Date -->
  <div class="col-md-6">
    <label for="date_candidature" class="form-label">Date de candidature :</label>
    <input type="datetime-local" id="date_candidature" name="date_candidature"
           value="<?= date('Y-m-d\TH:i', strtotime($job['date_candidature'])) ?>"
           class="form-control" required>
  </div>

  <div class="col-12 d-flex justify-content-end">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
  </div>
</form>