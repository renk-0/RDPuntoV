<?php
$app->load("Productos");

$producto_id = $_GET['id'] ?? 0;
$producto = $app->module->producto($producto_id);
if($producto): ?>
<div class="container">
	<div class="title">
		<h1><?= htmlentities($producto["name"]) ?></h1>
		<span class="categ" cat_color="#<?= $producto["color"] ?>">
			<?= $producto["category"] ?>
		</span>
	</div>
	<div class="image">
		<img src="/public/images/<?= $producto["image"] ?>" />
		<button>Cambiar</button>
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
