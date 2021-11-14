<?php
if(!isset($_SESSION['uid']))
	header("Location: /login");
$selection = $_GET['s'] ?? "";
$file = "components/$selection.php";
?>

<div class="container">
	<nav>
		<h1>Punto de venta</h1>
		<div class="opts">
			<a href="?s=cambiarContraseña">Cambiar contraseña</a>
			<a href="/logout">Cerrar sesión</a>
		</div>
	</nav>

	<aside>
		<a href="?s=productos">Productos</a>
		<a href="?s=categorias">Categorias</a>
		<a href="?s=transacciones">Transacciones</a>
		<a href="?s=ventas">Ventas</a>
		<a href="?s=carrito">Carrito</a>
	</aside>

	<main id="main">
	<?php 
	if(file_exists($file))
		require_once $file;
	?>
	</main>
</div>

<style>
	nav {
		background: blue;
		color: white;
		display: flex;
		flex-flow: row nowrap;
	}

	nav > h1 {
		margin-left: 1em;
	}

	.opts {
		flex: 1 1 auto;
		display: flex;
		flex-flow: row-reverse nowrap;
	}

	.opts {
		
	}
</style>
