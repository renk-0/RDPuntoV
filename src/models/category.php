<?php

class Category {
	public int $id;
	public string $name;
	public string $description;
	public string $color;

	public function __construct(
		$name,
		$description,
		$color,
		$id = 0) 
	{
		$this->name = $name;
		$this->description = $description;
		$this->color = $color;
		$this->id = $id;
	}
}
