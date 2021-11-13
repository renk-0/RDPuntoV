<?php
$app->load("Productos");

$producto = $_GET['id'] ?? 0;
if()
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
		<a href="?s=producto&id=<?= $producto['id'] ?>">Editar</a>
	<div>
<?php endforeach; ?>
</div>
