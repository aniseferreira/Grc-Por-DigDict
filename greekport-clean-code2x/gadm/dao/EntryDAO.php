<?php

class EntryDAO
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
			$sql  = "SELECT id, gchar, gword, pdesc ";
			$sql .= "FROM entry WHERE id=%s";
			$sql = sprintf($sql, $pk);
			$rs = $this->db->query($sql);
			if ($rs) {
				$a = $rs->fetchAssoc();
				
				$o = new Entry();
				$o->setId($a['id']);
				$o->setGchar($a['gchar']);
				$o->setGword($a['gword']);
				$o->setPdesc($a['pdesc']);
				
				return $o;
			}
		}
		
		return null;
	}
	
	private function insert(Entry $o)
	{
		$sql  = "INSERT INTO entry (gchar, gword, pdesc) ";
		$sql .= "VALUES ('%s', '%s', '%s')";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getGchar()),
				$this->db->escapeString($o->getGword()),
				$this->db->escapeString($o->getPdesc())
			);

		if ($this->db->query($sql))
		{
			$o->setId($this->db->lastid());
			return $o;
		}

		return NULL;
	}
	
	private function update(Entry $o)
	{
		$sql  = "UPDATE entry SET ";
		$sql .= "gchar='%s', gword='%s', pdesc='%s' ";
		$sql .= "WHERE id=%s";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getGchar()),
				$this->db->escapeString($o->getGword()),
				$this->db->escapeString($o->getPdesc()),
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

	function save(Entry $o)
	{
		if ($o->getId()) {
			return $this->update($o);
		}
		else {
			return $this->insert($o);
		}
	}
	
	function getByGchar($param)
	{
		$param = $this->db->escapeString($param);
		
		$sql  = "SELECT id ";
		$sql .= "FROM entry ";
		
		if (!empty($param))
			$sql .= "WHERE gchar='{$param}' ";
		
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

	function getByGword($param)
	{
		$param = $this->db->escapeString($param);
		
		$sql  = "SELECT id ";
		$sql .= "FROM entry ";
		
		if (!empty($param))
		{
			$param = str_replace('*', '%', $param);
			$sql .= "WHERE gword LIKE '{$param}' ";
		}
		
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

	function getFirst20()
	{
		$sql  = "SELECT id ";
		$sql .= "FROM entry ";
		
		$sql .= "ORDER BY id ASC LIMIT 20 ";
		
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
