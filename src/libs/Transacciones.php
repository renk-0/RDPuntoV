<?php namespace Core;
require_once "libs/core.php";
require_once "libs/mysql.php";
require_once "models/transaction.php";
use Model;
use DateTime;

class Categorias extends Module {
	public App $app;
	public Connection $conn;
	public DAO $dao;

	function __construct(App $app) {
		parent::__construct($app);
		$this->dao = new DAO("Transactions", $this->conn);
	}

	function leer() {
		$categorias = $this->dao->selectAll();
		return $categorias;
	}

	function transaccion(int $id) {
		$ret = $this->dao->selectBy("id", $id);
		return $ret[0] ?? null;
	}

	function crear(Model\Category $categoria) {
		return $this->dao->addObject($categoria,
			["name", "description", "color"]);
	}
}

