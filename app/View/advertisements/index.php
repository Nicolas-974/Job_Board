<h1>Liste des annonces</h1>

<p><a href="index.php?action=create">➕ Créer une nouvelle annonce</a></p>

<table border="1" cellpadding="8" cellspacing="0">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Entreprise</th>
            <th>Lieu</th>
            <th>Contrat</th>
            <th>Salaire</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ads as $ad): ?>
            <tr>
                <td><?= htmlspecialchars($ad['ad_id']) ?></td>
                <td><?= htmlspecialchars($ad['title']) ?></td>
                <td><?= htmlspecialchars($ad['company_name']) ?></td>
                <td><?= htmlspecialchars($ad['location']) ?></td>
                <td><?= htmlspecialchars($ad['contract_type']) ?></td>
                <td><?= htmlspecialchars($ad['salary']) ?></td>
                <td><a href="index.php?action=show&id=<?= $ad['ad_id'] ?>">Voir détail</a></td>
                <td><a href="index.php?action=edit&id=<?= $ad['ad_id'] ?>">Modifier</a></td>
                <td><a href="index.php?action=delete&id=<?= $ad['ad_id'] ?>" onclick="return confirm('Voulez-vous vraiment supprimer cette annonce ?');">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

