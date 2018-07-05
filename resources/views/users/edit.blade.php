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
			
			@include('users.form', ['btnText' => 'Actualizar'])

	</form>
	
@stop