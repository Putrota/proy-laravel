@extends('layout')


@section('contenido')

	<h1>Editar usuario</h1>

	@if(session()->has('info'))
		<div class="alert alert-success">
			{{ session('info') }}
		</div>
	@endif

	<form method="POST" action="{{ route('usuarios.update', $user->id) }}">

			{!! method_field('PUT') !!}
			{!! csrf_field() !!}

			<div class="form-group">		
				<label for="nombre" >Nombre

				<input class="form-control" type="text" name="name" value="{{ $user->name }}">

				{!! $errors->first('name', '<span class="error">:message</span>') !!}

				</label>
			</div>

			<div class="form-group">
				<label for="email" >Email

				<input class="form-control" type="text" name="email" value="{{ $user->email }}">

				{!! $errors->first('email', '<span class="error">:message</span>') !!}

				</label>
			</div>			

			<button type="submit" class="btn btn-primary">Enviar</button>

		</form>
@stop