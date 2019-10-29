<?php

class ErrorDAO
{
	private $db;
	
	private static $_instance;

	private function __construct()
	{
		$this->db = $this->db = DBMySqlConnection::getInstance();
	}

	public static function getInstance()
	{
		if(!self::$_instance)
		{
			self::$_instance = new self();
		}
		
		return self::$_instance;
	}

	function findEmptyWord()
	{
		$sql  = "SELECT id ";
		$sql .= "FROM dic ";
		$sql .= "WHERE gword = '' ";
		$sql .= "ORDER BY id ASC ";
		
		$collection = null;
		$rs = $this->db->query($sql);
		if ($rs instanceof DBMySqlResultSet)
		{
			$collection = array();
			while ($a = $rs->fetchAssoc())
			{
				$collection[] = $a['id'];
			}
		}
		
		return $collection;
	}

	function findEmptyDesc()
	{
		$sql  = "SELECT id ";
		$sql .= "FROM dic ";
		$sql .= "WHERE pdesc = '' ";
		$sql .= "ORDER BY id ASC ";
		
		$collection = null;
		$rs = $this->db->query($sql);
		if ($rs instanceof DBMySqlResultSet)
		{
			$collection = array();
			while ($a = $rs->fetchAssoc())
			{
				$collection[] = $a['id'];
			}
		}
		
		return $collection;
	}
	
	function findEmptyNumberInGword()
	{
		$sql  = "SELECT id ";
		$sql .= "FROM dic ";
		$sql .= "WHERE gword REGEXP '^[0-9]' ";
		$sql .= "ORDER BY id ASC ";
		
		$collection = null;
		$rs = $this->db->query($sql);
		if ($rs instanceof DBMySqlResultSet)
		{
			$collection = array();
			while ($a = $rs->fetchAssoc())
			{
				$collection[] = $a['id'];
			}
		}
		
		return $collection;
	}
	
	function getErroAndNeneighbor($id)
	{
		$collection = array();
		$collection[0] = EntryDAO::getInstance()->findByPK($id-1);
		$collection[1] = EntryDAO::getInstance()->findByPK($id);
		$collection[2] = EntryDAO::getInstance()->findByPK($id+1);
		
		return $collection;
	}
}
