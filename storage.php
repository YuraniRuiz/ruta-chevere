<?php

/**
 * Persistencia en JSON.
 * Crea el directorio, carga datos y guarda cambios.
 */

require_once __DIR__ . '/seed.php';

function ensureDataFile(): void {
    if (!is_dir(DATA_DIR)) {
        mkdir(DATA_DIR, 0775, true);
    }

    if (!file_exists(DATA_FILE)) {
        $json = json_encode(seedData(), JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        file_put_contents(DATA_FILE, $json, LOCK_EX);
    }
}

function readData(): array {
    ensureDataFile();
    $data = json_decode((string) file_get_contents(DATA_FILE), true);
    return is_array($data) ? $data : seedData();
}

function writeData(array $data): bool {
    ensureDataFile();
    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    return file_put_contents(DATA_FILE, $json, LOCK_EX) !== false;
}
