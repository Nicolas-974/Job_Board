<?php
header("Content-Type: application/json; charset=utf-8");

// Connexion PDO
require_once __DIR__ . '/../config/config.php';

// Méthode HTTP
$method = $_SERVER['REQUEST_METHOD'];

// Récupération du chemin après index.php
$uri = $_SERVER['REQUEST_URI'];
$base = dirname($_SERVER['SCRIPT_NAME']); // /api
$path = trim(str_replace($base . "/index.php", "", $uri), "/");
$parts = $path === "" ? [] : explode("/", $path);

// Ressource principale (ex: "advertisements", "companies", "people")
$resource = $parts[0] ?? null;

if ($resource) {
    $routeFile = __DIR__ . "/routes/" . $resource . ".php";
    if (file_exists($routeFile)) {
        // Ces variables ($pdo, $method, $parts) seront accessibles dans le fichier inclus
        require $routeFile;
        exit;
    }
}

// Si aucune ressource trouvée
http_response_code(404);
echo json_encode([
    "status" => "error",
    "message" => "Route inconnue",
    "path" => $path
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);