<?php
$app->load("Categorias");

$cat_id = $_GET['id'] ?? 0;
$category = $app->module->categoria($cat_id);
print_r($category);

if($category): ?>

<div class="container">
	<h1>Categoria</h1>
	<div class="catg" catg_color="<?= $category["color"] ?>">
		<h2><?= $category["name"] ?></h2>
		<p><?= htmlentities($category["description"]) ?></p>
	</div>
	<div>
		<a class="btn secondary" href="?s=editCategory&id=<?= $cat_id ?>">Editar</a>
		<a class="btn danger" href="?s=categorias&id=<?= $cat_id ?>&a=delete">Eliminar</a>
	</div>
</div>

<?php else: ?>

<div>Categoria no encontrada</div>

<?php endif; ?>
