<?php 
require_once "models/category.php";

$app->load("Categorias");
if(isset($_GET['a'])) {
	$categoria = new Model\Category(
		$_POST["name"] ?? "",
		$_POST["description"] ?? "",
		$_POST["color"] ?? "");
	$error = $app->module->crear($categoria);
}
?>

<?php if(isset($error)): ?>
	<?php if($error): ?>
		<div><?= $error ?></div>
	<?php else: ?>
		<div>Categoria creada correctamente</div>
	<?php endif; ?>
<?php endif; ?>

<h1>Nuevo producto</h1>

<form enctype="application/x-www-form-urlencoded" method="POST" 
	  action="?s=crearCategoria&a=add">
	<div class="field">
		<label>Nombre</label>
		<input type="text" required name="name"/>
	</div>

	<div class="field">
		<label>Descripcion</label>
		<textarea name="description" required></textarea>
	</div>
	
	<div class="field">
		<label>Color</label>
		<input type="color" name="color" required />
	</div>

	<div class="field">
		<button>Crear</button>
	</div>
</form>
