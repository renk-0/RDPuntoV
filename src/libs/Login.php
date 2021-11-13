<?php namespace Core;
require_once "libs/core.php";
require_once "libs/mysql.php";
require_once "models/users.php";
use Model;
use DateTime;

class Login extends Module {
	public App $app;
	public Connection $conn;
	public DAO $dao;

	function __construct(App $app) {
		parent::__construct($app);
		$this->dao = new DAO("Users", $this->conn);
	}

	function login(string $name, string $pass) {
		$user = $this->dao->selectBy("name", $name)[0] ?? false;
		if($user !== false) {
			$verif = password_verify($pass, $user['password']);
			if($verif) {
				$_SESSION["uid"] = $user["id"];
				$_SESSION["role"] = $user["role"];
				$_SESSION["name"] = $user["name"];
			}
			return $verif;
		}
		return false;
	}

	function recovery(string $email) {
		$time = new DateTime();
		$npass = md5($time->getTimestamp());
		$npass = password_hash($npass, PASSWORD_BCRYPT);
		
		$ret = $this->dao->updateValue($email, "email", $npass, "password");
		mail(
			$email,
			"Cambio de contraseña",
			"Usted ha requerido un cambio de contraseña.\n" .
			"Su nueva contraseña es: $npass"
		);
		return $ret;
	}

	function change_pass(string $npass) {
		$npass = password_hash($npass, PASSWORD_BCRYPT);
		$ret = $this->dao->updateValue($_SESSION['uid'], "id", $npass, "password");
		return $ret;
	}
}
