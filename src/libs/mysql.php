<?php namespace Core;
use mysqli;

class Connection {
	private mysqli $link;
	function __construct() {
		$this->link = new mysqli(
			$_ENV["host"],
			$_ENV["user"],
			$_ENV["password"],
			$_ENV["database"],
			$_ENV["port"]);
	}

	function query(string $query, ?string $params, ...$data) {
		$stm = $this->link->prepare($query);
		if($stm !== false) {
			if($params != null)
				$stm->bind_param($params, ...$data);
			if($stm->execute())
				return $stm->get_result();
		}
		return false;
	}

	function __getError() {
		return $this->link->error;
	}

	function __getConnErrno() {
		return $this->link->connect_errno;
	}

	function __getConnErr() {
		return $this->link->connect_error;
	}

	function __destruct() {
		$this->link->close();
	}
}

class DAO {
	public Connection $conn;
	private string $table;

	function __construct(string $table, Connection $conn) {
		$this->table = $table;
		$this->conn = $conn;
	}

	function selectAll() {
		$res = $this->conn->query("SELECT * FROM $this->table", null, []);
		if($res) {
			$data = [];
			while($row = $res->fetch_assoc())
				array_push($data, $row);
			return $data;
		}
		return false;
	}

	function selectBy(string $param, $val) {
		$res = $this->conn->query(
			"SELECT * FROM $this->table WHERE $param=?", 
			gettype($val)[0], $val);
		if($res) {
			$data = [];
			while($row = $res->fetch_assoc())
				array_push($data, $row);
			return $data;
		}
		return false;
	}

	function addObject(object $val, array $params) {
		$query_params = "";
		$query_val = [];
		$qd = [];
		$qp = [];
		foreach($params as $param) {
			$query_params .= gettype($val->$param)[0];
			array_push($query_val, $val->$param);
			array_push($qd, "?");
			array_push($qp, $param);
		}

		$qd = implode(",", $qd);
		$qp = implode(",", $qp);
		
		return $this->conn->query(
			"INSERT INTO $this->table($qp) VALUES ($qd)", 
			$query_params, ...$query_val);
	}
	
	function updateObject($sval, string $sel, object $val, array $params) {
		$query_params = "";
		$query_val = [];
		$qs = [];
		foreach($params as $param) {
			$query_params .= gettype($val->$param)[0];
			array_push($query_val, $val->$param);
			array_push($qs, "$param=?");
		}
		
		$query_params .= gettype($sval)[0];
		array_push($query_val, $sval);
		$qs = implode(",", $qs);
		return $this->conn->query(
			"UPDATE $this->table SET $qs WHERE $sel=?", 
			$query_params, ...$query_val);
	}
	
	function updateValue($sval, string $sel, $val, string $param) {
		return $this->conn->query(
			"UPDATE $this->table SET $param=? WHERE $sel=?", 
			gettype($val)[0] . gettype($sval)[0], $val, $sval);
	}
	
	function deleteBy(string $param, $val) {
		return $this->conn->query(
			"DELETE FROM $this->table WHERE $param=?", 
			gettype($val)[0], $val);
	}
}
