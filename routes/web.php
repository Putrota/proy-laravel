<?php

Route::get('/', function() {

	// La función route nos devulve la url de la ruta
	echo '<a href="">' . route('contactos') . '</a>';

	return 'Hola desde la página de inicio';

});


// Podemos definir un alias de contactos para referirnos a el
// Si cambiamos el nombre de la ruta no nos afectará
Route::get('contacto', ['as' => 'contactos',function(){

	return 'Sección de contactos';

}]);


// Diferentes maneras de recibir variables
// Variable nombre obligatoria
Route::get('saludos1/{nombre}', function($nombre) {

	return 'Hola ' . $nombre;

});


// Variable nombre opcional con valor por defecto
Route::get('saludos2/{nombre?}', function($nombre = 'Invitado') {

	return 'Hola ' . $nombre;

});


// Variable con validacion
Route::get('saludos3/{nombre?}', function($nombre = 'Invitado') {

	return 'Hola ' . $nombre;

})->where('nombre', '[A-Za-z]+');