<?php 
require_once "models/category.php";

$app->load("Categorias");
$categ_id = $_GET["id"] ?? 0;

if(isset($_GET['a'])) {
	$n_catg = new Model\Category(
		$_POST["name"] ?? "",
		$_POST["description"] ?? "",
		$_POST["color"] ?? "",
		$categ_id);
	$err = $app->module->actualizar($n_catg);
}

$category = $app->module->categoria($categ_id);
if($category):
?>

<h1>Editar categoria</h1>

<form enctype="multipart/form-data" method="POST" 
	  action="?s=editCategoria&id=<?= $categ_id ?>&a=edit">
	<div class="field">
		<label>Nombre</label>
		<input type="text" required name="name" 
			   value="<?= $category["name"] ?>"/>
	</div>

	<div class="field">
		<label>Descripcion</label>
		<textarea name="description" required><?= $category["description"] ?></textarea>
	</div>
	
	<div class="field">
		<label>Color</label>
		<input type="color" name="color" required value="<?= $category["color"] ?>"/>
	</div>

	<div class="field">
		<button>Guardar</button>
	</div>
</form>
<?php else: ?>
<div>Categoria no encontrada</div>
<?php endif; ?>
