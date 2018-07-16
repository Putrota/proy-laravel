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
collect()
event()

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


REPASO CREAR VALIDADORES FORMULARIOS
php artisan make:request UpdateUserRequest
en el controlador reemplaza al reuqest, es como si lo dotara de más funcioens
	public function update(UpdateUserRequest $request, $id)

	validación email, único en la tabla users en la columna email
	unique:users,email'

	validación email, único en la tabla users en la columna email, sin contar el row con id 1
	unique:users,email,1


Poĺiticas de acceso
clases de laravel que gestionan los accesos a los diferentes recursos

La creamos con el siguiente comando
	php artisan make:policy UserPolicy

por cáda método del controller creamos un método en esta clase para comprobar la poĺitica de acceso

las politicas se conectan en el AuthServiceProvider.php
vamos creando los métodos para validadr cada acción y usamos la función authorize
	$this->authorize('destroy', $user);

En el blade podemos usar la directiva @can para mostrar código dependiendo del usuario que lo esté viendo
	@can('edit', $user)
		<a href="{{ route('usuarios.edit', $user->id) }}" class="btn btn-info">Editar</a>
	@endcan

COLECCIONES DE LARAVEL
use Illuminate\Support\Collection;
$collection = new Collection($users)
$collection = Collection::make($users)
$collection = collect($users)

$users->first()
=> [
     "name" => "asdf",
     "edad" => 10,
   ]
>>> $users->last()
=> [
     "name" => "cvbn",
     "edad" => 14,
   ]
>>> $users->count()
=> 3
>>> $users->sum('age')
=> 0
>>> $users->sum('edad')
=> 36
>>> $users->avg('edad')
=> 12
>>> $users->slice(-1)
$users->push(['name' => 'dfgh', 'edad' => 15])
$users->splice(3, 1)
$users->pluck('name')
$users->pluck('name')->contains('asdf')
$users->pluck('name')->intersect(['user 1', 'user 2'])->count()

https://laravel.com/docs/5.6/collections
Nota: eloquent nos devuelve colecciones



Guardando la relación automáticamente




// Asignanso relaciones muchos a muchos

