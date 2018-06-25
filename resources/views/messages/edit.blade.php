@extends('layout')


@section('contenido')

	<h1>Editar mensaje {{ $message->nombre }}</h1>

	@if(session()->has('info'))
		<h3>{{ session('info') }}</h3>
	@else

		<form method="POST" action="{{ route('mensajes.update', $message->id) }}">

			{!! method_field('PUT') !!}
			{!! csrf_field() !!}

			<div class="form-group">		
				<label for="nombre" >Nombre

				<input class="form-control" type="text" name="nombre" value="{{ $message->nombre }}">

				{!! $errors->first('nombre', '<span class="error">:message</span>') !!}

				</label>
			</div>

			<div class="form-group">
				<label for="email" >Email

				<input class="form-control" type="text" name="email" value="{{ $message->email }}">

				{!! $errors->first('email', '<span class="error">:message</span>') !!}

				</label>
			</div>

			<div class="form-group">
				<label for="mensaje" >Mensaje

				<textarea class="form-control" name="mensaje" >{{ $message->mensaje }}</textarea>

				{!! $errors->first('mensaje', '<span class="error">:message</span>') !!}

				</label>
			</div>

			<button type="submit" class="btn btn-primary">Enviar</button>
		</form>
	@endif	

@stop