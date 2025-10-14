<?php
// On suppose que $pdo, $method, $parts sont définis par index.php

// GET /api/people → liste toutes les personnes
if ($method === "GET" && count($parts) === 1) {
    $stmt = $pdo->query("
        SELECT people_id, name, firstname, password, phone, address, email, admin
        FROM people
        ORDER BY people_id ASC
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
        SELECT people_id, name, firstname, password, phone, address, email, admin
        FROM people
        WHERE people_id = ?
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
// POST /api/people → créer une personne
// --------------------
if ($method === "POST" && count($parts) === 1) {
    $data = json_decode(file_get_contents("php://input"), true);

    // Validation minimale
    $errors = [];
    if (empty($data["name"]))      { $errors[] = "name est requis"; }
    if (empty($data["firstname"])) { $errors[] = "firstname est requis"; }

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
        INSERT INTO people (name, firstname, password, phone, address, email, admin) 
         VALUES (?, ?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $data["name"],
        $data["firstname"],
        $data["password"] ?? null,
        $data["phone"] ?? null,
        $data["address"] ?? null,
        $data["email"] ?? null,
        $data["admin"] ?? null
    ]);

    http_response_code(201);
    echo json_encode([
        "status" => "success",
        "message" => "Personne créée",
        "id" => (int)$pdo->lastInsertId()
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// --------------------
// PUT /api/people/{id} → modifier une personne
// --------------------
if ($method === "PUT" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int)$parts[1];
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifier si la personne existe
    $stmt = $pdo->prepare("SELECT people_id FROM people WHERE people_id = ?");
    $stmt->execute([$id]);
    $person = $stmt->fetch();

    if (!$person) {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Personne non trouvée"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Champs modifiables
    $fields = [];
    $values = [];
    $updatable = ["name", "firstname", "password", "phone", "address", "email", "admin"];

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
    $sql = "UPDATE people SET " . implode(", ", $fields) . " WHERE people_id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($values);

    echo json_encode(["status" => "success", "message" => "Personne mise à jour", "id" => $id], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    exit;
}

// --------------------
// DELETE /api/people/{id} → supprimer une personne
// --------------------
if ($method === "DELETE" && count($parts) === 2 && is_numeric($parts[1])) {
    $id = (int)$parts[1];

    // Vérifier si la personne existe
    $stmt = $pdo->prepare("SELECT people_id FROM people WHERE people_id = ?");
    $stmt->execute([$id]);
    $person = $stmt->fetch();

    if (!$person) {
        http_response_code(404);
        echo json_encode(["status" => "error", "message" => "Personne non trouvée"], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        exit;
    }

    // Suppression
    $stmt = $pdo->prepare("DELETE FROM people WHERE people_id = ?");
    $stmt->execute([$id]);

    echo json_encode(["status" => "success", "message" => "Personne supprimée", "id" => $id], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
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