$user = new App\User;
=> App\User {#2327}
 $user->name = 'Estudiante';
=> "Estudiante"
 $user->email = 'estudiante@email';
=> "estudiante@email"
 $user->password = bcrypt('123123');
=> "$2y$10$Fqo6mpiNY6nG8LM1T2uk2.rB255iA.ccOzqFKtFaR1GnPpenq8rQC"
 $user->save();

$user->roles()->attach(3);
$user->roles()->detach(3);
$user->roles()->attach([3,1]);
$user->roles()->detach([3,1]);
$user->roles()->sync($request->roles);


// Repaso request validation

php artisan make:request CreateUserRequest



// mutadores
Para modificar un atributo de formualrio antes de guardarlo, creamos la siguiente clase en el modelo

set + Nombre atributo + Attribure

	public function setPasswordAttribute($password)
    {

        $this->attributes['password'] = bcrypt($password);

    }

// Relaciones polimorficas en eloquent, hasOne y hasMany
Podemos necesitar que varias tablas tengan relación con una tabla central, por ejemplo la capacidad de crear notas de imágens, usuarios, mensajes ...

Para lograrlo definimos lo siguiente en la migración, notable es la palabra clave

	$table->integer('notable_id')->unsigned();
    $table->string('notable_type')

Y en los modelos como siempre 

App\Menssage
	public function note()
    {

    	return $this->morphOne(Note::class, 'notable');

    }

App\User
	public function note()
    {

        return $this->morphOne(Note::class, 'notable');

    }

Transparentemente es como si tubieramos un hasOne y un hasMany sencillo

// Repaso creación tabla pivot

// optimizando consultas
problema n+1, cada row necesita varias consultas lo solucionamos con
	Eager Loading, desde el module con una sola llamada lo tenemos todo
	Esto era lo que ya intuia en Zend, se trata de agrupar todas las consultas adicionales de los rows en una única


// Enviando emails


// Eventos
Algo ocurrió, eje registro de usurio
Listener acciones que se realizan en consecuencia del evento ocurrido
Eje enviar email después del regitro de usuario

event()

Los eventos son DTOs, objeto de transferencia de datos


// Seeders
Para rellenar tablas
php artisan make:seeder MessagesTableSeeder
php artisan db:seed
php artisan make:seeder UsersTableSeeder
php artisan db:seed --class=UsersTableSeeder
php artisan db:seed
php artisan migrate:refresh --seed


// Paginación
Todos los métodos del paginator https://laravel.com/docs/5.6/pagination

Ejemplos de paginator en la vista
{!! $messages->appends(['sorted' => request('sorted')])->links() !!}
{!! $messages->appends(request()->query())->links() !!}
{!! $messages->appends(request()->query())->links('pagination.custom') !!}
{!! $messages->appends(request()->query())->links('pagination::bootstrap-4') !!}
{!! $messages->fragment('hash')->appends(request()->query())->links('pagination::bootstrap-4') !!}

Esto es eloquent, pero ayuda al orden
$messages = Message::with(['user', 'note', 'tags'])
            // ->latest()
            ->orderBy('created_at', request('sorted', 'DESC'))
            ->paginate(10);

Publicar todas las plantillas para editarlas
php artisan vendor:publish --tag=laravel-pagination

// Cache en laravel
// SE guardan datos procesados

Cache::put('key', 'valor', 60);
Cache::get('key');
Cache::has('key');
Cache::flush(); // Borra toda la cache
Cache::forget('key'); //Creo que borra según la key

//$messages = Cache::remember($key, 5, function() {
$messages = Cache::rememberForever($key, function() {
    return Message::with(['user', 'note', 'tags'])
            ->orderBy('created_at', request('sorted', 'DESC'))
            ->paginate(10);
});

// $message = Cache::remember("messages.{$id}", 5, function() use ($id) {
$message = Cache::rememberForever("messages.{$id}", function() use ($id) {
    return Message::findOrFail($id);
});

// Obtener las plantillas del paginator
php artisan vendor:publish --tag=laravel-pagination


// Cache en Redis redis.io, key value store, base de datos no sql
// es un servidor de cache

1º Hemos hecho una instalación básica de un servidor redis
	https://www.digitalocean.com/community/tutorials/how-to-install-and-configure-redis-on-ubuntu-16-04

	Abría que profundizar más en la seguridad, dejo este enlace para el futuro

	https://www.digitalocean.com/community/tutorials/	how-to-secure-your-redis-installation-on-ubuntu-14-04

	Algunos comandos de redis

	sudo systemctl start redis
	sudo systemctl status redis
	sudo systemctl restart redis
	sudo systemctl enable redis
	sudo netstat -plunt | grep -i redis

	Algunos comandos del redis-cli

		ping
		set key olakase
		del key
		exists key
		get key
		keys *
		auth password

2º En el .env hemos cambiado file por redis
	CACHE_DRIVER=redis

3º Hemos actualizado los métodos de guardado y borrado para poder utilizar etiquetas
	$messages = Cache::tags('messages')->rememberForever($key, function() {
            return Message::with(['user', 'note', 'tags'])
                    ->orderBy('created_at', request('sorted', 'DESC'))
                    ->paginate(10);
        });
        Cache::tags('messages')->flush();
        $message = Cache::tags('messages')->rememberForever("messages.{$id}", 5, function() use ($id) {
            return Message::findOrFail($id);
        });

4º Algunas pruebas en el tinker, es posible que acepter un array
	Cache::tags('messages')->get('message.page.1')->all();


// Patrón repositorio, para que el contoller no tenga tantas responsabilidades
Con este patrón nos llevamos el código que interactua con la base de datos a otra clase


// Decorador
Vamos a crear una especie de contenedor que dotará de nuevas funcionalidades a la clase que envuelva.
En el docrador debemos implementar todos los métodos de la clase a decorar

Si estamos dentro del mismo namespace/directorio no hay necesidad de importar las clase namespace App\Repositories;

Procedimiento:
	1º Copiamos todo el código del método al método decoraddor.
	2º Adecuamos la lógia en cada lugar
	3º en el controller llamamos al decorador

Si no quisieramos la capa de cache, llamamos al repositorio directamente. Podemos decorar un objeto en el camino

Interfaces, podemos definir qué métodos tendrá el decorador definiendolos en  un interface
	interface MessagesInterface
	{

Para agregar otro método lo difinimos en la interface
Podemos inyectar directamente la interface
	debemos hacer un biding de la interfaz y la clase por defecto (enlazar o vincular)

Haciendo un binding en el route web.php
	use App\Repositories\Messages;
	use App\Repositories\CacheMessages;
	use App\Repositories\MessagesInterface;

	app()->bind(MessagesInterface::class, CacheMessages::class);

Haciendo un binding en  AppServiceProvider.php dentro del método boot

	$this->app->bind(MessagesInterface::class, CacheMessages::class);

// view presenters
intermediario entre el modelo y el view, para mantener la lógica fuera de las vistas