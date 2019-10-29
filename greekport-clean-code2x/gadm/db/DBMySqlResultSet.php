<?php

class DBMySqlResultSet
{

	var $rs = null;

	function __construct($rs) {
		if(!$rs instanceof mysqli_result)
			die('Ivalid result set' . __Class__ . ' ' . __LINE__);

		$this->rs = $rs;
	}

	function resultError() {
		return null;
	}

	function fetchAll() {
		return null;
	}

	function fetchArray() {
		return mysqli_fetch_array($this->rs);
	}

	function fetchAssoc() {
		return mysqli_fetch_assoc($this->rs);
	}

	function fetchObject() {
		return mysqli_fetch_object($this->rs);
	}

	function fetchRow() {
		return mysqli_fetch_row($this->rs);
	}

	function affectedRows() {
		return mysqli_affected_rows($this->rs);
	}

	function numRows() {
		return mysqli_num_rows($this->rs);
	}

	function free() {
		if ($this->rs) {
			mysqli_free_result($this->rs);
			$this->rs = null;
		}
	}

	function __destruct() {
		$this->free();
	}
}
