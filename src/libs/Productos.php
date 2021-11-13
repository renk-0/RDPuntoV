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
			INNER JOIN Categories AS c", null, []);
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

	function crear(Model\Product $producto) {
		return $this->dao->addObject($producto, 
			["name", "description", "image", "price", "category", "stock"]);
	}
}
