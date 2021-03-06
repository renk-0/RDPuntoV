<?php
$app->load("Productos");

$producto_id = $_GET['id'] ?? 0;
$producto = $app->module->producto($producto_id);
if($producto): ?>
<div class="container">
	<div class="product-title">
		<h1><?= htmlentities($producto["name"]) ?></h1>
		<span class="catg" catg_color="<?= $producto["color"] ?>">
			<span class="catg-name"><?= $producto["category"] ?></span>
		</span>
	</div>
	<div class="product-image">
		<img src="/public/images/<?= $producto["image"] ?>" />
	</div>
	<p>
		<b class="title">Precio: </b>
		<span><?= $producto["price"] ?></span>
	</p>
	<p>
		<b class="title">Stock: </b>
		<span><?= $producto["stock"] ?></span>
	</p>
	<p>
		<b class="title">Descripcion: </b>
		<span><?= $producto["description"] ?></span>
	</p>
	<div>
		<a class="btn secondary" href="?s=editProducto&id=<?= $producto_id ?>">Editar</a>
		<a class="btn danger" href="?s=productos&id=<?= $producto_id ?>&a=delete">Eliminar</a>
	</div>
</div>

<?php else: ?>

<div>Producto no encontrado</div>

<?php endif; ?>

<style>
.product-title {
	margin-bottom: 2em;
}

.product-image {
	width: 200px;
	height: 200px;
	overflow: hidden;
	display: flex;
	justify-content: center;
	border-radius: 5px;
}

</style>
