@extends('layout')


@section('contenido')

	<h1>Contactos con blade</h1>

	<h2>Escríbeme</h2>

	@if(session()->has('info'))
		<h3>{{ session('info') }}</h3>
	@else

		<form method="POST" action="{{ route('messages.store') }}">

			<?php /*<input type="hidden" name="_token" value="{{ csrf_token() }}"> */ ?>

			{!! csrf_field() !!}

			<p>			
				<label for="nombre" >Nombre

				<input type="text" name="nombre" value="{{ old('nombre') }}">

				{!! $errors->first('nombre', '<span class="error">:message</span>') !!}

				</label>
			</p>

			<p>
				<label for="email" >Email

				<input type="text" name="email" value="{{ old('email') }}">

				{!! $errors->first('email', '<span class="error">:message</span>') !!}

				</label>
			</p>

			<p>
				<label for="mensaje" >Mensaje

				<textarea name="mensaje" >{{ old('mensaje') }}</textarea>

				{!! $errors->first('mensaje', '<span class="error">:message</span>') !!}

				</label>
			</p>

			<p>
				<input type="submit" name="Enviar">
			</p>
		</form>
	@endif

@stop