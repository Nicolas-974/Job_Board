<?php
// On suppose que $pdo, $method, $parts sont déjà définis par index.php

// --------------------
// GET /api/advertisements
// --------------------
if ($method === "GET" && count($parts) === 1) {
    $stmt = $pdo->query("
        SELECT a.ad_id, a.title, a.short_description, a.description, a.location, a.contract_type, a.salary, a.posted_date, a.company_id,
               c.name AS company_name
        FROM advertisements a
        JOIN companies c ON a.company_id = c.company_id
        ORDER BY a.ad_id ASC
    ");
    $ads = $stmt->fetchAll();
    echo json_encode([
        "status" => "success",
        "count" => count($ads),
        "data" => $ads
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// --------------------
// GET /api/advertisements/{id}
// --------------------
if ($method === "GET" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int) $parts[1];
    $stmt = $pdo->prepare("
        SELECT a.ad_id, a.title, a.short_description, a.description, a.location, a.contract_type, a.salary, a.posted_date, a.company_id, 
               c.name AS company_name, c.sector AS company_sector, c.location AS company_location
        FROM advertisements a
        JOIN companies c ON a.company_id = c.company_id
        WHERE a.ad_id = ?
    ");
    $stmt->execute([$id]);
    $ad = $stmt->fetch();

    if ($ad) {
        echo json_encode(["status" => "success", "data" => $ad], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Annonce non trouvée"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    exit;
}

// --------------------
// POST /api/advertisements → créer une annonce
// --------------------
if ($method === "POST" && count($parts) === 1) {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validation minimale
    $errors = [];
    if (empty($data["title"])) {
        $errors[] = "title est requis";
    }
    if (empty($data["company_id"])) {
        $errors[] = "company_id est requis";
    }

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
        INSERT INTO advertisements (title, short_description, description, location, contract_type, salary, posted_date, company_id)
        VALUES (?, ?, ?, ?, ?, ?, CURDATE(), ?)
    ");
    $stmt->execute([
        $data["title"],
        $data["short_description"] ?? null,
        $data["description"] ?? null,
        $data["location"] ?? null,
        $data["contract_type"] ?? null,
        $data["salary"] ?? null,
        (int) $data["company_id"]
    ]);

    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "Annonce créée",
        "id" => (int) $pdo->lastInsertId()
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// --------------------
// PUT /api/advertisements/{id} → modifier une annonce
// --------------------
if ($method === "PUT" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int) $parts[1];
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifier si l'annonce existe
    $stmt = $pdo->prepare("SELECT ad_id FROM advertisements WHERE ad_id = ?");
    $stmt->execute([$id]);
    $ad = $stmt->fetch();

    if (!$ad) {
        http_response_code(404);
        echo json_encode([
            "status" => "error",
            "message" => "Annonce non trouvée"
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Construction dynamique de la requête UPDATE
    $fields = [];
    $values = [];

    $updatable = ["title", "short_description", "description", "location", "contract_type", "salary", "company_id"];

    foreach ($updatable as $field) {
        if (isset($data[$field])) {
            $fields[] = "$field = ?";
            $values[] = $data[$field];
        }
    }

    if (empty($fields)) {
        http_response_code(400);
        echo json_encode([
            "status" => "error",
            "message" => "Aucun champ à mettre à jour"
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    $values[] = $id; // pour le WHERE

    $sql = "UPDATE advertisements SET " . implode(", ", $fields) . " WHERE ad_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);

    echo json_encode([
        "status" => "success",
        "message" => "Annonce mise à jour",
        "id" => $id
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// --------------------
// DELETE /api/advertisements/{id} → supprimer une annonce
// --------------------
if ($method === "DELETE" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int)$parts[1];

    // Vérifier si l'annonce existe
    $stmt = $pdo->prepare("SELECT ad_id FROM advertisements WHERE ad_id = ?");
    $stmt->execute([$id]);
    $ad = $stmt->fetch();

    if (!$ad) {
        http_response_code(404);
        echo json_encode([
            "status" => "error",
            "message" => "Annonce non trouvée"
        ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Suppression
    $stmt = $pdo->prepare("DELETE FROM advertisements WHERE ad_id = ?");
    $stmt->execute([$id]);

    echo json_encode([
        "status" => "success",
        "message" => "Annonce supprimée",
        "id" => $id
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// --------------------
// Si aucune route ne correspond
// --------------------
http_response_code(404);
echo json_encode(["status" => "error", "message" => "Route inconnue dans advertisements"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);