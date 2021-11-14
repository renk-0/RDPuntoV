<?php
$app->load("Login");
$changed = false;
if(isset($_SESSION['uid']))
	header("Location: /menu");

if(isset($_GET['a'])) {
	$email = $_POST['email'] ?? "";
	$changed = $app->module->recovery($email);
}
?>
<main class="container">
	<?php if($changed): ?>
		<div>La contraseña ha sido cambiada con exito</div>
	<?php endif; ?>
	<h1>Recuperar contraseña</h1>
	<form enctype="application/x-www-form-urlencoded" method="POST" action="?a=recovery">
		<div class="field">
			<label>Correo</label>
			<input type="mail" name="email"/>
		</div>

		<div class="field">
			<button>Enviar</button>
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
