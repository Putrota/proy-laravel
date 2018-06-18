<?php

/*Route::get('test', function() {

	$user = new App\User;
	$user->name = 'Alexis';
	$user->email = 'alexis@gmail.com';
	$user->password = bcrypt('123456');
	$user->save();

	return $user;

});*/

// Esta vez le asignamos el view desde el controlador
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home'])->middleware('example');


Route::get('saludo/{nombre?}', ['as' => 'saludos', 'uses' => 'PagesController@saludo'])->where('nombre', '[A-Za-z]+');


Route::resource('mensajes', 'MessagesController');


Route::get('login', ['as' =>'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout');
