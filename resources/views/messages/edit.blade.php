@extends('layout')


@section('contenido')

	<h1>Editar mensaje {{ $message->nombre }}</h1>

	@if(session()->has('info'))
		<h3>{{ session('info') }}</h3>
	@else

		<form method="POST" action="{{ route('mensajes.update', $message->id) }}">

			{!! method_field('PUT') !!}

			@include('messages.form', [
				'btnText' => 'Actualizar',
				'showFields' => !$message->user_id
			])

		</form>
	@endif	

@stop