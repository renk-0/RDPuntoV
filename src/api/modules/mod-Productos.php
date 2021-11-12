<?php
require_once "common.php";
require_once "../models/product.php";
use Common\Module;
use Common\App;

class Productos extends Module {
	public App $app;
	public mysqli $_db;

	public function __construct(App $app, mysqli &$mysql_ref) {
		parent::__construct($app, $mysql_ref);
	}

	public function perform(string $opt) {
		$_resp = [
			"module" => "Priductos",
			"date" => (new DateTime())->format(DATE_W3C),
			"request_fn" => $opt,
			"request" => $_POST,
			"return" => false
		];

		switch($opt) {
			case 'add_product':
				$name = $_POST['name'] ?? '';
				if(!empty($name)) {
					$prod = new Products\Product($name,
						$_POST['description'] ?? "",
						md5((new DateTime())->getTimestamp()),
						$_POST['price'] ?? 0,
						$_POST['category'] ?? 0,
						$_POST['stock'] ?? 0);
					$_resp['return'] = $this->add_product($prod);
				}
				break;
		}

		echo json_encode($_resp);
	}

	public function add_product(Products\Product $prod) {
		if(isset($_FILES['product'])) {
			if($_FILES['product']['error'] == UPLOAD_ERR_OK) {
				$file_path = "../public/$prod->image";
				$res = move_uploaded_file($_FILES['product']['tmp_name'], $file_path);
				if(!$res) {
					error_log("Error al movel el archivo");
					return false;
				}
				$res = Products\add_product($prod, $this->_db);
				if($res) {
					
				}
				return $res;
			}

			error_log("Error de subida de archivo " . $_FILES['product']['error']);
		}
		return false;
	}
}
