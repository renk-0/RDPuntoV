<?php namespace Common;
use mysqli;

function __init(bool $dev) {
	ini_set("display_errors", $dev);
	ini_set("display_startup_errors", $dev);
	error_reporting(E_ALL);
	session_start();

	$config = json_decode(file_get_contents("../../.env.json"));
	foreach($config as $k => $v) 
		$_ENV[$k] = $v;
}

class Module {
	public App $app;
	public mysqli $_db;

	function __construct(App $app, mysqli &$mysql_ref) {
		$this->app =& $app;
		$this->_db = $mysql_ref;
	}

	public function perform(string $opt) {}
}

class App {
	private mysqli $_db;
	public Module $module;

	function __construct() {
		$this->_db = new mysqli(
			$_ENV["host"],
			$_ENV["user"],
			$_ENV["password"],
			$_ENV["database"],
			$_ENV["port"]);
		if($this->_db->connect_errno != 0)
			error_log($this->db->connect->error);
	}

	function load_module($mod_name) {
		$file = "./modules/mod-$mod_name.php";
		if(file_exists($file)) {
			require_once $file;
			$this->module = new $mod_name($this, $this->_db);
		} else 
			echo "El modulo no existe";
	}
}
