<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Mi Proyecto Livewire

Este documento proporciona los pasos para retomar el desarrollo del proyecto Laravel con Livewire al cambiar de PC.

## Requisitos previos

Antes de comenzar, asegúrate de tener instalado lo siguiente:

- PHP >= 8.1
- Composer
- Node.js y npm
- MySQL o el gestor de base de datos correspondiente
- Git
- Laravel y Livewire

## Pasos para retomar el proyecto

1. **Clonar el repositorio desde GitHub**
   ```sh
   git clone https://github.com/AndyTC4P/mi-proyecto-livewire.git
   ```

2. **Ingresar al directorio del proyecto**
   ```sh
   cd mi-proyecto-livewire
   ```

3. **Instalar las dependencias de PHP**
   ```sh
   composer install
   ```

4. **Copiar el archivo de configuración**
   ```sh
   cp .env.example .env
   ```

5. **Configurar las variables de entorno**
   - Edita el archivo `.env` y configura la conexión a la base de datos:
     ```sh
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=nombre_de_tu_base_de_datos
     DB_USERNAME=tu_usuario
     DB_PASSWORD=tu_contraseña
     ```

6. **Generar la clave de la aplicación**
   ```sh
   php artisan key:generate
   ```

7. **Ejecutar las migraciones y seeders (si aplica)**
   ```sh
   php artisan migrate --seed
   ```

8. **Instalar dependencias de npm**
   ```sh
   npm install && npm run dev
   ```

9. **Levantar el servidor local**
   ```sh
   php artisan serve
   ```

10. **Acceder al proyecto**
    - Abre un navegador y ve a: [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## Comandos adicionales

- **Actualizar dependencias**
  ```sh
  composer update
  npm update
  ```

- **Verificar cambios en Git y subirlos**
  ```sh
  git status
  git add .
  git commit -m "Descripción de los cambios realizados"
  git pull origin main --rebase
  git push origin main
  ```

## Autor

Este proyecto ha sido realizado por **Andy Solorzano - By TC4P**.

## License

Este proyecto está bajo la licencia [MIT](https://opensource.org/licenses/MIT).