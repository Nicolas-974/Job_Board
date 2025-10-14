<div class="container">
    <!-- Header -->
    <div class="profile-header">
        <h1>Profil</h1>
        <h2>Bienvenue <?= htmlspecialchars($_SESSION['user']['firstname']) ?>
            <?= htmlspecialchars($_SESSION['user']['name']) ?>
        </h2>

        <br>
    </div>

    <!-- Formulaire -->
    <div class="col-md-4">
        <div class="form-section">
            <form class="needs-validation" novalidate>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="sexe" class="form-label">Sexe</label>
                        <select class="form-select" id="sexe" required>
                            <option selected disabled>Choisir</option>
                            <option value="homme">Homme</option>
                            <option value="femme">Femme</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom"
                                value="<?= htmlspecialchars($_SESSION['user']['name']) ?>" readonly>
                            <div class="invalid-feedback">Veuillez entrer votre nom.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control" id="prenom"
                                value="<?= htmlspecialchars($_SESSION['user']['firstname']) ?>" readonly>
                            <div class="invalid-feedback">Veuillez entrer votre prénom.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email"
                                value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" readonly>

                            <div class="invalid-feedback">Veuillez entrer un email valide.</div>
                        </div>
                        <div class="col-md-6">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="telephone" required>
                            <div class="invalid-feedback">Veuillez entrer un numéro valide.</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" required>
                        </div>
                        <div class="col-md-6">
                            <label for="ville" class="form-label">Code Postal / Ville</label>
                            <input type="text" class="form-control" id="ville" required>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <label for="niveau" class="form-label">Niveau</label>
                        <input type="text" class="form-control" id="niveau" required>
                    </div>
                    <div class="col-md-4">
                        <label for="cv" class="form-label">CV</label>
                        <input type="file" class="form-control" id="cv" accept=".pdf,.jpg,.png"
                            onchange="previewCV(event)" required>
                        <div id="cv-preview" class="mt-2"></div>
                    </div>
                </div>

                <button type="submit" class="btn btn-dark mt-3">Enregistrer</button>
            </form>
        </div>
    </div>