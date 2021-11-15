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

	function categoria(int $id) {
		$ret = $this->dao->selectBy("id", $id);
		return $ret[0] ?? null;
	}

	function crear(Model\Category $categoria) {
		return $this->dao->addObject($categoria,
			["name", "description", "color"]);
	}
	
	function actualizar(Model\Category $category) {
		if(empty($category->name))
			return "Nombre vacio";
		if(strlen($category->color) != 7)
			return "El color no cumple con los requisitos";
		$updated = $this->dao->updateObject($category->id, "id",
			$category, ["name", "description", "color"]);
		if($updated)
			return false;
		return "Error al actualizar la categoria";
	}
	
	function eliminar(int $id) {
		return $this->dao->deleteBy("id", $id);
	}
}
