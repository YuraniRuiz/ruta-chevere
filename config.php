<?php

/**
 * Configuración general y cabeceras de la API.
 * Mantiene las rutas y formatos centralizados.
 */

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: no-store');

define('DATA_DIR', __DIR__ . '/data');
defined('DATA_FILE') || define('DATA_FILE', DATA_DIR . '/rutachevere.json');
