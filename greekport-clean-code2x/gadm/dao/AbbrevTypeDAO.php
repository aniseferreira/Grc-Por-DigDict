<?php

class AbbrevTypeDAO
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
	
	function findByPK($pk)
	{
		$pk = (int) $pk;
		if ($pk > 0)
		{
			$sql  = "SELECT id, description ";
			$sql .= "FROM abbrevtype WHERE id=%s";
			$sql = sprintf($sql, $pk);
			$rs = $this->db->query($sql);
			if ($rs) {
				$a = $rs->fetchAssoc();
				
				$o = new AbbrevType();
				$o->setId($a['id']);
				$o->setDescription($a['description']);
				
				return $o;
			}
		}
		
		return null;
	}
	
	private function insert(AbbrevType $o)
	{
		$sql  = "INSERT INTO abbrevtype (description) ";
		$sql .= "VALUES ('%s') ";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getDescription())
			);

		if ($this->db->query($sql))
		{
			$o->setId($this->db->lastid());
			return $o;
		}

		return NULL;
	}
	
	private function update(AbbrevType $o)
	{
		$sql  = "UPDATE abbrevtype SET ";
		$sql .= "description='%s' ";
		$sql .= "WHERE id=%s ";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getDescription()),
				$this->db->escapeString($o->getId())
			);
		if ($this->db->query($sql)) {
			return $o;
		}
		else
		{
			echo $this->db->error();
		}

		return NULL;
	}

	function save(AbbrevType $o)
	{
		if ($o->getId()) {
			return $this->update($o);
		}
		else {
			return $this->insert($o);
		}
	}

	function getAll()
	{
		$sql  = "SELECT id ";
		$sql .= "FROM abbrevtype ";
		
		$sql .= "ORDER BY id ASC ";
		
		$collection = null;
		$rs = $this->db->query($sql);
		if ($rs instanceof DBMySqlResultSet)
		{
			$collection = array();
			while ($a = $rs->fetchAssoc())
			{
				$collection[] = $this->findByPK($a['id']);
			}
		}
		
		return $collection;
	}
	
	function getAllOrderByDescription()
	{
		$sql  = "SELECT id ";
		$sql .= "FROM abbrevtype ";
		
		$sql .= "ORDER BY description ASC ";
		
		$collection = null;
		$rs = $this->db->query($sql);
		if ($rs instanceof DBMySqlResultSet)
		{
			$collection = array();
			while ($a = $rs->fetchAssoc())
			{
				$collection[] = $this->findByPK($a['id']);
			}
		}
		
		return $collection;
	}
}
