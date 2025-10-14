<!-- Dernières offres -->
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="mb-4 text-center">Dernières offres publiées</h2>

        <div id="offresCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000"
            data-bs-touch="true">
            <!-- Indicateurs -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#offresCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#offresCarousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>

            <div class="carousel-inner">
                <?php foreach (array_chunk($ads, 3) as $index => $chunk): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row g-4 justify-content-center">
                            <?php foreach ($chunk as $ad): ?>
                                <div class="col-12 col-md-4">
                                    <div class="card shadow-sm h-100">
                                        <div class="card-body">
                                            <h5 class="card-title"><?= htmlspecialchars($ad['title']) ?></h5>
                                            <p class="card-text">
                                                <?= htmlspecialchars(substr($ad['short_description'], 0, 100)) ?>...
                                            </p>
                                            <a href="index.php?page=advertisement&id=<?= $ad['ad_id'] ?>"
                                                class="btn btn-primary">En savoir plus</a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Contrôles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#offresCarousel" data-bs-slide="prev"
                aria-label="Précédent">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#offresCarousel" data-bs-slide="next"
                aria-label="Suivant">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>

<!-- Les Entreprises -->
<section class="py-5">
    <div class="container">
        <h2 class="mb-4 text-center">Les Entreprises</h2>

        <div id="entreprisesCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000"
            data-bs-touch="true">
            <!-- Indicateurs -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#entreprisesCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#entreprisesCarousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
            </div>

            <div class="carousel-inner text-center">

                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <div class="companies-slide">
                        <img src="https://picsum.photos/100?random=11" alt="Entreprise 1">
                        <img src="https://picsum.photos/100?random=12" alt="Entreprise 2">
                        <img src="https://picsum.photos/100?random=13" alt="Entreprise 3">
                        <img src="https://picsum.photos/100?random=14" alt="Entreprise 4">
                        <img src="https://picsum.photos/100?random=15" alt="Entreprise 5">
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="companies-slide">
                        <img src="https://picsum.photos/100?random=16" alt="Entreprise 6">
                        <img src="https://picsum.photos/100?random=17" alt="Entreprise 7">
                        <img src="https://picsum.photos/100?random=18" alt="Entreprise 8">
                        <img src="https://picsum.photos/100?random=19" alt="Entreprise 9">
                        <img src="https://picsum.photos/100?random=20" alt="Entreprise 10">
                    </div>
                </div>

            </div>

            <!-- Contrôles -->
            <button class="carousel-control-prev" type="button" data-bs-target="#entreprisesCarousel"
                data-bs-slide="prev" aria-label="Précédent">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#entreprisesCarousel"
                data-bs-slide="next" aria-label="Suivant">
                <span class="carousel-control-next-icon"></span>
            </button>

        </div>

    </div>

</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>