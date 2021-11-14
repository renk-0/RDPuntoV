<?php
$app->load("Login");

if(isset($_SESSION['uid']))
	header("Location: /menu");

if(isset($_GET['a'])) {
	$user = $_POST['name'] ?? "";
	$pass = $_POST['pass'] ?? "";
	$logged = $app->module->login($user, $pass);
	if($logged)
		header("Location: /menu");
}
?>

<main class="container">
	<form action="?a=login" method="POST" 
		  enctype="application/x-www-form-urlencoded">
		<h1>Iniciar Sesión</h1>
		<div class="field">
			<label>Usuario</label>
			<input type="text" required name="name"/>
		</div>

		<div class="field">
			<label>Contraseña</label>
			<input type="password" required name="pass"/>
		</div>
		
		<div class="field">
			<a href="/forgot">¿Olvidaste tu contraseña?</a>
		</div>

		<div class="field">
			<button>Entrar</button>
		</div>
	</form>
</main>

<style>
	.container {
		margin: auto;
		width: fit-content;
		padding: 20px;
	}
</style>
