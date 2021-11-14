<?php
$app->load("Categorias");

if(isset($_GET['a'])) {
	switch($_GET['a']) {
		case "delete":
			$cat_id = $_GET['id'] ?? 0;
			$app->module->eliminar($cat_id);
			break;
	}
}

$categorias = $app->module->leer();
print_r($categorias);
?>

<h1>Categorias</h1>
<a href="?s=crearCategoria" class="btn">Agregar categoria</a>

<div class="container">
<?php foreach($categorias as $categoria): ?>
	<div class="catg" catg_color="<?= $categoria["color"] ?>">
		<span><?= htmlentities($categoria["name"]) ?></span>
		<a href="?s=categoria&id=<?= $categoria['id'] ?>">Ver</a>
	<div>
<?php endforeach; ?>
</div>
