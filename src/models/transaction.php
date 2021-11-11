<?php

class Transaction 
{
	public int $id;
	public DateTime $t_date;
	public string $description;
	public string $details;
	public int $uid;

	public function __construct(
		$description,
		$details,
		$uid,
		$t_date = "now",
		$id = 0) 
	{
		$this->description = $description;
		$this->details = $details;
		$this->uid = $uid;
		$this->t_date = new DateTime($t_date);
		$this->id = $id;
	}
}
