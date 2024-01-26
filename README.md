<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
# Requisitos

## Programas
- PHP 8.1 (requerido por laravel 10) y sus dependencias con:
   ```
   sudo apt-get update
   sudo apt-get install php8.1
   sudo apt-get install php8.1-xml
   sudo apt-get install php8.1-curl
   sudo apt-get install php8.1-mysql
   ```
- Composer con: [Link de instalación](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04)
- MySql con: `sudo apt install mysql-server`

## Configuración
- Rellenar .env las claves que empiecen por `DB_` con los datos necesarios para conectar con la base de datos.

## Preparación
- Actualización de libresias del backend : `composer update`
- Instalación de libresias del backend : `composer install`
- Preparación de la base de datos: `php artisan migrate`
- Instalación de libresias del frontend : `npm ci`
- Construir frontend: `npm run build`

## Despliegue
 `php artisan serve`
