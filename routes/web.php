<?php

// Esta vez le asignamos el view desde el controlador
Route::get('/', ['as' => 'home', 'uses' => 'PagesController@home'])->middleware('example');


Route::get('contacto', ['as' => 'contactos', 'uses' => 'PagesController@contactos']);


Route::post('contacto', 'PagesController@mensajes');


Route::get('saludo/{nombre?}', ['as' => 'saludos', 'uses' => 'PagesController@saludo'])->where('nombre', '[A-Za-z]+');


Route::get('mensajes', ['as' => 'messages.index', 'uses' => 'MessagesController@index']);
Route::get('mensajes/create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
Route::post('mensajes', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
Route::get('mensajes/{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
Route::get('mensajes/{id}/edit', ['as' => 'messages.edit', 'uses' => 'MessagesController@edit']);
Route::put('mensajes/{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
Route::delete('mensajes/{id}', ['as' => 'messages.destroy', 'uses' => 'MessagesController@destroy']);