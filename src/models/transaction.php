<?php namespace Transactions;
use DateTime;
use mysqli;

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

function add_transaction(Transaction $tras, mysqli $_db) {
	$stm = $_db->prepare(
		"INSERT INTO Transactions(t_date, description, details, uid)
		VALUES (?, ?, ?, ?)");
	if($stm !== false) {
		$stm->bind_param("sssi", 
			$tras->t_date, 
			$tras->description, 
			$tras->details,
			$tras->uid);
		if($stm->execute())
			return true;
	}
	error_log($_db->error);
	return false;
}

function get_transaction(int $id, mysqli $_db) {
	$stm = $_db->prepare("SELECT * FROM Transactions WHERE id=?");
	if($stm !== false) {
		$stm->bind_param("i", $id);
		if($stm->execute()) {
			$res = $stm->get_result();
			$trs = $res->fetch_assoc();
			return $trs ?? false;
		}
	}
	error_log($_db->error);
	return false;
}

function transactions(int $offset, int $limit, mysqli $_db) {
	$stm = $_db->prepare("SELECT * FROM Transactions LIMIT ?, ?");
	if($stm !== false) {
		$stm->bind_param("ii", $offset, $limit);
		if($stm->execute()) {
			$res = $stm->get_result();
			$transactions = [];
			while($row = $res->fetch_assoc())
				array_push($transactions, $row);
			return $transactions;
		}
	}
	error_log($_db->error);
	return false;
}
