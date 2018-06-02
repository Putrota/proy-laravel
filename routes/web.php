<?php

// Utilizamos la función view para asignar el php de views que devolverá laravel
Route::get('/', ['as' => 'home', function() {

	return view('home');

}]);


Route::get('contacto', ['as' => 'contactos',function(){

	return view('contactos');

}]);


Route::get('saludo/{nombre?}', ['as' => 'saludos', function($nombre = 'Invitado') {

	// Pasando parametros al view
	// return view('saludo', ['nombre' => $nombre]);
	// return view('saludo')->with(['nombre' => $nombre]);

	$html = '<h2>Código html</h2>';

	$naruto_amigos = ['Naruto', 'Shakura', 'Sasuke'];
	$naruto_enemigos = [];

	return view('saludo', compact('nombre', 'html', 'naruto_amigos', 'naruto_enemigos'));

}])->where('nombre', '[A-Za-z]+');