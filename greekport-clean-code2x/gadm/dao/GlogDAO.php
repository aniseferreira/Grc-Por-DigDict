<?php

class GlogDAO
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
			$sql  = "SELECT id, logtime, log ";
			$sql .= "FROM glog WHERE id=%s";
			$sql = sprintf($sql, $pk);
			$rs = $this->db->query($sql);
			if ($rs) {
				$a = $rs->fetchAssoc();
				
				$o = new Glog();
				$o->setId($a['id']);
				$o->setLogtime($a['logtime']);
				$o->setLog($a['log']);
				
				return $o;
			}
		}
		
		return null;
	}
	
	function logMSG($msg)
	{
		$glog = new Glog();
		$glog->setLogtime(time());
		$glog->setLog($this->db->escapeString($msg));
		$this->insert($glog);
	}
	
	private function insert(Glog $o)
	{
		$sql  = "INSERT INTO glog (logtime, log) ";
		$sql .= "VALUES (%s, '%s')";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getLogtime()),
				$this->db->escapeString($o->getLog())
			);

		if ($this->db->query($sql))
		{
			$o->setId($this->db->lastid());
			return $o;
		}

		return NULL;
	}

	function getFirst20()
	{
		$sql  = "SELECT id ";
		$sql .= "FROM glog ";
		$sql .= "ORDER BY logtime DESC LIMIT 20 ";
		
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
	
	function getByPeriod($p1, $p2)
	{
		$p1 = (int) $p1;
		$p2 = (int) $p2;
		
		$sql  = "SELECT id ";
		$sql .= "FROM glog ";
		$sql .= "WHERE logtime >= {$p1} AND logtime <= {$p2} ";
		$sql .= "ORDER BY logtime DESC";
		
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
	
	function getByDate($d)
	{
		$d = (int) $d;
		
		return $this->getByPeriod($d, $d+(24*60*60));
	}
	
	function getByDesc($p)
	{
		$p = $this->db->escapeString($p);
		
		$sql  = "SELECT id ";
		$sql .= "FROM glog ";
		$sql .= "WHERE log LIKE '%{$p}%' ";
		$sql .= "ORDER BY logtime DESC";

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
