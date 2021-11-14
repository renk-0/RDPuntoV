<?php 
require_once "models/product.php";

$app->load("Categorias");
$categorias = $app->module->leer();

$app->load("Productos");
$prod_id = $_GET["id"] ?? 0;
if(isset($_GET['a'])) {
	switch($_GET['a']) {
		case "img":
			$err = $app->module->cambiarImagen($prod_id, "product");
			echo $err;
			break;
		case "data":
			$prod = new Model\Product(
				$_POST["name"] ?? "",
				$_POST["description"] ?? "", "",
				$_POST["price"] ?? 0,
				$_POST["category"] ?? 1,
				$_POST["stock"] ?? 0,
				$prod_id);
			$err = $app->module->actualizar($prod);
			break;
	}
}

$producto = $app->module->producto($prod_id);
if($producto):
?>

<h1>Editar producto</h1>

<div id="image">
	<h2>Imagen</h2>
	<img src="/public/images/<?= $producto["image"] ?>" />
	<form enctype="multipart/form-data" method="POST" 
		  action="?s=editProducto&a=img&id=<?= $prod_id ?>">
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
	<form enctype="multipart/form-data" method="POST" 
		  action="?s=editProducto&id=<?= $prod_id ?>&a=data">
		<div class="field">
			<label>Nombre</label>
			<input type="text" required name="name" 
				   value="<?= $producto["name"] ?>"/>
		</div>

		<div class="field">
			<label>Descripcion</label>
			<textarea name="description" required><?= $producto["description"] ?></textarea>
		</div>
		
		<div class="field">
			<label>Precio</label>
			<input type="number" required 
				   name="price" 
				   step="0.001" 
				   value="<?= $producto["price"] ?>"/>
		</div>
		
		<div class="field">
			<label>Categoria</label>
			<select name="category" required value="<?= $producto["category"] ?>">
				<?php foreach($categorias as $categoria) { ?>
					<option value="<?= $categoria['id'] ?>">
						<?= htmlentities($categoria['name']) ?>
					</option>
				<?php } ?>
			</select>
		</div>
		
		<div class="field">
			<label>Stock</label>
			<input type="number" required 
				   name="stock" step="1"
				   value="<?= $producto["stock"] ?>" />
		</div>

		<div class="field">
			<button>Guardar</button>
		</div>
	</form>
</div>
<?php else: ?>
<div>Producto no encontrado</div>
<?php endif; ?>
