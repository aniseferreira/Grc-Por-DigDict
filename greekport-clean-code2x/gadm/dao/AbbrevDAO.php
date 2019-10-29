<?php

class AbbrevDAO
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
			$sql  = "SELECT id, abbrevtypeid, abbrev, description ";
			$sql .= "FROM abbrev WHERE id=%s";
			$sql = sprintf($sql, $pk);
			$rs = $this->db->query($sql);
			if ($rs) {
				$a = $rs->fetchAssoc();

				$o = new Abbrev();
				$o->setId($a['id']);
				$o->setAbbrev($a['abbrev']);
				$o->setDescription($a['description']);
				
				$abt = AbbrevTypeDAO::getInstance()->findByPK($a['abbrevtypeid']);
				$o->setAbbrevType($abt);

				return $o;
			}
		}
		
		return null;
	}
	
	private function insert(Abbrev $o)
	{
		$sql  = "INSERT INTO abbrev (abbrevtypeid, abbrev, description) ";
		$sql .= "VALUES (%s, '%s', '%s') ";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getAbbrevType()->getId()),
				$this->db->escapeString($o->getAbbrev()),
				$this->db->escapeString($o->getDescription())
			);

		if ($this->db->query($sql))
		{
			$o->setId($this->db->lastid());
			return $o;
		}

		return NULL;
	}
	
	private function update(Abbrev $o)
	{
		$sql  = "UPDATE abbrev SET ";
		$sql .= "abbrevtypeid=%s, abbrev='%s', description='%s' ";
		$sql .= "WHERE id=%s ";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getAbbrevType()->getId()),
				$this->db->escapeString($o->getAbbrev()),
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

	function save(Abbrev $o)
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
		$sql .= "FROM abbrev ";
		
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

	function getArrayAbbrev()
	{
		$sql  = "SELECT abbrev ";
		$sql .= "FROM abbrev ";
		
		$collection = null;
		$rs = $this->db->query($sql);
		if ($rs instanceof DBMySqlResultSet)
		{
			$collection = array();
			while ($a = $rs->fetchAssoc())
			{
				$collection[] = $a['abbrev'];
			}
		}
		
		return $collection;
	}
}
