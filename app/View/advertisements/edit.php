<h1>Modifier l’annonce</h1>

<form action="index.php?page=admin&section=offers&action=update&id=<?= $ad['ad_id'] ?>" method="post">
    <label for="title">Titre :</label><br>
    <input type="text" id="title" name="title" value="<?= htmlspecialchars($ad['title']) ?>" required><br><br>

    <label for="location">Lieu :</label><br>
    <input type="text" id="location" name="location" value="<?= htmlspecialchars($ad['location']) ?>" required><br><br>

    <label for="contract_type">Type de contrat :</label><br>
    <select id="contract_type" name="contract_type" required>
        <?php foreach (['CDI', 'CDD', 'Stage', 'Freelance'] as $type): ?>
            <option value="<?= $type ?>" <?= $ad['contract_type'] === $type ? 'selected' : '' ?>>
                <?= $type ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <label for="salary">Salaire :</label><br>
    <input type="number" id="salary" name="salary" value="<?= htmlspecialchars($ad['salary']) ?>" required><br><br>

    <label for="description">Description :</label><br>
    <textarea id="description" name="description" rows="5" cols="40" required><?= htmlspecialchars($ad['description']) ?></textarea><br><br>

    <label for="company_id">Entreprise :</label><br>
    <select id="company_id" name="company_id" required>
        <?php foreach ($companies as $company): ?>
            <option value="<?= $company['company_id'] ?>" <?= $ad['company_id'] == $company['company_id'] ? 'selected' : '' ?>>
                <?= htmlspecialchars($company['name']) ?>
            </option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Enregistrer les modifications</button>
</form>

<p><a href="index.php?page=admin&section=offers">← Retour à la liste</a></p>