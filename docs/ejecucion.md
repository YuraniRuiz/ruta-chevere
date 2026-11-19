# Ejecución local

## Requisitos

- PHP 8.1 o superior.
- Un navegador moderno.

## Inicio

Desde la carpeta del proyecto:

```powershell
php -S localhost:8000
```

Después abre:

```text
http://localhost:8000/index.html
```

## Prueba de API

Obtén todos los datos:

```powershell
Invoke-WebRequest http://localhost:8000/api.php
```

La respuesta debe ser un objeto JSON con usuarios y viajes.
