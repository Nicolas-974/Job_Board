<div class="login-card">
    <h2>Connexion</h2>
    <form>
        <div class="mb-3">
            <label for="email" class="form-label"></label><br>
            <select id="sector" name="sector" required>
            <option value="">-- Sélectionner --</option>
            <option value="tech">Candidat</option>
            <option value="santé">Entreprise</option>
                <!-- Ajoute d'autres secteurs ici -->
            </select>      
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" class="form-control" id="password" required>
        </div>

      <button type="submit" class="btn btn-dark">Se connecter</button>

      <div class="links mt-3">
        <a href="#">Mot de passe oublié ?</a>
        <a href="index.php?page=register">Créer un compte</a>
      </div>
    </form>
</div>