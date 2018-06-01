<?php

// Utilizamos la función view para asignar el php de views que devolverá laravel
Route::get('/', ['as' => 'home', function() {

	return view('home');

}]);


Route::get('contacto', ['as' => 'contactos',function(){

	return 'Sección de contactos';

}]);


Route::get('saludo/{nombre?}', ['as' => 'saludos', function($nombre = 'Invitado') {

	// Pasando parametros al view
	// return view('saludo', ['nombre' => $nombre]);
	// return view('saludo')->with(['nombre' => $nombre]);
	return view('saludo', compact('nombre'));

}])->where('nombre', '[A-Za-z]+');