# Configuración MySQL

La aplicación puede usar JSON local o MySQL.

## Local

Sin credenciales, usa `data/rutachevere.json`.

## InfinityFree

1. Crea una base MySQL.
2. Ejecuta `schema.sql` en phpMyAdmin.
3. Copia `config.local.example.php` como `config.local.php`.
4. Reemplaza las credenciales.

## Panel administrativo

Abre `admin.php`.

Usuario: `admin`.
Contraseña predeterminada: `rutachevere2026`.

Cambia esta contraseña antes de publicar mediante
la variable `ADMIN_PASSWORD` o configurando la variable
`$ADMIN_PASSWORD` en `config.local.php`.
