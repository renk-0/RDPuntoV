<?php namespace Core;
require_once "libs/mysql.php";

function __init() {
	error_reporting(E_ALL);
	session_start();

	$config = json_decode(file_get_contents("../.env.json"));
	foreach($config as $k => $v) 
		$_ENV[$k] = $v;
}

class Module {
	public App $app;
	public Connection $conn;

	function __construct(App $app) {
		$this->app =& $app;
		$this->conn =& $app->connection;
	}
}

class App {
	public Connection $connection;
	public Module $module;

	function __construct() {
		$this->connection = new Connection();
		if($this->connection->__getConnErrno() != 0)
			error_log("Error de conexion");
	}

	function load($module) {
		$file = "libs/$module.php";
		if(file_exists($file)) {
			require_once $file;
			$class = "Core\\$module";
			$this->module = new $class($this);
		} else 
			echo "El modulo no existe";
	}
}
