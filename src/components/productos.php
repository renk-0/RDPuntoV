<?php
$app->load("Productos");
$productos = $app->module->leer();

print_r($productos);
?>

<a href="?s=add_product" class="btn">Agregar producto</a>

<div class="container">
<?php foreach($productos as $producto): ?>
	<div>
		<span><?= htmlentities($producto["nombre"]) ?></span>
		<span><?= htmlentities($producto["price"]) ?></span>

	<div>
<?php endforeach; ?>
</div>
