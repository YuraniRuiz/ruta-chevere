<?php

/**
 * Conexión MySQL para hosting InfinityFree.
 * Las credenciales se toman de variables de entorno o config.local.php.
 */

function databaseConnection(): ?PDO {
    $config = __DIR__ . '/config.local.php';
    if (is_file($config)) {
        require $config;
    }

    $host = getenv('DB_HOST') ?: ($DB_HOST ?? '');
    $name = getenv('DB_NAME') ?: ($DB_NAME ?? '');
    $user = getenv('DB_USER') ?: ($DB_USER ?? '');
    $pass = getenv('DB_PASS') ?: ($DB_PASS ?? '');

    if ($host === '' || $name === '' || $user === '') {
        return null;
    }

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$name;charset=utf8mb4", $user, $pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        return $pdo;
    } catch (Throwable $error) {
        error_log('Ruta Chévere DB: ' . $error->getMessage());
        return null;
    }
}
