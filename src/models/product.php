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

function delete_product(int $id, mysqli $_db) {
	$stm = $_db->prepare("DELETE FROM Products WHERE id=?");
	if($stm !== false) {
		$stm->bind_param("i", $id);
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}

function id_get_product(int $id, mysqli $_db) {
	$stm = $_db->prepare("SELECT * FROM Products WHERE id=?");
	if($stm !== false) {
		$stm->bind_param("i", $id);
		if($stm->execute()) {
			$res = $stm->get_result();
			$prod = $res->fetch_assoc();
			return $prod ?? false;
		}
	}
	error_log($_db->error);
	return false;
}

function get_products(int $offset, int $limit, mysqli $_db) {
	$stm = $_db->prepare("SELECT * FROM Products LIMIT ?, ?");
	if($stm !== false) {
		$stm->bind_param("ii", $offset, $limit);
		if($stm->execute()) {
			$res = $stm->get_result();
			$products = [];
			while($row = $res->fetch_assoc())
				array_push($products, $row);
			return $products;
		}
	}
	error_log($_db->error);
	return false;
}

function update_product(Product $prod mysqli $_db) {
	$stm = $_db->prepare(
		"UPDATE Products SET 
			name=?, description=?, 
			price=?, category=?, stock=? 
		WHERE id=?"); 
	if($stm !== false) {
		$stm->bind_param("ssdiii", 
			$prod->name, 
			$prod->description,
			$prod->price,
			$prod->category,
			$prod->stock,
			$prod->id);
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}

function change_image(int $id, string $image, mysqli $_db) {
	$stm = $_db->prepare("UPDATE Products SET image=? WHERE id=?");
	if($stm !== false) {
		$stm->bind_param("si", $image, $id);
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}
