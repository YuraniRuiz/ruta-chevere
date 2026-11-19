<?php

/**
 * Datos iniciales utilizados por el prototipo.
 * Genera fechas relativas para mantener viajes activos.
 */

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
