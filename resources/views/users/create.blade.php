@extends('layout')


@section('contenido')

	<h1>Crear Usuario</h1>

	<form method="POST" action="{{ route('usuarios.store') }}">

		@include('users.form', ['user' => new App\User])

	</form>

@stop