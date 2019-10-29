<?php

class DBMySqlConnection
{
	static private $__instance = null;

	private $dsn = '';
	private $conn = null;
	private $rs = null;

	private $last_query = '';

	function __construct()
	{
		$this->conn = mysqli_connect('localhost', 'user', 'pass', 'database');
		if (!$this->conn)
		{
			echo "Error: Unable to connect to MySQL." . PHP_EOL;
			echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
			echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
			exit;
		}
	}

	static function getInstance()
	{
		if (empty(self::$__instance))
		{
			self::$__instance = new DBMySqlConnection();
		}

		return self::$__instance;
	}

	function query($sql)
	{
		if (!empty($this->rs)) {
			unset($this->rs);
		}

		if ($rs = mysqli_query($this->conn, $sql)) {
			if ($rs === TRUE) {
				return TRUE;
			}

			$this->rs = new DBMySqlResultSet($rs);
			if($this->rs) {
				$this->last_query = $sql;
			}

			return $this->rs;
		}
		else {
			return NULL;
		}
	}

	function lastid() {
		return mysqli_insert_id($this->conn);
	}

	function lastError() {
		return mysqli_error($this->conn);
	}

	function freeResult() {
		unset($this->rs);
		$this->rs = null;
	}

	function __destruct() {
		if (! empty($this->conn))
			mysqli_close($this->conn);

		$this->conn = null;
	}

	function escapeString($str) {
		return mysqli_real_escape_string($this->conn, $str);
	}
	
	function error()
	{
		return mysqli_error($this->conn);
	}
}
