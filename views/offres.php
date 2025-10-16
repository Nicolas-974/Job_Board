<div class="container py-5">
    <h2 class="mb-4 text-center">Dernières offres publiées</h2>

    <div class="row g-4">
        <?php if (!empty($ads)): ?>
            <?php foreach ($ads as $ad): ?>
                <div class="col-12 col-md-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($ad['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($ad['short_description']) ?>...</p>

                            <!-- Bouton Voir plus -->
                            <button class="btn btn-outline-primary mb-2" type="button" data-bs-toggle="collapse"
                                data-bs-target="#details<?= $ad['ad_id'] ?>" aria-expanded="false">
                                Voir plus
                            </button>

                            <div class="collapse" id="details<?= $ad['ad_id'] ?>">
                                <ul class="list-group list-group-flush mb-2">
                                    <li class="list-group-item"><strong>Description :</strong>
                                        <?= htmlspecialchars($ad['description']) ?></li>
                                    <li class="list-group-item"><strong>Lieu :</strong> <?= htmlspecialchars($ad['location']) ?>
                                    </li>
                                    <li class="list-group-item"><strong>Type de contrat :</strong>
                                        <?= htmlspecialchars($ad['contract_type']) ?></li>
                                    <li class="list-group-item"><strong>Salaire :</strong>
                                        <?= htmlspecialchars($ad['salary']) ?></li>
                                    <li class="list-group-item"><strong>Entreprise :</strong>
                                        <?= htmlspecialchars($ad['company_name']) ?></li>
                                    <li class="list-group-item"><strong>Postée le :</strong>
                                        <?= htmlspecialchars($ad['posted_date']) ?></li>
                                </ul>
                            </div>

                            <!-- Zone de candidature -->
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['admin'] === 'user'): ?>
                                <!-- Postuler direct pour user connecté -->
                                <button class="btn btn-success apply-direct" data-ad-id="<?= $ad['ad_id'] ?>"
                                    data-name="<?= htmlspecialchars($_SESSION['user']['name']) ?>"
                                    data-firstname="<?= htmlspecialchars($_SESSION['user']['firstname']) ?>"
                                    data-email="<?= htmlspecialchars($_SESSION['user']['email']) ?>">
                                    Postuler
                                </button>
                                <div id="message-<?= $ad['ad_id'] ?>" class="mt-2"></div>
                            <?php else: ?>
                                <!-- Formulaire pour visiteurs ou entreprises -->
                                <button class="btn btn-success" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#applyForm<?= $ad['ad_id'] ?>" aria-expanded="false">
                                    Postuler
                                </button>

                                <div class="collapse mt-2" id="applyForm<?= $ad['ad_id'] ?>">
                                    <form method="post" class="apply-form" data-ad-id="<?= $ad['ad_id'] ?>">
                                        <input type="hidden" name="apply_ad_id" value="<?= $ad['ad_id'] ?>">
                                        <div class="mb-2"><input type="text" class="form-control" name="name" placeholder="Nom"
                                                required></div>
                                        <div class="mb-2"><input type="text" class="form-control" name="firstname"
                                                placeholder="Prénom" required></div>
                                        <div class="mb-2"><input type="email" class="form-control" name="email" placeholder="Email"
                                                required></div>
                                        <button type="submit" class="btn btn-primary">Envoyer ma candidature</button>
                                    </form>
                                    <div id="message-<?= $ad['ad_id'] ?>" class="mt-2"></div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col">
                <div class="alert alert-warning">Aucune offre disponible pour le moment.</div>
            </div>
        <?php endif; ?>
    </div>

    <!-- Pagination -->
    <nav aria-label="Pagination" class="mt-4">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=offres&page_num=<?= $page - 1 ?>">Précédent</a></li>
            <?php endif; ?>

            <?php for ($p = 1; $p <= $totalPages; $p++): ?>
                <li class="page-item <?= $p == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=offres&page_num=<?= $p ?>"><?= $p ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?page=offres&page_num=<?= $page + 1 ?>">Suivant</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/js/offres.js"></script>