<?php
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
