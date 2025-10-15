<?php
session_start();
require_once '../config/config.php'; // inclut $pdo

// Pagination
$perPage = 6;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $perPage;

// Récupérer le nombre total d'annonces
$totalStmt = $pdo->query("SELECT COUNT(*) FROM advertisements");
$totalAds = $totalStmt->fetchColumn();
$totalPages = ceil($totalAds / $perPage);

// Récupérer les annonces de la page actuelle
$stmt = $pdo->prepare("
    SELECT a.ad_id, a.title, a.short_description, a.description,
           a.location, a.contract_type, a.salary, c.name AS company_name
    FROM advertisements a
    JOIN companies c ON a.company_id = c.company_id
    ORDER BY a.ad_id DESC
    LIMIT :limit OFFSET :offset
");
$stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$ads = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Traitement formulaire candidature
$applyMessage = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['apply_ad_id'])) {
    $ad_id = (int)$_POST['apply_ad_id'];
    $name = trim($_POST['name']);
    $firstname = trim($_POST['firstname']);
    $email = trim($_POST['email']);

    if ($name && $firstname && $email) {
        // Vérifier si l'utilisateur existe
        $stmt = $pdo->prepare("SELECT people_id FROM people WHERE email = ?");
        $stmt->execute([$email]);
        $person = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($person) {
            $people_id = $person['people_id'];
        } else {
            // Créer un nouvel utilisateur
            $stmt = $pdo->prepare("INSERT INTO people (name, firstname, email, admin) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $firstname, $email, "temp"]);
            $people_id = $pdo->lastInsertId();
        }

        // Créer la candidature
        $stmt = $pdo->prepare("INSERT INTO job_applications (ad_id, people_id, date_candidature) VALUES (?, ?, CURDATE())");
        $stmt->execute([$ad_id, $people_id]);

        $applyMessage = "Votre candidature a été enregistrée !";
    } else {
        $applyMessage = "Tous les champs sont obligatoires.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dernières Offres</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container py-5">
    <h2 class="mb-4 text-center">Dernières offres publiées</h2>

    <div class="row g-4">
        <?php foreach ($ads as $ad): ?>
            <div class="col-12 col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($ad['title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($ad['short_description']) ?>...</p>

                        <!-- Voir plus (collapse) -->
                        <button class="btn btn-outline-primary mb-2" type="button" data-bs-toggle="collapse"
                            data-bs-target="#details<?= $ad['ad_id'] ?>" aria-expanded="false" aria-controls="details<?= $ad['ad_id'] ?>">
                            Voir plus
                        </button>

                        <div class="collapse" id="details<?= $ad['ad_id'] ?>">
                            <ul class="list-group list-group-flush mb-2">
                                <li class="list-group-item"><strong>Description :</strong> <?= htmlspecialchars($ad['description']) ?></li>
                                <li class="list-group-item"><strong>Lieu :</strong> <?= htmlspecialchars($ad['location']) ?></li>
                                <li class="list-group-item"><strong>Type de contrat :</strong> <?= htmlspecialchars($ad['contract_type']) ?></li>
                                <li class="list-group-item"><strong>Salaire :</strong> <?= htmlspecialchars($ad['salary']) ?></li>
                                <li class="list-group-item"><strong>Entreprise :</strong> <?= htmlspecialchars($ad['company_name']) ?></li>
                            </ul>
                        </div>

                        <!-- Formulaire Postuler -->
                        <button class="btn btn-success" type="button" data-bs-toggle="collapse"
                            data-bs-target="#applyForm<?= $ad['ad_id'] ?>" aria-expanded="false" aria-controls="applyForm<?= $ad['ad_id'] ?>">
                            Postuler
                        </button>

                        <div class="collapse mt-2" id="applyForm<?= $ad['ad_id'] ?>">
                            <?php if ($applyMessage): ?>
                                <div class="alert alert-info"><?= $applyMessage ?></div>
                            <?php endif; ?>
                            <form method="post">
                                <input type="hidden" name="apply_ad_id" value="<?= $ad['ad_id'] ?>">
                                <div class="mb-2"><input type="text" class="form-control" name="name" placeholder="Nom" required></div>
                                <div class="mb-2"><input type="text" class="form-control" name="firstname" placeholder="Prénom" required></div>
                                <div class="mb-2"><input type="email" class="form-control" name="email" placeholder="Email" required></div>
                                <button type="submit" class="btn btn-primary">Envoyer ma candidature</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Pagination -->
    <nav aria-label="Pagination" class="mt-4">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $page-1 ?>">Précédent</a></li>
            <?php endif; ?>

            <?php for ($p=1; $p<=$totalPages; $p++): ?>
                <li class="page-item <?= $p == $page ? 'active' : '' ?>"><a class="page-link" href="?page=<?= $p ?>"><?= $p ?></a></li>
            <?php endfor; ?>

            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link" href="?page=<?= $page+1 ?>">Suivant</a></li>
            <?php endif; ?>
        </ul>
    </nav>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
