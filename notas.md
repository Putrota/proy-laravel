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

Middleware, un guardian una capa que intercepta las peticiones del usuario y verifica que cumpla sus reglas, si algo falla la petición es terminada