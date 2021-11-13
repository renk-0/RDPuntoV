<?php namespace Core;
require_once "libs/core.php";
require_once "libs/mysql.php";
require_once "models/category.php";
use Model;
use DateTime;

class Categorias extends Module {
	public App $app;
	public Connection $conn;
	public DAO $dao;

	function __construct(App $app) {
		parent::__construct($app);
		$this->dao = new DAO("Categories", $this->conn);
	}

	function leer() {
		$categorias = $this->dao->selectAll();
		return $categorias;
	}
}
