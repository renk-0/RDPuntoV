<?php
require_once "common.php";
require_once "../models/users.php";
use Common\Module;
use Common\App;

class Login extends Module {
	public App $app;
	public mysqli $_db;

	public function __construct(App $app, mysqli &$mysql_ref) {
		parent::__construct($app, $mysql_ref);
	}

	public function perform(string $opt) {
		$_resp = [
			"module" => "Login",
			"date" => (new DateTime())->format(DATE_W3C),
			"request" => $opt
		];

		switch($opt) {
			case 'login':
				$_resp['return'] = $this->login(
					$_POST['name'] ?? "", 
					$_POST['pass'] ?? "");
				break;
			case 'chng_pass':
				$_resp['return'] = $this->change_password(
					$_POST['pass'] ?? "",
					$_POST['id'] ?? 0);
				break;
			case 'recovery':
				$_resp['return'] = $this->recover_pass(
					$_POST['mail'] ?? "");
				break;
		}

		echo json_encode($_resp);
	}

	public function login(string $name, string $pass) {
		$usr = Users\name_get_user($name, $this->_db);
		if($usr !== false) {
			if(password_verify($pass, $usr["password"])) {
				$_SESSION["uid"] = $usr["id"];
				$_SESSION["role"] = $usr["role"];
				unset($usr["password"]);
				return $usr;
			}
		}
		return false;
	}

	public function change_password(string $npass, int $uid) {
		$pass_hash = password_hash($npass, PASSWORD_BCRYPT);
		$ret = Users\id_update_pass($pass_hash, $uid, $this->_db);
		return $ret;
	}

	public function recover_pass(string $mail) {
		$now = new DateTime();
		$npass = md5($now->getTimestamp());
		$pass_hash = password_hash($npass, PASSWORD_BCRYPT);
		$ret = Users\email_update_pass($pass_hash, $mail, $this->_db);
		mail(
			$mail,
			"Contraseña olvidada!",
			"Su contraseña temporal es $npass"
		);
		return $ret;
	}
}
