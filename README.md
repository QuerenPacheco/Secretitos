<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Secretitos

Secretitos es una aplicación segura para almacenar secretos.

El usuario podrá crear una cuenta con la que podrá almacenar sus secretos.

La principal característica de Secretitos es que los secretos almacenados solo son visibles durante un 
corto período antes de desaparecer permanentemente.

## Programas
- PHP 8.1 (requerido por laravel 10) y sus dependencias con:
   ```
   sudo apt-get update
   sudo apt-get install php8.1
   sudo apt-get install php8.1-xml
   sudo apt-get install php8.1-curl
   sudo apt-get install php8.1-mysql
   sudo apt-get install php8.1-mbstring
   ```
- Composer con: [Link de instalación](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-composer-on-ubuntu-20-04)
- MySql con: `sudo apt install mysql-server`
- (Opcional) Servidor de mail con: [Link de instalación](https://medium.com/@lesliedouglas23/how-to-set-up-mailpit-on-ubuntu-wsl-541778d13fd1)

## Configuración
- Rellenar .env las claves que empiecen por `DB_` con los datos necesarios para conectar con la base de datos.
- (Opcional) Rellenar .env las claves que empiecen con `MAIL_` con los datos necesarios para conectar con el servicio de mail.
## Preparación
- Actualización de libresias del backend : `composer update`
- Instalación de libresias del backend : `composer install`
- Preparación de la base de datos: `php artisan migrate`
- Instalación de libresias del frontend : `npm ci`
- Construir frontend: `npm run build`

## Despliegue
 `php artisan serve`

# Qué me gustaría hacer más
 - Cuenta atrás visible (`setTimeout`) en la desaparición del secreto
 - Dockerizar la aplicación
 - Soporte multilenguaje
 - Proyectos front y back independientes
 - Testing
