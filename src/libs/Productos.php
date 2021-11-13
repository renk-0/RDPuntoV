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
		$productos = $this->dao->selectAll();
		return $productos;
	}

	function crear(Model\Product $producto) {
		print_r($producto);
		return false;
	}

}
