<?php

// Esta vez le asignamos el view desde el controlador
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home'])->middleware('example');


Route::get('contacto', ['as' => 'contactos', 'uses' => 'PagesController@contactos']);


Route::post('contacto', 'PagesController@mensajes');


Route::get('saludo/{nombre?}', ['as' => 'saludos', 'uses' => 'PagesController@saludo'])->where('nombre', '[A-Za-z]+');