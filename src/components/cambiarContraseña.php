<?php
$app->load("Login");
if(isset($_GET['a'])) {
	$pass = $_POST["pass"] ?? "";
	if(strlen($pass) > 7)
		$err = $app->module->change_pass($pass);
	else 
		$err = "La contraseña debe tener minimo 8 caracteres";
} 

if(isset($err)): ?>

	<div class="message"> <?= $err ?></div>

<?php endif; ?>

<h1>Cambiar contraseña</h1>
<form enctype="application/x-www-form-urlencoded" 
	  method="POST" action="?s=cambiarContraseña&a=cambiar">
	<div class="field">
		<label>Nueva contraseña</label>
		<input type="password" name="pass"/>
	</div>

	<div class="field">
		<button>Guardar</button>
	</div>
</form>
