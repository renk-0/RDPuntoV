<?php
require_once "common.php";
require_once "../models/product.php";
use Common\Module;
use Common\App;

class Productos extends Module {
	public App $app;
	public mysqli $_db;
	public $details = ["module" => "Productos"];

	public function __construct(App $app, mysqli &$mysql_ref) {
		parent::__construct($app, $mysql_ref);
	}

	public function perform(string $opt) {
		$this->details["date"] = (new DateTime())->format(DATE_W3C);
		$this->details["request_fn"] = $opt;
		$this->details["request"] = $_POST;
		$this->details["return"] = false;

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
					$this->details['return'] = $this->add_product($prod);
					if($this->details['return']) {
						$trans = new Transactions\Transaction(
							"Producto creado",
							json_encode($this->details),
							$_SESSION['uid']);
						Transactions\add_transaction($trans, $this->_db);
					}
				}
				break;
		}

		echo json_encode($this->details);
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
				return $res;
			}

			error_log("Error de subida de archivo " . $_FILES['product']['error']);
		}
		return false;
	}
}
