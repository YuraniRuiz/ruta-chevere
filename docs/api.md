# API PHP

El archivo `api.php` acepta dos métodos.

## GET

Carga el contenido guardado:

```text
GET /api.php
```

## POST

Guarda el objeto completo enviado desde el frontend:

```text
POST /api.php
Content-Type: application/json
```

Ejemplo:

```json
{
  "db": {
    "nid": 100,
    "session": null,
    "users": [],
    "trips": []
  }
}
```

Para restaurar los datos de ejemplo:

```json
{
  "action": "reset"
}
```
