<?php

/** Panel privado para consultar usuarios y viajes. */
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/storage.php';
require_once __DIR__ . '/database.php';

$password = getenv('ADMIN_PASSWORD') ?: ($ADMIN_PASSWORD ?? 'rutachevere2026');

if (!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] !== 'admin' ||
    !hash_equals($password, $_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic realm="Ruta Chévere Admin"');
    header('HTTP/1.1 401 Unauthorized');
    exit('Acceso denegado');
}

$pdo = databaseConnection();
$data = $pdo ? readAdminData($pdo) : readData();

function readAdminData(PDO $pdo): array {
    $row = $pdo->query('SELECT data_json FROM app_state WHERE id = 1')->fetch();
    $decoded = is_array($row) ? json_decode((string) $row['data_json'], true) : null;
    return is_array($decoded) ? $decoded : seedData();
}

header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="es"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width">
<title>Administración - Ruta Chévere</title>
<style>body{font-family:system-ui;margin:0;background:#f7f4ef;color:#24201d}main{max-width:980px;margin:auto;padding:24px}table{width:100%;border-collapse:collapse;background:white}th,td{padding:10px;border:1px solid #ddd;text-align:left}.card{overflow:auto;margin:20px 0}h1,h2{color:#b94d11}</style>
</head><body><main><h1>Administración Ruta Chévere</h1>
<h2>Usuarios</h2><div class="card"><table><tr><th>ID</th><th>Nombre</th><th>Rol</th><th>Documento</th><th>Celular</th><th>Verificado</th></tr>
<?php foreach (($data['users'] ?? []) as $u): ?><tr><td><?= htmlspecialchars((string)$u['id']) ?></td><td><?= htmlspecialchars($u['name']) ?></td><td><?= htmlspecialchars($u['role']) ?></td><td><?= htmlspecialchars($u['doc']) ?></td><td><?= htmlspecialchars($u['phone']) ?></td><td><?= $u['ok'] ? 'Sí' : 'No' ?></td></tr><?php endforeach; ?></table></div>
<h2>Viajes</h2><div class="card"><table><tr><th>ID</th><th>Ruta</th><th>Fecha</th><th>Hora</th><th>Cupos</th><th>Estado</th></tr>
<?php foreach (($data['trips'] ?? []) as $t): ?><tr><td><?= htmlspecialchars((string)$t['id']) ?></td><td><?= htmlspecialchars($t['o'].' → '.$t['d']) ?></td><td><?= htmlspecialchars($t['date']) ?></td><td><?= htmlspecialchars($t['time']) ?></td><td><?= htmlspecialchars((string)$t['seats']) ?></td><td><?= htmlspecialchars($t['status']) ?></td></tr><?php endforeach; ?></table></div>
</main></body></html>
