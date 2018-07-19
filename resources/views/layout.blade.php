<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">	
	<link rel="stylesheet" type="text/css" href="/css/app.css">

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
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
			<a class="navbar-brand" href="#">Navbar</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item {{ activeMenu('/') }}">						
						<a class="nav-link" href="{{ route('home') }}">Inicio <span class="sr-only">(current)</span></a>
					</li>					

					<li class="nav-item {{ activeMenu('saludo/*') }}">	
						<a class="nav-link" href="{{ route('saludos', 'Jorge') }}">
							Saludo</a>
						</li>

					<li class="nav-item {{ activeMenu('mensajes/create') }}">	
						<a class="nav-link" href="{{ route('mensajes.create') }}">
							Contacto</a>
						</li>

					@if ( auth()->guest() )
						<li class="nav-item {{ activeMenu('login') }}">
							<a class="nav-link" href="/login">Login</a></li>
					@endif

					@if (auth()->check())

						<li class="nav-item {{ activeMenu('mensajes*') }}">
							<a class="nav-link" href="{{ route('mensajes.index') }}">Mensajes</a>
						</li>

						@if (auth()->user()->hasRoles(['admin']))							

							<li class="nav-item {{ activeMenu('usuarios*') }}">
								<a class="nav-link" href="{{ route('usuarios.index') }}">
									Usuarios
								</a>
							</li>

						@endif

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								{{ auth()->user()->name }}
							</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
								<a class="dropdown-item" href="/usuarios/{{ auth()->id() }}/edit">Mi cuenta</a>
								<a class="dropdown-item" href="/logout">Cerrar sesión</a>
							</div>
						</li>
					@endif

				</ul>
				
			</div>
		</nav>
	</header>
	
	<div class="container">

		@yield('contenido')

	</div>

	<footer>Copyright {{ date('Y') }}</footer>

	
	<script type="text/javascript" src="/js/app.js" ></script>
</body>
</html>