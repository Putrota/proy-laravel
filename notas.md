Comandos php artisan
	php artisan key:generate
	php artisan make:controller PagesController
	php artisan make:request CreateMessageRequest
	php artisan make:middleware Example

Helpers interesantes, repasarlos de vez en cuando
Parece que se ubican en vendor/laravel/Foundation/helpers.php

request()
response()
route()
redirect()
back()
csrf_token()
$this->middleware()

Middleware, un guardian una capa que intercepta las peticiones del usuario y verifica que cumpla sus reglas, si algo falla la petición es terminada


Migraciones php artisan
php artisan migrate // Para generar las tablas
php artisan migrate:rollback // Ejecuta el método down

// Crear la migración no crea la tabla
php artisan make:migration create_message_table // Crea el esqueleto de la tabla
php artisan make:migration create_message_table --create=messages //me ha hecho lo mismo que el anterior

// Modificar una tabla existente
// Podemos hacer el rollback y volver a hacer la migración, perderíamos la info

// Vamos a crear una nueva migración para añadir un comapo
php artisan make:migration add_phone_to_messages_table --table=messages
php artisan migrate // ejecutará los cambios
php artisan migrate:rollback // deshará los últimos cambios

// Actualizar todas las tablas 
// Hace un rollback y actualiza todo
// Borra datos
php artisan migrate:refresh