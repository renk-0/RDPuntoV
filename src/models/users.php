<?php namespace Model;

class User {
	public int $id;
	public string $name;
	public string $password;
	public string $role;
	public string $email;

	public function __construct(
		$name, 
		$password, 
		$role, 
		$email, 
		$id = 0)
	{
		$this->id = $id;
		$this->name = $name;
		$this->password = $password;
		$this->role = $role;
		$this->email = $email;
	}
}
