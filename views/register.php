<div class="auth-card">
    <h3 class="mb-4 fw-bold">Créer un compte</h3>

    <button class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#modalInscriptionCandidat">
        Candidat
    </button>

    <button class="btn btn-secondary w-100 mb-4" data-bs-toggle="modal" data-bs-target="#modalInscriptionEntreprise">
        Entreprise
    </button>
</div>

<!-- Modal Candidat -->
<div class="modal fade" id="modalInscriptionCandidat" tabindex="-1" aria-labelledby="modalCandidatLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content auth-card p-4">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>

            <h4 class="mb-4 fw-bold">Créer un compte candidat</h4>

            <!-- Formulaire candidat -->
            <form action="index.php?page=register" method="POST">
                <div class="d-flex input-group-half">
                    <input type="text" name="name" placeholder="Nom" class="form-control-custom" required>
                    <input type="text" name="firstname" placeholder="Prénom" class="form-control-custom" required>
                </div>

                <input type="email" name="email" placeholder="Email" class="form-control-custom" required>
                <input type="text" name="phone" placeholder="Téléphone" class="form-control-custom">
                <input type="text" name="address" placeholder="Adresse" class="form-control-custom">

                <input type="password" name="password" placeholder="Mot de passe" class="form-control-custom" required>
                <input type="password" name="confirmation" placeholder="Confirmation" class="form-control-custom"
                    required>

                <!-- Champ caché pour préciser que c’est un candidat -->
                <input type="hidden" name="type" value="user">

                <button type="submit" class="btn-auth-submit mt-3">Créer mon compte</button>
            </form>

            <div class="mt-3">
                <a href="index.php?page=login" class="auth-link">Déjà un compte ? Se connecter</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal Entreprise -->
<div class="modal fade" id="modalInscriptionEntreprise" tabindex="-1" aria-labelledby="modalEntrepriseLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content auth-card p-4">
            <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>

            <h4 class="mb-4 fw-bold">Créer un compte entreprise</h4>

            <!-- Formulaire entreprise -->
            <form action="index.php?page=register" method="POST" enctype="multipart/form-data">

                <div class="d-flex input-group-half">
                    <input type="text" name="name" placeholder="Nom" class="form-control-custom" required>
                    <input type="text" name="firstname" placeholder="Prénom" class="form-control-custom" required>
                </div>

                <input type="text" name="company_name" placeholder="Nom de l'entreprise" class="form-control-custom" required>
                <input type="email" name="email" placeholder="Email" class="form-control-custom" required>
                <input type="text" name="phone" placeholder="Téléphone" class="form-control-custom">
                <input type="text" name="location" placeholder="Ville" class="form-control-custom">

                <select name="sector" class="form-select-custom" required>
                    <option value="" selected disabled>Secteur d'activité</option>
                    <option value="Informatique">Informatique</option>
                    <option value="Industrie">Industrie</option>
                    <option value="Finance">Finance</option>
                    <option value="Commerce">Commerce</option>
                    <option value="Services">Services</option>
                    <option value="Sante">Santé</option>
                    <option value="BTP">BTP</option>
                    <option value="Transport">Transport</option>
                    <option value="Restauration">Restauration</option>
                    <option value="Education">Éducation</option>
                    <option value="Administration">Administration</option>
                    <option value="Art">Art</option>
                    <option value="Agriculture">Agriculture</option>
                </select>

                <input type="password" name="password" placeholder="Mot de passe" class="form-control-custom" required>
                <input type="password" name="confirmation" placeholder="Confirmation" class="form-control-custom"
                    required>

                <!-- Champ caché pour préciser que c’est une entreprise -->
                <input type="hidden" name="type" value="company">

                <button type="submit" class="btn-auth-submit mt-3">Créer mon compte</button>
            </form>

            <div class="mt-3">
                <a href="index.php?page=login" class="auth-link">Déjà un compte ? Se connecter</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>