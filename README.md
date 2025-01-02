# OrganizaTe

Este es un proyecto en desarrollo que tiene como objetivo ayudar a pequeñas empresas a organizar y gestionar su inventario y pedidos de manera eficiente. La aplicación está desarrollada principalmente con **Laravel** y **Livewire**, y cuenta con una interfaz clara, sencilla y minimalista.

## Funcionalidades principales

- **Productos**: Visualización del inventario disponible de la empresa.
- **Pedidos**: Realización de órdenes de forma organizada y sencilla.
- **Autenticación**: Sistema de registro y login con **Laravel Breeze**.
- **Roles de usuario**: Diferenciación entre usuarios administradores y usuarios regulares.

## Tecnologías utilizadas

- **Backend**: Laravel 10, Livewire 3.5
- **Frontend**: Bootstrap, Vite
- **Autenticación**: Laravel Breeze
- **Otras dependencias**: Bootstrap Icons, Axios

## Requisitos previos

- PHP >= 8.1
- Composer
- Node.js (con npm o yarn)
- MySQL o cualquier base de datos compatible con Laravel

## Dependencias

### Backend (composer.json)

- `php`: ^8.1
- `laravel/framework`: ^10.10
- `guzzlehttp/guzzle`: ^7.2
- `laravel/sanctum`: ^3.3
- `livewire/livewire`: ^3.5

**Dependencias de desarrollo**:

- `laravel/breeze`: ^1.29
- `laravel/pint`: ^1.0
- `laravel/sail`: ^1.18
- `phpunit/phpunit`: ^10.1
- `spatie/laravel-ignition`: ^2.0

### Frontend (package.json)

- `@tailwindcss/forms`: ^0.5.2
- `autoprefixer`: ^10.4.2
- `axios`: ^1.6.4
- `bootstrap-icons`: ^1.11.3
- `laravel-vite-plugin`: ^1.0.0
- `postcss`: ^8.4.31
- `tailwindcss`: ^3.1.0
- `vite`: ^5.0.0

## Instalación y configuración

1. Clona el repositorio:

   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd <NOMBRE_DEL_REPOSITORIO>
   ```

2. Instala las dependencias de PHP:

   ```bash
   composer install
   ```

3. Instala las dependencias de Node.js:

   ```bash
   npm install
   ```

4. Copia el archivo `.env.example` y configúralo:

   ```bash
   cp .env.example .env
   ```

   Configura la conexión a tu base de datos en el archivo `.env`.

5. Genera la clave de la aplicación:

   ```bash
   php artisan key:generate
   ```

6. Migra las tablas de la base de datos:

   ```bash
   php artisan migrate
   ```

7. Genera los assets del frontend:

   ```bash
   npm run dev
   ```

8. Inicia el servidor de desarrollo:

   ```bash
   php artisan serve
   ```

   La aplicación estará disponible en `http://localhost:8000`.

## Notas adicionales

- Las imágenes subidas para los productos se almacenan en el directorio `storage/app/public`. Asegúrate de correr el siguiente comando para enlazar el almacenamiento público:

  ```bash
  php artisan storage:link
  ```

- En caso de errores, verifica que tienes todas las extensiones necesarias de PHP habilitadas (como `fileinfo`).

---

¡Gracias por visitar este proyecto! Si tienes alguna sugerencia o pregunta, no dudes en crear un issue o contactarme a través de LinkedIn. 🚀
