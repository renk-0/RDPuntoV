<?php 
require_once "models/product.php";

$app->load("Categorias");
$categorias = $app->module->leer();

$app->load("Productos");
$error = false;
if(isset($_GET['a'])) {
	$product_name = $_POST['name'] ?? "";
	if(!empty($product_name)) {
		if(isset($_FILES["product"])) {
			if($_FILES["product"]["error"] == 0) {
				$now = new DateTime();
				$now = $now->getTimestamp();
				$image_name = $_FILES["product"]["name"] . $now;
				$image_name = md5($image_name);
				$path = "./public/images/$image_name";
				if(move_uploaded_file($_FILES["product"]["tmp_name"], $path)) {
					$producto = new Model\Product(
						$product_name,
						$_POST["description"] ?? "",
						$image_name,
						$_POST["price"] ?? 0,
						$_POST["category"] ?? 1,
						$_POST["stock"] ?? 0);
					$app->module->crear($producto);
				} else
					$error = "Error al subir la imagen";
			} else
				$error = "Error numero $_FILES[product][error] al subir la imagen";
		} else
			$error = "Sin imagen";
	} else
		$error = "Nombre vacio";
}
echo $error;
?>

<h1>Nuevo producto</h1>

<form enctype="multipart/form-data" method="POST" action="?s=add_product&a=add">
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
