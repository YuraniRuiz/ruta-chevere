# Arquitectura

Ruta Chévere funciona con tres capas simples:

1. `index.html`: interfaz, estilos y navegación.
2. `api.php`: recibe solicitudes HTTP y responde en JSON.
3. Archivos PHP auxiliares: configuración, datos iniciales y persistencia.

## Flujo

```text
Navegador → api.php → storage.php → data/rutachevere.json
         ← JSON      ← lectura/guardado
```

## Archivos principales

- `config.php`: rutas y cabeceras HTTP.
- `seed.php`: datos iniciales.
- `storage.php`: lectura y escritura segura.
- `api.php`: controlador GET y POST.
