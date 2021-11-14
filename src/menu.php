<?php
if(!isset($_SESSION['uid']))
	header("Location: /login");
$selection = $_GET['s'] ?? "";
$file = "components/$selection.php";
?>

<div class="body-grid">
	<nav>
		<h1>Punto de venta</h1>
		<div class="opts">
			<a href="?s=cambiarContraseña" 
			   title="Cambiar contraseña">
				<img src="/public/icons/key.svg" />
			</a>
			<a href="/logout"
			   title="Cerrar sesión">
				<img src="/public/icons/logout.svg">
			</a>
		</div>
	</nav>

	<aside>
		<a href="?s=productos">
			<img src="/public/icons/barcode.svg" />
			<span>Productos</span>
		</a>
		<a href="?s=categorias">
			<img src="/public/icons/tags.svg" />
			<span>Categorias</span>
		</a>
		<a href="?s=transacciones">
			<img src="/public/icons/ticket.svg" />
			<span>Transacciones</span>
		</a>
		<a href="?s=ventas">
			<img src="/public/icons/report.svg" />
			<span>Ventas</span>
		</a>
		<a href="?s=carrito">
			<img src="/public/icons/cart.svg" />
			<span>Carrito</span>
		</a>
	</aside>

	<main id="main">
	<?php 
	if(file_exists($file))
		require_once $file;
	?>
	</main>
</div>

<style>
	#main > form {
		margin-left: 80px;
		max-width: 400px;
	}

	#main > form input[type="text"], 
	#main > form input[type="password"],
	#main > form input[type="file"],
	#main > form input[type="number"],
	#main > form textarea {
		width: 100%;
	}
</style>

<style>
	.body-grid {
		width: 100%;
		height: 100%;
		display: grid;
		grid-template: 
				"nav	nav" 80px
				"aside	main" auto / 250px 1fr;
	}

	main {
		grid-area: main;
		overflow: auto;
		padding: 20px;
	}
</style>

<style>
	/*
	 * Barra de la izquierda
	 * */
	aside {
		grid-area: aside;
		background-color: lightblue;
		display: flex;
		flex-flow: column nowrap;
		z-index: 10;
		overflow: auto;
	}

	aside a {
		padding: 10px;
		color: inherit;
		text-decoration: none;	
		justify-self: center;
		display: flex;
		transition: all 0.1s ease-in-out;
	}
	
	aside a:hover {
		background-color: rgba(255, 255, 255, 40%);
	}
	
	aside a > img + span {
		margin-left: 10px;
	}
</style>

<style>
	/* 
     * Barra de navegación
	 * */
	nav {
		background: blue;
		color: white;
		display: flex;
		flex-flow: row nowrap;
		grid-area: nav;
		z-index: 10;
	}

	nav > h1 {
		margin-left: 1em;
		align-self: center;
	}

	.opts {
		flex: 1 1 auto;
		display: flex;
		flex-flow: row-reverse nowrap;
		align-items: center;
	}

	.opts a {
		margin: 0 5px; 
		border-radius: 5px;
		transition: all 0.1s ease-in-out;
	}

	.opts a:hover {
		background-color: rgba(250, 250, 250, 15%);
	}

	.opts a img {
		height: 30px;
		padding: 10px;
	}
</style>
