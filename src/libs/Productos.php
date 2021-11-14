<?php namespace Core;
require_once "libs/core.php";
require_once "libs/mysql.php";
require_once "models/product.php";
use Model;
use DateTime;

class Productos extends Module {
	public App $app;
	public Connection $conn;
	public DAO $dao;

	function __construct(App $app) {
		parent::__construct($app);
		$this->dao = new DAO("Products", $this->conn);
	}

	function leer() {
		$res = $this->conn->query(
			"SELECT p.*, c.color, c.name AS category FROM Products AS p 
			INNER JOIN Categories AS c ON p.category = c.id", null, []);
		$data = [];
		while($row = $res->fetch_assoc())
			array_push($data, $row);
		return $data;
	}

	function producto(int $id) {
		$res = $this->conn->query(
			"SELECT p.*, c.color, c.name AS category FROM Products AS p 
			INNER JOIN Categories AS c WHERE p.id=?", "i", $id);
		$producto = $res->fetch_assoc();
		return $producto;
	}

	function crear(Model\Product $producto, string $file) {
		if(empty($producto->name))
			return "Nombre vacio";
		if(!isset($_FILES[$file]))
			return "Sin imagen";
		if($_FILES[$file]["error"] != 0)
			return "Error numero $_FILES[$file][error] al subir la imagen";
		
		$now = new DateTime();
		$now = $now->getTimestamp();
		$producto->image = $_FILES[$file]["name"] . $now;
		$producto->image = md5($producto->image);
		$path = "./public/images/$producto->image";
		if(move_uploaded_file($_FILES[$file]["tmp_name"], $path)) {
			$added = $this->dao->addObject($producto, 
				["name", "description", "image", "price", "category", "stock"]);
			if($added)
				return false;
			unlink($path);
			return "Error al crear el usuario";
		}
		return "Error al subir la imagen";
	}

	function eliminar(int $product) {
		$producto = $this->producto($product);
		if($producto) {
			unlink("public/images/$producto[image]");
			return $this->dao->deleteBy("id", $product);
		}
		return false;
	}

	function actualizar(Model\Product $producto) {
		if(empty($producto->name))
			return "Nombre vacio";
		$updated = $this->dao->updateObject($producto->id, "id",
			$producto,	["name", "description", "price", "category", "stock"]);
		if($updated)
			return false;
		return "Error al actualizar el producto";
	}

	function cambiarImagen(int $id, string $file) {
		if(!isset($_FILES[$file]))
			return "Sin imagen";
		if($_FILES[$file]["error"] != 0) {
			$err = $_FILES[$file]["error"];
			return "Error numero $err al subir la imagen";
		}
		
		$now = new DateTime();
		$now = $now->getTimestamp();
		$image_name = $_FILES[$file]["name"] . $now;
		$image_name = md5($image_name);
		$path = "./public/images/$image_name";
		if(move_uploaded_file($_FILES[$file]["tmp_name"], $path)) {
			$old = $this->producto($id);
			if($old) {
				$updated = $this->dao->updateValue($id, "id", $image_name, "image"); 
				// Si se subio la imagen entonces eliminamos la anterior
				if($updated) {
					unlink("./public/images/$old[image]");
					return false;
				}
				unlink($path);
				return "Error cambiar la imagen";
			}
			return "No existe el producto";
		}
		return "Error al subir la imagen";
	}
}
