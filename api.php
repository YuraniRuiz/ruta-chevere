<?php

/**
 * API compatible con MySQL (InfinityFree) y JSON local.
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/storage.php';
require_once __DIR__ . '/database.php';

$pdo = databaseConnection();
$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

function readAppData(PDO $pdo): array {
    $row = $pdo->query('SELECT data_json FROM app_state WHERE id = 1')->fetch();
    $data = is_array($row) ? json_decode((string) $row['data_json'], true) : null;
    if (!is_array($data) || !isset($data['users'], $data['trips'])) return seedData();
    return $data;
}

function saveAppData(PDO $pdo, array $data): bool {
    $statement = $pdo->prepare('UPDATE app_state SET data_json = :data WHERE id = 1');
    $result = $statement->execute(['data' => json_encode($data, JSON_UNESCAPED_UNICODE)]);
    if ($statement->rowCount() === 0) {
        $insert = $pdo->prepare('INSERT INTO app_state (id, data_json) VALUES (1, :data)');
        $insert->execute(['data' => json_encode($data, JSON_UNESCAPED_UNICODE)]);
    }
    return $result;
}

if ($method === 'GET') {
    $data = $pdo ? readAppData($pdo) : readData();
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

if ($method === 'POST') {
    $body = json_decode((string) file_get_contents('php://input'), true);
    if (!is_array($body)) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Datos JSON inválidos']);
        exit;
    }

    $data = ($body['action'] ?? '') === 'reset' ? seedData() : ($body['db'] ?? $body);
    $saved = $pdo ? saveAppData($pdo, $data) : writeData($data);

    if (!is_array($data) || !$saved) {
        http_response_code(500);
        echo json_encode(['ok' => false, 'error' => 'No se pudo guardar']);
        exit;
    }

    echo json_encode(['ok' => true]);
    exit;
}

http_response_code(405);
echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
