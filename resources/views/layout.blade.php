<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">

	<style type="text/css">
		
		.active {
			text-decoration: none;
			color: green;
		}

		.error {
			color: red;			
		}

	</style>

	<title>Mi sitio</title>
</head>
<body>

	<?php /* Esta función nos la proporciona Ilumitane/Http/Request

	// url actual
	{{ request()->url() }} 

	// Comprobar si estoy en una url
	{{ request()->is('/') ? 'Estás en el home' : 'No estás en el home' }}

	*/ 

	function activeMenu( $url )
	{

		return request()->is($url) ? 'active' : '';

	}

	?>	

	<header>
		<nav>
			<a class="{{ activeMenu('/') }}" href="{{ route('home') }}">Inicio</a>
			<a class="{{ activeMenu('saludo/*') }}" href="{{ route('saludos', 'Jorge') }}">Saludo</a>
			<a class="{{ activeMenu('mensajes/create') }}" href="{{ route('mensajes.create') }}">Contacto</a>
			
			@if ( auth()->guest() )
				<a class="{{ activeMenu('login') }}" href="/login">Login</a>
			@endif

			@if (auth()->check())
				<a class="{{ activeMenu('mensajes') }}" href="{{ route('mensajes.index') }}">Mensajes</a>
				<a href="/logout">Cerrar sesión de {{ auth()->user()->name }}</a>
			@endif
		</nav>
	</header>	

	@yield('contenido')

	<footer>Copyright {{ date('Y') }}</footer>

</body>
</html>