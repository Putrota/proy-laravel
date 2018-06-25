@extends('layout')


@section('contenido')
	<h1>Login</h1>

	<form class="form-inline" method="POST" action="/login" >

		{!! csrf_field() !!}
	
		<div class="form-group" >
			<input type="email" name="email" placeholder="email">
		</div>
		<div class="form-group" >
			<input type="password" name="password" placeholder="password">
		</div>
		<input class="btn btn-primary" type="submit" value="entrar">
	</form>
@stop