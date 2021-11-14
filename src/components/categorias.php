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
?>

<h1>Categorias</h1>
<a href="?s=crearCategoria" class="btn">Agregar categoria</a>

<div class="container">
<?php foreach($categorias as $categoria): ?>
	<div class="catg" catg_color="<?= $categoria["color"] ?>">
		<span class="catg-name"><?= htmlentities($categoria["name"]) ?></span>
		<a class="btn secondary" href="?s=categoria&id=<?= $categoria['id'] ?>">Ver</a>
	</div>
<?php endforeach; ?>
</div>

<style>
.catg + .catg {
	margin-top: 1em;
}

.container {
	margin-top: 1em;
}

.catg {
	display: flex;
	align-items: center;
	flex: row nowrap;
	padding: 10px;
}

.catg .btn {
	margin-left: auto;
	margin-bottom: 0;
}
</style>
