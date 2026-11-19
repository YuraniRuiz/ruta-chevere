<?php

/**
 * Controlador de la API JSON.
 * GET carga datos y POST los guarda en el servidor.
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/storage.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    echo json_encode(readData(), JSON_UNESCAPED_UNICODE);
    exit;
}

if ($method === 'POST') {
    $body = json_decode((string) file_get_contents('php://input'), true);

    if (!is_array($body)) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Datos JSON inválidos']);
        exit;
    }

    $data = ($body['action'] ?? '') === 'reset'
        ? seedData()
        : ($body['db'] ?? $body);

    if (!is_array($data) || !writeData($data)) {
        http_response_code(500);
        echo json_encode(['ok' => false, 'error' => 'No se pudo guardar']);
        exit;
    }

    echo json_encode(['ok' => true]);
    exit;
}

http_response_code(405);
echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
