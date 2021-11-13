<?php
$app->load("Productos");

$producto_id = $_GET['id'] ?? 0;
$producto = $app->module->producto($producto_id);
print_r($producto);
if($producto): ?>

<h1></h1>
<div class="container">
	<h1><?= htmlentities($producto["name"]) ?></h1>
	<img src="" />
</div>

<?php else: ?>

<div>Producto no encontrado</div>

<?php endif; ?>
