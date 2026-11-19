# Datos y persistencia

Los datos se almacenan en:

```text
data/rutachevere.json
```

Este archivo no se sube al repositorio porque está excluido en `.gitignore`.

## Motivo

Evita publicar información personal y permite que cada instalación cree sus propios datos iniciales.

## Archivo de ejemplo

`seed.php` contiene usuarios y viajes iniciales. La carpeta `data` se crea automáticamente al abrir la API por primera vez.
