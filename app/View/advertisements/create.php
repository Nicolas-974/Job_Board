<h1>Créer une nouvelle annonce</h1>

<form action="index.php?action=store" method="post">
    <label for="title">Titre :</label><br>
    <input type="text" id="title" name="title" required><br><br>

    <label for="company_id">Entreprise :</label><br>
    <select id="company_id" name="company_id" required>
        <?php foreach ($companies as $company): ?>
            <option value="<?= $company['company_id'] ?>">
                <?= htmlspecialchars($company['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="location">Lieu :</label><br>
    <input type="text" id="location" name="location" required><br><br>

    <label for="contract_type">Type de contrat :</label><br>
    <select id="contract_type" name="contract_type" required>
        <option value="CDI">CDI</option>
        <option value="CDD">CDD</option>
        <option value="Stage">Stage</option>
        <option value="Freelance">Freelance</option>
    </select><br><br>

    <label for="salary">Salaire :</label><br>
    <input type="number" id="salary" name="salary" required><br><br>

    <label for="description">Description :</label><br>
    <textarea id="description" name="description" rows="5" cols="40" required></textarea><br><br>

    <button type="submit">Envoyer</button>
</form>

<p><a href="index.php">← Retour à la liste</a></p>