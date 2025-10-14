<body>
    <div class="container py-4">
        <!-- Header -->
        <header class="d-flex justify-content-between align-items-center mb-4">
            <div class="logo">
                <h2>Bienvenue <?= htmlspecialchars($_SESSION['user']['name']) ?>
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
            <!-- Card 1 -->
            <div class="col">
                <div class="card job-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Job Card</h5>
                        <p class="card-text">Body text for whatever you'd like to say. Add main takeaway points, quotes,
                            anecdotes, or even a very short story.</p>
                        <a href="#" class="btn btn-outline-dark">Check</a>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col">
                <div class="card job-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Job Card</h5>
                        <p class="card-text">Body text for whatever you'd like to say. Add main takeaway points, quotes,
                            anecdotes, or even a very short story.</p>
                        <a href="#" class="btn btn-outline-dark">Check</a>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col">
                <div class="card job-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Job Card</h5>
                        <p class="card-text">Body text for whatever you'd like to say. Add main takeaway points, quotes,
                            anecdotes, or even a very short story.</p>
                        <a href="#" class="btn btn-outline-dark">Check</a>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col">
                <div class="card job-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Job Card</h5>
                        <p class="card-text">Body text for whatever you'd like to say. Add main takeaway points, quotes,
                            anecdotes, or even a very short story.</p>
                        <a href="#" class="btn btn-outline-dark">Check</a>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col">
                <div class="card job-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Job Card</h5>
                        <p class="card-text">Body text for whatever you'd like to say. Add main takeaway points, quotes,
                            anecdotes, or even a very short story.</p>
                        <a href="#" class="btn btn-outline-dark">Check</a>
                    </div>
                </div>
            </div>
            <!-- Card 6 -->
            <div class="col">
                <div class="card job-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">Job Card</h5>
                        <p class="card-text">Body text for whatever you'd like to say. Add main takeaway points, quotes,
                            anecdotes, or even a very short story.</p>
                        <a href="#" class="btn btn-outline-dark">Check</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>