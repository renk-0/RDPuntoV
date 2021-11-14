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

<div class="product-container">
<?php foreach($productos as $producto): ?>
	<div class="product">
		<span class="name"><?= htmlentities($producto["name"]) ?></span>
		<span class="precio">$<?= $producto["price"] ?></span>
		<span class="catg" catg_color="<?= $producto['color'] ?>">
			<span class="catg-name"><?= htmlentities($producto["category"]) ?></span>
		</span>
		<a class="btn secondary" href="?s=producto&id=<?= $producto['id'] ?>">Ver</a>
	</div>
<?php endforeach; ?>
</div>

<style>
	.product-container {
		display: flex;
		flex-flow: column nowrap;
	}

	.product-container .product {
		padding: 10px;
		display: flex;
		flex-flow: row nowrap;
		align-items: center;
	}
		
	.product button, .product .btn {
		margin: 0 0 0 auto;
	}
	
	.product span + span {
		margin-left: 1em;
	}

	.product .precio {
		color: gray;
	}

	.product-container .product + .product {
		border-top: 1px solid lightgray;
	}
<style>
