<?php 
require_once "models/product.php";

$app->load("Categorias");
$categorias = $app->module->leer();

$app->load("Productos");
if(isset($_GET['a'])) {
	$producto = new Model\Product(
		$_POST["name"] ?? "",
		$_POST["description"] ?? "", "",
		$_POST["price"] ?? 0,
		$_POST["category"] ?? 1,
		$_POST["stock"] ?? 0);
	$error = $app->module->crear($producto, "product");
}
?>

<?php if(isset($error)): ?>
	<?php if($error): ?>
	<div><?= $error ?></div>
	<?php else: ?>
	<div>Producto creado correctamente</div>
	<?php endif; ?>
<?php endif; ?>

<h1>Nuevo producto</h1>

<form enctype="multipart/form-data" method="POST" action="?s=crearProducto&a=add">
	<div class="field">
		<label>Imagen</label>
		<input type="file" name="product" required accept="image/*"/>
	</div>

	<div class="field">
		<label>Nombre</label>
		<input type="text" required name="name"/>
	</div>

	<div class="field">
		<label>Descripcion</label>
		<textarea name="description" required></textarea>
	</div>
	
	<div class="field">
		<label>Precio</label>
		<input type="number" required name="price" step="0.001"/>
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
		<button>Crear</button>
	</div>
</form>
