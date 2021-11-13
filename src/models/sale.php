<?php namespace Sales;

class Sale {
	public int $id;
	public int $product;
	public int $quantity;

	public function __construct(
		$product,
		$quantity,
		$id = 0)
	{
		$this->id = $id;
		$this->product= $product;
		$this->quantity= $quantity;
	}
}

function add_sale(Sale $sale, mysqli $_db) {
	$stm = $_db->prepare("INSERT INTO Sales(product, quantity) VALUES (?, ?)");
	if($stm !== false) {
		$stm->bind_param("ii", $sale->product, $sale->quantity);
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}

function sales(int $offset, int $limit, mysqli $_db) {
	$stm = $_db->prepare(
		"SELECT s.quantity, p.name FROM Sales as s LIMIT ?, ?
		INNER JOIN Products as p ON p.id = s.product");
	if($stm !== false) {
		$stm->bind_param("ii", $offset, $limit);
		if($stm->execute()) {
			$res = $stm->get_result();
			$sales = [];
			while($row = $res->fetch_assoc()) 
				array_push($sales, $row);
			return $sales;
		}
	}
	error_log($_db->error);
	return false;
}
