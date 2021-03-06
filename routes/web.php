<?php


// Route::get('job', function() {

// 	dispatch(new App\Jobs\SendEmail);

// 	return 'listo';

// });


DB::listen(function($query) {
	// echo "<pre>{$query->sql}</pre>";
});

/*Route::get('test', function() {

	$user = new App\User;
	$user->name = 'Estudiante';
	$user->email = 'estudiante@gmail.com';
	$user->password = bcrypt('123456');
	$user->save();

	return $user;

});*/

//  App\User::create([
// 	'name' => 'Nemut',
// 	'email' => 'nemut@email.com',
// 	'password' => bcrypt('123456'),
	
// ]); 


Route::get('roles', function() {
	return \App\Role::with('user')->get();
});


// Esta vez le asignamos el view desde el controlador
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home'])->middleware('example');


Route::get('saludo/{nombre?}', ['as' => 'saludos', 'uses' => 'PagesController@saludo'])->where('nombre', '[A-Za-z]+');


Route::resource('mensajes', 'MessagesController');
Route::resource('usuarios', 'UsersController');


Route::get('login', ['as' =>'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
