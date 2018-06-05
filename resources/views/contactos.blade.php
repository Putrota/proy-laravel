@extends('layout')


@section('contenido')

	<h1>Contactos con blade</h1>

	<h2>Escríbeme</h2>

	<form method="POST" action="contacto">

		<p>			
			<label for="nombre" >Nombre

			<input type="text" name="nombre">
			</label>
		</p>

		<p>
			<label for="email" >Email

			<input type="text" name="email">

			</label>
		</p>

		<p>
			<label for="mensaje" >Mensaje

			<textarea name="mensaje"></textarea>

			</label>
		</p>
		
		<p>
			<input type="submit" name="Enviar">
		</p>
	</form>

@stop