<?php 
require_once "models/product.php";

$app->load("Categorias");
$categorias = $app->module->leer();

$app->load("Productos");
if(isset($_GET['a'])) {
}

$prod_id = $_GET["id"] ?? 0;
$producto = $app->module->producto($prod_id);
if($producto):
?>

<h1>Editar producto</h1>

<div id="image">
	<h2>Imagen</h2>
	<img src="/public/images/<?= $producto["image"] ?>" />
	<form enctype="multipart/form-data" method="POST" action="?s=editProducto&a=img">
		<div class="field">
			<input type="file" accept="image/*" name="product" />
		</div>
		<div class="field">
			<button>Guardar</button>
		</div>
	</form>
</div>
<div id="data">
	<h2>Datos</h2>
	<form enctype="multipart/form-data" method="POST" action="?s=crearProducto&a=add">
		<div class="field">
			<label>Nombre</label>
			<input type="text" required name="name" value="<?= $producto["name"] ?>"/>
		</div>

		<div class="field">
			<label>Descripcion</label>
			<textarea name="description" required><?= $producto["description"] ?></textarea>
		</div>
		
		<div class="field">
			<label>Precio</label>
			<input type="number" required name="price" step="0.001" value="<?= $producto["price"] ?>"/>
		</div>
		
		<div class="field">
			<label>Categoria</label>
			<select name="category" required>
				<?php foreach($categorias as $categoria) { ?>
					<option value="<?= $categoria['id'] ?>">
						<?= htmlentities($categoria['name']) ?>
					</option>
				<?php } ?>
			</select>
		</div>
		
		<div class="field">
			<label>Stock</label>
			<input type="number" required name="stock" step="1"/>
		</div>

		<div class="field">
			<button>Guardar</button>
		</div>
	</form>
</div>
<?php else: ?>
<div>Producto no encontrado</div>
<?php endif; ?>
