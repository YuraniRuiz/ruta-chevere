# Desplegar en InfinityFree

## 1. Crear cuenta

Crea una cuenta gratuita en InfinityFree y registra un subdominio.

## 2. Crear MySQL

En el panel de control:

1. Abre MySQL Databases.
2. Crea una base de datos.
3. Copia servidor, nombre, usuario y contraseña.

## 3. Importar esquema

Abre phpMyAdmin, selecciona la base y ejecuta `schema.sql`.

## 4. Configurar PHP

Sube el proyecto a `htdocs` y crea `config.local.php`.
Copia `config.local.example.php` y reemplaza las credenciales.

## 5. Abrir sitio

Visita `https://TU-SUBDOMINIO.infinityfreeapp.com/index.html`.
Los datos de usuarios quedan guardados en MySQL.

## Seguridad

Nunca subas `config.local.php` al repositorio público.
