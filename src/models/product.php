<?php namespace Models;

class Product {
	public int $id;
	public string $name;
	public string $description;
	public string $image;
	public float $price;
	public int $category;
	public int $stock;

	public function __construct(
		$name,
		$description,
		$image,
		$price,
		$category,
		$stock,
		$id = 0)
	{
		$this->name = $name;
		$this->description = $description;
		$this->image = $image;
		$this->price = $price;
		$this->category = $category;
		$this->stock = $stock;
		$this->id = $id;
	}
}
