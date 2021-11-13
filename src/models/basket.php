<?php namespace Basket;
use mysqli;

class Basket {
	public int $id;
	public int $product;
	public int $quantity;
	public int $uid;

	public function __construct(
		$product,
		$quantity,
		$uid,
		$id = 0)
	{
		$this->id = $id;
		$this->uid = $uid;
		$this->product= $product;
		$this->quantity= $quantity;
	}
}

function add_to_basket(Basket $sale, mysqli $_db) {
	$stm = $_db->prepare("INSERT INTO Basket(product, quantity, uid) VALUES (?, ?, ?)");
	if($stm !== false) {
		$stm->bind_param("iii", 
			$sale->product,
			$sale->quantity,
			$_SESSION['uid']);
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}

function basket(int $uid, mysqli $_db) {
	$stm = $_db->prepare("SELECT * FROM Basket WHERE uid=?");
	if($stm !== false) {
		$stm->bind_param("i", $uid);
		if($stm->execute()) {
			$res = $stm->get_result();
			$basket = [];
			while($row = $res->fetch_assoc())
				array_push($basket, $row);
			return $basket;
		}
	}
	error_log($_db->error);
	return false;
}

function delete_from_basket(int $id, mysqli $_db) {
	$stm = $_db->prepare("DELETE FROM Basket WHERE id=?");
	if($stm !== false) {
		$stm->bind_param("i", $id);
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}
