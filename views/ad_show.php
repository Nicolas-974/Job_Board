<div class="container py-4">
    <?php if ($ad): ?>
        <h2 class="mb-3"><?= htmlspecialchars($ad['title']) ?></h2>
        <p><strong>Entreprise :</strong> <?= htmlspecialchars($ad['company_name']) ?></p>
        <p><strong>Localisation :</strong> <?= htmlspecialchars($ad['location']) ?></p>
        <p><strong>Type de contrat :</strong> <?= htmlspecialchars($ad['contract_type']) ?></p>
        <p><strong>Salaire :</strong> <?= $ad['salary'] ? htmlspecialchars((string) $ad['salary']) . ' €' : 'Non renseigné' ?>
        </p>
        <p><strong>Description :</strong></p>
        <p><?= nl2br(htmlspecialchars($ad['description'])) ?></p>

        <a href="index.php?page=profil_companies" class="btn btn-secondary">Retour</a>
    <?php else: ?>
        <div class="alert alert-danger">Annonce introuvable.</div>
    <?php endif; ?>
</div>