<?php namespace Users;
use mysqli;

// Get user by ID
function id_get_user(int $id, mysqli $_db) {
	$stm = $_db->prepare("SELECT * FROM Users WHERE id=?");
	if($stm) {
		$stm->bind_param("i", $id);
		if($stm->execute()) {
			$res = $stm->get_result();
			$usr = $res->fetch_assoc();
			return $usr ?? false;
		}
	}
	error_log($_db->error);
	return false;
}

// Get user by its name 
function name_get_user(string $name, mysqli $_db) {
	$stm = $_db->prepare("SELECT * FROM Users WHERE name=?");
	if($stm) {
		$stm->bind_param("s", $name);
		if($stm->execute()) {
			$res = $stm->get_result();
			$usr = $res->fetch_assoc();
			return $usr ?? false;
		}
	}
	error_log($_db->error);
	return false;
}

function id_update_pass(string $npass, int $id, mysqli $_db) {
	$stm = $_db->prepare("UPDATE Users SET password=? WHERE id=?");
	if($stm) {
		$stm->bind_param("si", $npass, $id); 
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}

function email_update_pass(string $npass, string $email, mysqli $_db) {
	$stm = $_db->prepare("UPDATE Users SET password=? WHERE email=?");
	if($stm) {
		$stm->bind_param("ss", $npass, $email); 
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}


/*


function id_update_user(User $usr, mysqli $_db) {
	$stm = $_db->prepare("UPDATE Users SET name=?, password=?, role=? WHERE id=?");
	if($stm) {
		$stm->bind_param("ssii", $usr->name, $usr->getPassword(), $usr->role, $usr->id);
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}

class User {
	public int $id;
	public string $name;
	private string $password;
	public string $role;

	public function __construct(
		$name, 
		$password, 
		$role, 
		$id = 0)
	{
		$this->id = $id;
		$this->name = $name;
		$this->password = $password;
		$this->role = $role;
	}

	public function __getPassword() {
		return $this->password;
	}
}

 */
