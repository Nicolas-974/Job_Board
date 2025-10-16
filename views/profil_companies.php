<body>
    <div class="container py-4">
        <!-- Header -->
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div class="logo">
                <h2>Bienvenue <?= htmlspecialchars($company['name']) ?></h2>
                </h2>
            </div>

            <?php if (isset($_SESSION['user'])): ?>
                <a href="index.php?page=logout" class="btn btn-outline-danger">Se déconnecter</a>
            <?php endif; ?>
            <!-- <div class="logout-icon">⤴️</div> -->
        </header>

        <!-- Section Title -->
        <h2 class="fw-bold mb-4">Offres d'Emplois</h2>

        <!-- Job Cards -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (!empty($ads)): ?>
                <?php foreach ($ads as $ad): ?>
                    <div class="col">
                        <div class="card job-card h-100">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($ad['title']) ?></h5>

                                <?php if (!empty($ad['short_description'])): ?>
                                    <p class="card-text"><?= htmlspecialchars($ad['short_description']) ?></p>
                                <?php endif; ?>

                                <ul class="list-unstyled small mb-3">
                                    <li><strong>Localisation:</strong>
                                        <?= htmlspecialchars($ad['location'] ?? 'Non renseignée') ?></li>
                                    <li><strong>Contrat:</strong>
                                        <?= htmlspecialchars($ad['contract_type'] ?? 'Non renseigné') ?></li>
                                    <li><strong>Salaire:</strong>
                                        <?= isset($ad['salary']) ? htmlspecialchars((string) $ad['salary']) . ' €' : 'Non renseigné' ?>
                                    </li>
                                    <li><strong>Publiée le:</strong> <?= htmlspecialchars($ad['posted_date'] ?? '') ?></li>
                                </ul>

                                <a href="index.php?page=ad_show&id=<?= (int) $ad['ad_id'] ?>" class="btn btn-outline-dark">
                                    Voir l’offre
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col">
                    <div class="alert alert-info">Aucune offre publiée pour le moment.</div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>