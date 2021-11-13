<?php
require_once "common.php";
require_once "../models/product.php";
use Common\Module;
use Common\App;

class Basket extends Module {
	public App $app;
	public mysqli $_db;
	public $details = ["module" => "Basket"];

	public function __construct(App $app, mysqli &$mysql_ref) {
		parent::__construct($app, $mysql_ref);
	}

	public function perform(string $opt) {
		$this->details["date"] = (new DateTime())->format(DATE_W3C);
		$this->details["request_fn"] = $opt;
		$this->details["request"] = $_POST;
		$this->details["return"] = false;
		
		if(isset($_SESSION['uid'])) {
			switch($opt) {
				case '':
					break;
			}
		}

		echo json_encode($this->details);
	}
	

}

