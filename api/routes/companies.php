<?php
// On suppose que $pdo, $method, $parts sont définis par index.php

// GET /api/companies → liste toutes les entreprises
if ($method === "GET" && count($parts) === 1) {
    $stmt = $pdo->query("
        SELECT company_id, name, sector, location, email, phone
        FROM companies
        ORDER BY company_id ASC
    ");
    $companies = $stmt->fetchAll();

    echo json_encode([
        "status" => "success",
        "count"  => count($companies),
        "data"   => $companies
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// GET /api/companies/{id} → détail d’une entreprise
if ($method === "GET" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int)$parts[1];
    $stmt = $pdo->prepare("
        SELECT company_id, name, sector, location, email, phone
        FROM companies
        WHERE company_id = ?
    ");
    $stmt->execute([$id]);
    $company = $stmt->fetch();

    if ($company) {
        echo json_encode(["status" => "success", "data" => $company], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    } else {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Entreprise non trouvée"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
    exit;
}

// --------------------
// POST /api/companies → créer une entreprise
// --------------------
if ($method === "POST" && count($parts) === 1) {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validation minimale
    $errors = [];
    if (empty($data["name"]))   { $errors[] = "name est requis"; }
    if (empty($data["sector"])) { $errors[] = "sector est requis"; }

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
        INSERT INTO companies (name, sector, location, email, phone)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $data["name"],
        $data["sector"],
        $data["location"] ?? null,
        $data["email"] ?? null,
        $data["phone"] ?? null
    ]);

    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "Entreprise créée",
        "id" => (int)$pdo->lastInsertId()
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// --------------------
// PUT /api/companies/{id} → modifier une entreprise
// --------------------
if ($method === "PUT" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int)$parts[1];
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifier si l'entreprise existe
    $stmt = $pdo->prepare("SELECT company_id FROM companies WHERE company_id = ?");
    $stmt->execute([$id]);
    $company = $stmt->fetch();

    if (!$company) {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Entreprise non trouvée"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Champs modifiables
    $fields = [];
    $values = [];
    $updatable = ["name", "sector", "location", "email", "phone"];

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
    $sql = "UPDATE companies SET " . implode(", ", $fields) . " WHERE company_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);

    echo json_encode(["status" => "success", "message" => "Entreprise mise à jour", "id" => $id], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// --------------------
// DELETE /api/companies/{id} → supprimer une entreprise
// --------------------
if ($method === "DELETE" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int)$parts[1];

    // Vérifier si l'entreprise existe
    $stmt = $pdo->prepare("SELECT company_id FROM companies WHERE company_id = ?");
    $stmt->execute([$id]);
    $company = $stmt->fetch();

    if (!$company) {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Entreprise non trouvée"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Suppression
    $stmt = $pdo->prepare("DELETE FROM companies WHERE company_id = ?");
    $stmt->execute([$id]);

    echo json_encode(["status" => "success", "message" => "Entreprise supprimée", "id" => $id], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// Si aucune route ne correspond
http_response_code(404);
echo json_encode([
    "status" => "error",
    "message" => "Route inconnue dans companies",
    "path" => $parts
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

?>