<h1>Détail de la candidature</h1>

<p><strong>ID :</strong> <?= htmlspecialchars($job['job_id']) ?></p>
<p><strong>Emploi :</strong> <?= htmlspecialchars($job['advertisement_title']) ?></p>
<p><strong>Nom - Prénom :</strong> <?= htmlspecialchars($job['people_name']) ?> <?= htmlspecialchars($job['people_firstname']) ?></p>
<p><strong>Date de Candidature :</strong> <?= htmlspecialchars($job['date_candidature']) ?></p>

<p><a href="index.php?page=admin&section=jobs">← Retour à la liste</a></p>