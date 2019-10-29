<?php

class Glog
{
	private $id;
	private $logtime;
	private $log;
	
	function setId($id)
	{
		$this->id = $id;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function setLogtime($t)
	{
		$this->logtime = $t;
	}
	
	function getLogtime()
	{
		return $this->logtime;
	}
	
	function setLog($l)
	{
		$this->log = $l;
	}
	
	function getLog()
	{
		return $this->log;
	}
}
