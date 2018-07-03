@extends('layout')


@section('contenido')

	<h1>Contactos con blade</h1>

	<h2>Escríbeme</h2>

	@if(session()->has('info'))
		<h3>{{ session('info') }}</h3>
	@else

		<form method="POST" action="{{ route('mensajes.store') }}">

			{!! csrf_field() !!}

			@if (auth()->guest())

				<div class="form-group">			
					<label for="nombre" >Nombre

					<input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}">

					{!! $errors->first('nombre', '<span class="error">:message</span>') !!}

					</label>
				</div>

				<div class="form-group">
					<label for="email" >Email

					<input type="text" class="form-control" name="email" value="{{ old('email') }}">

					{!! $errors->first('email', '<span class="error">:message</span>') !!}

					</label>
				</div>

			@endif

			<div class="form-group">
				<label for="mensaje" >Mensaje

				<textarea class="form-control" name="mensaje" >{{ old('mensaje') }}</textarea>

				{!! $errors->first('mensaje', '<span class="error">:message</span>') !!}

				</label>
			</div>

			<button type="submit" class="btn btn-primary">Enviar</button>
		</form>
	@endif

@stop