<?php
header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

$dataDir = __DIR__ . '/data';
$dataFile = $dataDir . '/rutachevere.json';

function dayISO(int $days): string {
    return (new DateTimeImmutable("+$days days"))->format('Y-m-d');
}

function seedData(): array {
    return [
        'nid' => 100,
        'session' => null,
        'users' => [
            ['id' => 1, 'name' => 'Equipo Ruta Chévere', 'phone' => '', 'role' => 'admin', 'doc' => '', 'ok' => true],
            ['id' => 2, 'name' => 'Carlos Ramírez', 'phone' => '3001112233', 'role' => 'conductor', 'doc' => '1000000001', 'ok' => true],
            ['id' => 3, 'name' => 'Laura Gómez', 'phone' => '3002223344', 'role' => 'pasajero', 'doc' => '1000000002', 'ok' => true],
            ['id' => 4, 'name' => 'Andrés Pérez', 'phone' => '3003334455', 'role' => 'pasajero', 'doc' => '1000000003', 'ok' => false]
        ],
        'trips' => [
            ['id' => 10, 'driverId' => 2, 'o' => 'Suba', 'd' => 'Universidad', 'date' => dayISO(1), 'time' => '06:30', 'seats' => 3, 'fare' => 4500, 'point' => 'Av. Suba con Calle 127', 'status' => 'abierto', 'bookings' => []],
            ['id' => 11, 'driverId' => 2, 'o' => 'Kennedy', 'd' => 'Centro', 'date' => dayISO(1), 'time' => '07:00', 'seats' => 2, 'fare' => 4000, 'point' => 'Av. Boyacá con Calle 38 sur', 'status' => 'abierto', 'bookings' => []]
        ]
    ];
}

if (!is_dir($dataDir)) {
    mkdir($dataDir, 0775, true);
}
if (!file_exists($dataFile)) {
    file_put_contents($dataFile, json_encode(seedData(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX);
}

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

if ($method === 'GET') {
    echo file_get_contents($dataFile);
    exit;
}

if ($method === 'POST') {
    $body = json_decode(file_get_contents('php://input'), true);
    if (!is_array($body)) {
        http_response_code(400);
        echo json_encode(['ok' => false, 'error' => 'Datos JSON inválidos']);
        exit;
    }

    if (($body['action'] ?? '') === 'reset') {
        $body = seedData();
    } elseif (isset($body['db']) && is_array($body['db'])) {
        $body = $body['db'];
    }

    if (file_put_contents($dataFile, json_encode($body, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT), LOCK_EX) === false) {
        http_response_code(500);
        echo json_encode(['ok' => false, 'error' => 'No se pudo guardar']);
        exit;
    }

    echo json_encode(['ok' => true]);
    exit;
}

http_response_code(405);
echo json_encode(['ok' => false, 'error' => 'Método no permitido']);
