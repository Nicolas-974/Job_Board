<?php
// On suppose que $pdo, $method, $parts sont définis par index.php

// GET /api/people → liste toutes les personnes
if ($method === "GET" && count($parts) === 1) {
    $stmt = $pdo->query("
        SELECT j.job_id, a.title AS advertisement_title, 
                        p.name AS people_name, p.firstname AS people_firstname, j.date_candidature 
                    FROM job_applications j
                    JOIN advertisements a ON j.ad_id = a.ad_id
                    JOIN people p ON j.people_id = p.people_id
                    ORDER BY j.job_id
    ");
    $people = $stmt->fetchAll();

    echo json_encode([
        "status" => "success",
        "count"  => count($people),
        "data"   => $people
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// GET /api/people/{id} → détail d’une personne
if ($method === "GET" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int)$parts[1];
    $stmt = $pdo->prepare("
        SELECT j.job_id, j.ad_id, j.people_id,
                        a.title AS advertisement_title,
                        p.name AS people_name, p.firstname AS people_firstname,
                        j.date_candidature
                FROM job_applications j
                JOIN advertisements a ON j.ad_id = a.ad_id
                JOIN people p ON j.people_id = p.people_id
                WHERE j.job_id = ?
    ");
    $stmt->execute([$id]);
    $person = $stmt->fetch();

    if ($person) {
        echo json_encode(["status" => "success", "data" => $person], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Personne non trouvée"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    exit;
}

// --------------------
// POST /api/job_applications → créer une candidature
// --------------------
if ($method === "POST" && count($parts) === 1) {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validation minimale
    $errors = [];
    if (empty($data["ad_id"]))     { $errors[] = "ad_id est requis"; }
    if (empty($data["people_id"])) { $errors[] = "people_id est requis"; }

    if ($errors) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Validation échouée",
            "errors" => $errors
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Insertion
    $stmt = $pdo->prepare("
        INSERT INTO job_applications (ad_id, people_id, date_candidature)
        VALUES (?, ?, CURDATE())
    ");
    $stmt->execute([
        (int)$data["ad_id"],
        (int)$data["people_id"]
    ]);

    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "Candidature enregistrée",
        "id" => (int)$pdo->lastInsertId()
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// --------------------
// PUT /api/job_applications/{id} → modifier une candidature
// --------------------
if ($method === "PUT" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int)$parts[1];
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifier si la candidature existe
    $stmt = $pdo->prepare("SELECT job_id FROM job_applications WHERE job_id = ?");
    $stmt->execute([$id]);
    $application = $stmt->fetch();

    if (!$application) {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Candidature non trouvée"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Champs modifiables
    $fields = [];
    $values = [];
    $updatable = ["ad_id", "people_id"];

    foreach ($updatable as $field) {
        if (isset($data[$field])) {
            $fields[] = "$field = ?";
            $values[] = $data[$field];
        }
    }

    if (empty($fields)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Aucun champ à mettre à jour"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    $values[] = $id;
    $sql = "UPDATE job_applications SET " . implode(", ", $fields) . " WHERE job_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);

    echo json_encode(["status" => "success", "message" => "Candidature mise à jour", "id" => $id], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// --------------------
// DELETE /api/job_applications/{id} → supprimer une candidature
// --------------------
if ($method === "DELETE" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int)$parts[1];

    // Vérifier si la candidature existe
    $stmt = $pdo->prepare("SELECT job_id FROM job_applications WHERE job_id = ?");
    $stmt->execute([$id]);
    $application = $stmt->fetch();

    if (!$application) {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Candidature non trouvée"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Suppression
    $stmt = $pdo->prepare("DELETE FROM job_applications WHERE job_id = ?");
    $stmt->execute([$id]);

    echo json_encode(["status" => "success", "message" => "Candidature supprimée", "id" => $id], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// Si aucune route ne correspond
http_response_code(404);
echo json_encode([
    "status" => "error",
    "message" => "Route inconnue dans people",
    "path" => $parts
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

?>