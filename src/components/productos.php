<?php
$app->load("Productos");

if(isset($_GET['a'])) {
	switch($_GET['a']) {
		case "delete":
			$prod_id = $_GET['id'] ?? 0;
			$app->module->eliminar($prod_id);
			break;
	}
}

$productos = $app->module->leer();
?>

<h1>Productos</h1>
<a href="?s=crearProducto" class="btn">Agregar producto</a>

<div class="container">
<?php foreach($productos as $producto): ?>
	<div>
		<span><?= htmlentities($producto["name"]) ?></span>
		<span><?= $producto["price"] ?></span>
		<span class="categories" style="background-color:#<?= $producto['color'] ?>">
			<?= htmlentities($producto["category"]) ?>
		</span>
		<a href="?s=producto&id=<?= $producto['id'] ?>">Ver</a>
	<div>
<?php endforeach; ?>
</div>
