<?php
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
