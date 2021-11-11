<?php
class User {
	public int $id;
	public string $name;
	private string $password;
	public string $role;

	public function __construct($name, $password, $role, $id = 0)
	{
		$this->id = $id;
		$this->name = $name;
		$this->password = $password;
		$this->role = $role;
	}

	public function __get_password() {
		return $this->password;
	}
}
