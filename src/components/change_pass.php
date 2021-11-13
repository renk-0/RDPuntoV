<?php
$app->load("Login");
if(isset($_GET['a'])) {
	$pass = $_POST["pass"] ?? "";
	if(strlen($pass) > 7)
		$app->module->change_password($pass);
	else { ?>
<div class="message">La contraseña debe ser de minimo 8 caracteres</div>
<?php }?>
<h1>Cambiar contraseña</h1>
<form enctype="application/x-www-form-urlencoded" method="POST" action="?a=change_pass">
	<div class="field">
		<label>Nueva contraseña</label>
		<input type="password" name="pass"/>
	</div>

	<div class="field">
		<button>Enviar</button>
	</div>
</form>
