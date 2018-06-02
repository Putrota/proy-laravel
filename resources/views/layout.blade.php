<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">

	<title>Mi sitio</title>
</head>
<body>

	<header>
		<nav>
			<a href="<?=route('home')?>">Inicio</a>
			<a href="<?=route('saludos', 'Jorge')?>">Saludo</a>
			<a href="<?=route('contactos')?>">Contacto</a>
		</nav>
	</header>	

	@yield('contenido')

	<footer>Copyright {{ date('Y') }}</footer>

</body>
</html>