# Proyecto Chirps - Aplicación de Mensajes Cortos en Laravel

Este proyecto es una aplicación sencilla para gestionar **chirps** (mensajes cortos tipo microblog) utilizando Laravel. Se implementaron funcionalidades básicas con buenas prácticas de desarrollo y organización.

---

## Tecnologías y características destacadas

- **Laravel v12.14.1** con **Laravel Breeze v2.3.6** para autenticación.
- **Migraciones y consultas SQL**.
- **Eloquent ORM**.
- **Eager loading** para evitar el problema N+1 en consultas (usando `with()`).  
  Para depurar las consultas y confirmar el impacto, se agregó temporalmente en `routes/api.php` este código comentado:
  ```php
  // DB::listen(function ($query) {
  //    dump($query->sql);
  // });
![Image](https://github.com/user-attachments/assets/fc16c34a-c5f3-47dd-a94a-4c653aad6420)

- **Políticas de acceso (Policies)** para controlar permisos de edición y eliminación de chirps.
- **Validaciones de datos**.
- **Internacionalización** con el paquete laravel-lang para soporte multilenguaje.
- **Blade como motor de plantillas**.
- **Autorización con middleware** para proteger rutas y recursos.
- **PHPUnit** para testear funcionalidad de la aplicación.

 ## Estructura relevante del proyecto

- Migraciones en database/migrations para definir la estructura de tablas con SQL.
- Modelos en app/Models con relaciones hasMany y belongsTo.
- Policies en app/Policies para autorización a nivel de modelo.
- Validaciones mediante Form Requests personalizados.
- Rutas API en routes/api.php.
- Testeo de funcionalidades en tests/Feature

 ## Cómo ejecutar y probar

 - Clonar repositorio.
 - Configurar .env con datos de la base de datos y el lenguaje (en o es).
 - Ejecutar migraciones: php artisan migrate

Levantar servidor local:

    php artisan serve
    npm run build
