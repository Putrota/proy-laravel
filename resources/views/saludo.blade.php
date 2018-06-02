@extends('layout')


@section('contenido')

	<h1>Saludos para {{ $nombre }}</h1>

	<ul>
		@foreach($naruto_amigos as $amigo)
			<li> {{ $amigo }} </li>
		@endforeach
	</ul>

	<ul>
		@forelse($naruto_enemigos as $enemigo)
			<li> {{ $enemigo }} </li>
		@empty
			<li>No hay enemigos</li>
		@endforelse
	</ul>

	@if(count($naruto_amigos) == 3)
		<p>Tienes 3 amigos</p>
	@elseif( false )
	@else
	@endif
	
@stop