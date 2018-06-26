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
$request
auth()->guest()

Route::resource('mensajes', 'MessagesController'); // Crea todas las rutas de un REST

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



// Para investigar un comando ponemos -h
php artisan make:controller -h MessagesController

// Crear un controller REST
php artisan make:controller MessagesController --resource

// Mostrar las rutas definidas
php artisan route:list

Clases especiales
use Carbon\Carbon; // manejo de fechas
use DB; // Operaciones con bases de datos

ELOQUENT
ORM de laravel


BONUS
Procedimento reemplazar varias cadenas de texto en todo el proyecto
	Ctrl + Shif + F
Buscar reemplazar y guardar todo


ORM
Crear un model de base de datos
php artisan make:model Message

Protección contra cambios masivos, puedo editar cualquier campo
Vulnerabilidad mass assignment, desactivar lo siguiente



        Model::unguard(); // Deshabilitamos la protección de asignación masiva
        {!! csrf_field() !!} // borrar
        protected $except = [ // modificar el middleware
        //'mensajes'
    ];

Administrando estilos

laravel incorpora webpack dentro de webpack.mix.js para generar los estilos, estos pueden ser scss, less, sass y más

Primero hay que instalar los paquetes de node
	npm install

Luego par transpilar
	npm run dev
	npm run watch // par observar los cambios dinámicamente

Configurar otros formatos en el archivos webpack.mix.js
	let mix = require('laravel-mix');

	mix.js('resources/assets/js/app.js', 'public/js')
	   .sass('resources/assets/sass/app.scss', 'public/css')
	   //.less('resources/assets/less/app.less', 'public/css')
	   //.sass('resources/assets/sass/app.sass', 'public/css')
	   ;

// Concepto de role
// el método que no existe en un modelo nos da un error de query

	auth()->user() // Devuelve una instancia de user
	auth()->user() == App\user == Eloquent

	Eloquent\Model tiene hasRoles()?
	Query\Builder tiene hasRoles()?
	no encuentro hasRoles() ErrorException













BONUS insertar usuarios en la base de datos
/*Route::get('test', function() {

	$user = new App\User;
	$user->name = 'Alexis';
	$user->email = 'alexis@gmail.com';
	$user->password = bcrypt('123456');
	$user->save();

	return $user;

});*/

/* App\User::create([
	'name' => 'Alexis',
	'email' => 'alexis@email.com',
	'password' => bcrypt('123456')
]);*/


// Relaciones
php artisan -h make:model // ayuda
php artisan make:model Role -m // Crea el model y la migración

Relación 1 a 1, creamos el método que conecta con la clase destino, en este caso se ha usado el cambo role_id, por convención, esto nos devolverá todo el row de la relación

    public function role()
    {

        return $this->belongsTo(Role::class);

    }

Para conseguir las relaciones inversas, métodoen Role
public function user()
	return $this->hasOne(User::class);
	return $this->hasMany(User::class);

return \App\Role::with('user')->get();


Para crear una relación muchos a muchos tenemos que crear una tabla pivote, la convención nos dice que pongamos lo siguiente
// Tablas en sigular, alfabéticamente y separadas por guión bajo
	php artisan make:migration users roles --- create_role_user

Pero para tener un nombre más descriptivo usamos el siguiente
	php artisan make:migration create_assigned_roles_table --create=assigned_roles

	// hemos hecho un refresh
	// para crear nuevos usuarios vamos a usar la herramienta tinker
	// que chulo es como una consola de php
	php artisan tinker

	>>> $u = new App\User;\
... $u->name = "Administrador"\
... $u->email = "admin@email.php"\
PHP Parse error: Syntax error, unexpected T_VARIABLE on line 3
>>> $u = new App\User;                                                                                                         $u->name = "Administrador";                                                                                                    $u->email = "admin@email.php";\
... $u->password = bcrypt("123123");\
... $u->save();