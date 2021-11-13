<?php namespace Categories;
use mysqli;

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

function get_category(int $id, mysqli $_db) {
	$stm = $_db->prepare("SELECT * FROM Categories WHERE id=?");
	if($stm !== false) {
		$stm->bind_param("i", $id);
		if($stm->execute()) {
			$res = $stm->get_result();
			$catg = $res->fetch_assoc();
			return $catog ?? false;
		}
	}
	error_log($_db->error);
	return false;	
}

function categories(int $offset, int $limit, mysqli $_db) {
	$stm = $_db->prepare("SELECT * FROM Categories LIMIT ?, ?");
	if($stm !== false) {
		$stm->bind_param("ii", $offset, $limit);
		if($stm->execute()) {
			$res = $stm->get_result();
			$catg = [];
			while($row = $res->fetch_assoc())
				array_push($catg, $row);
			return $catog;
		}
	}
	error_log($_db->error);
	return false;
}

function add_category(Category $ctg, mysqli $_db) {
	$stm = $_db->prepare(
		"INSERT INTO Categories(name, description, color)
		VALUES (?, ?, ?)");
	if($stm !== false) {
		$stm->bind_param("sss", 
			$ctg->name, 
			$ctg->description, 
			$ctg->color);
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
} 

function update_category(Category $ctg, mysqli $_db) {
	$stm = $_db->prepare("UPDATE Categories SET name=?, description=?, color=? WERE id=?");
	if($stm !== false) {
		$stm->bind_param("sssi", 
			$ctg->name,
			$ctg->description,
			$ctg->color,
			$ctg->id);
		if($stm->execute())
			return true;
	}
}

function delete_category(int $id, mysqli $_db) {
	$stm = $_db->prepare("DELETE FROM Categories WHERE id=?");
	if($stm !== false) {
		$stm->bind_param("i", $id);
		if($stm->execute())
			return true;
	}
}
