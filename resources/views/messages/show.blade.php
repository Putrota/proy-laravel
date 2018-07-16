@extends('layout')

@section('contenido')

	<h1>Mensaje</h1>

	<table class="table">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nombre</th>
				<th>Email</th>
				<th>Mensaje</th>
			</tr>
		</thead>

		<tbody>			

			<tr>
				<td>{{ $message->id }}</td>
				<td>{{ $message->present()->userName() }}</td>
				<td>{{ $message->present()->userEmail() }}</td>
				<td>{{ $message->mensaje }}</td>
			</tr>
			
		</tbody>
	</table>

@stop