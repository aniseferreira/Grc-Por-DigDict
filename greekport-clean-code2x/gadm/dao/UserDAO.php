<?php

class UserDAO
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
			$sql  = "SELECT id, hname, uname, upass, enable, alevel ";
			$sql .= "FROM user WHERE id=%s";
			$sql = sprintf($sql, $pk);
			$rs = $this->db->query($sql);
			if ($rs) {
				$a = $rs->fetchAssoc();
				
				$o = new User();
				$o->setId($a['id']);
				$o->setHName($a['hname']);
				$o->setUName($a['uname']);
				$o->setUPass($a['upass']);
				$o->setEnable($a['enable']);
				$o->setALevel($a['alevel']);
				
				return $o;
			}
		}

		return null;
	}

	private function insert(User $o)
	{
		$sql  = "INSERT INTO user (hname, uname, upass, enable, alevel) ";
		$sql .= "VALUES ('%s', '%s', '%s', %s, %s)";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getHName()),
				$this->db->escapeString($o->getUName()),
				$this->db->escapeString($o->getUPass()),
				$this->db->escapeString($o->getEnable()),
				$this->db->escapeString($o->getALevel())
			);

		if ($this->db->query($sql))
		{
			$o->setId($this->db->lastid());
			return $o;
		}

		return NULL;
	}

	private function update(User $o)
	{
		$p='';
		if (!empty($o->getUPass()))
		{
			$p = ", upass='{$o->getUPass()}'";
		}
		
		$sql  = "UPDATE user SET ";
		$sql .= "hname='%s', uname='%s' $p , enable=%s, alevel=%s ";
		$sql .= "WHERE id=%s";

		$sql = sprintf( $sql,
				$this->db->escapeString($o->getHName()),
				$this->db->escapeString($o->getUName()),
				$this->db->escapeString($o->getEnable()),
				$this->db->escapeString($o->getALevel()),
				$this->db->escapeString($o->getId())
			);
		if ($this->db->query($sql)) {
			return $o;
		}

		return NULL;
	}

	function save(User $o)
	{
		if ($o->getId()) {
			return $this->update($o);
		}
		else {
			return $this->insert($o);
		}
	}

	function getByUName($param)
	{
		if (empty($param))
		{
			return null;
		}
		
		$param = $this->db->escapeString($param);
		$sql  = "SELECT id FROM user WHERE uname='{$param}' ";
		$rs = $this->db->query($sql);
		if ($rs instanceof DBMySqlResultSet)
		{
			$a = $rs->fetchAssoc();
			return $this->findByPK($a['id']);
		}
		
		return null;
	}

	function getByHName($param)
	{
		$param = $this->db->escapeString($param);
		
		$sql  = "SELECT id ";
		$sql .= "FROM user ";
		
		if (!empty($param))
		{
			$param = str_replace('*', '%', $param);
			$sql .= "WHERE hname LIKE '{$param}' ";
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

	function getFirst10()
	{
		$sql  = "SELECT id ";
		$sql .= "FROM user ";
		$sql .= "ORDER BY id DESC LIMIT 10 ";
		
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
