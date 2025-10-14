<div class="login-card">
    <h2>Connexion</h2>
    <form action="index.php?page=login" method="POST">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-dark">Se connecter</button>

        <div class="links mt-3">
            <a href="#">Mot de passe oublié ?</a>
            <a href="index.php?page=register">Créer un compte</a>
        </div>
    </form>
</div>