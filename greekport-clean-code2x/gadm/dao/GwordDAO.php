<?php

class GwordDAO
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
			$sql  = "SELECT id, entryid, gword ";
			$sql .= "FROM gword WHERE id=%s ";
			$sql = sprintf($sql, $pk);
			$rs = $this->db->query($sql);
			if ($rs) {
				$a = $rs->fetchAssoc();
				
				$o = new Gword();
				$o->setId($a['id']);
				$o->setGword($a['gword']);
				
				$e = EntryDAO::getInstance()->findByPK($a['entryid']);
				$o->setEntry($e);
				
				return $o;
			}
		}
		
		return null;
	}
	
	private function insert(Gword $o)
	{
		$sql  = "INSERT INTO gword (entryid, gword) ";
		$sql .= "VALUES (%s, '%s')";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getEntry()->getId()),
				$this->db->escapeString($o->getGword())
			);

		if ($this->db->query($sql))
		{
			$o->setId($this->db->lastid());
			return $o;
		}

		return NULL;
	}
	
	private function update(Gword $o)
	{
		$sql  = "UPDATE gword SET ";
		$sql .= "entryid=%s, gword='%s' ";
		$sql .= "WHERE id=%s";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getEntry()->getId()),
				$this->db->escapeString($o->getGword()),
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

	function save(Gword $o)
	{
		if ($o->getId()) {
			return $this->update($o);
		}
		else {
			return $this->insert($o);
		}
	}
	
	function getByEntry(Entry $o)
	{
		$sql  = "SELECT id ";
		$sql .= "FROM gword ";
		
		$entryid = $o->getId();
		if (!empty($entryid))
			$sql .= "WHERE entryid='{$entryid}' ";
		
		$sql .= "ORDER BY gword ASC ";
		
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
	
	function getByGword($p)
	{
		if (empty($p))
			return null;
		
		$p = str_replace('*', '%', $p);
		$p = $this->db->escapeString($p);
		
		$sql  = "SELECT id ";
		$sql .= "FROM gword ";
		$sql .= "WHERE gword LIKE '{$p}' ";
		$sql .= "ORDER BY gword ASC ";
		
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

	function getFirst20()
	{
		$sql  = "SELECT id ";
		$sql .= "FROM gword ";
		$sql .= "ORDER BY entryid ASC ";
		$sql .= "LIMIT 20 ";
		
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
