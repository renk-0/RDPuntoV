<?php namespace Products;

use mysqli;

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

function add_product(Product $prod, mysqli $_db) {
	$stm = $_db->prepare(
		"INSERT INTO Products(name, description, 
			image, price, category, stock) 
			VALUES (?, ?, ?, ?, ?, ?)");
	if($stm !== false) {
		$stm->bind_param("sssdii", 
			$prod->name, 
			$prod->description,
			$prod->image,
			$prod->price,
			$prod->category,
			$prod->stock);
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}
