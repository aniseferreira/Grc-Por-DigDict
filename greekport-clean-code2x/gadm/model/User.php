<?php

class User
{
	private $id;
	private $hname;
	private $uname;
	private $upass;
	private $enable;
	private $alevel;
	
	function setId($id)
	{
		$this->id = $id;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function setHName($hname)
	{
		$this->hname = $hname;
	}
	
	function getHName()
	{
		return $this->hname;
	}
	
	function setUName($uname)
	{
		$this->uname = $uname;
	}
	
	function getUName()
	{
		return $this->uname;
	}
	
	function setUPass($upass)
	{
		$this->upass = $upass;
	}
	
	function getUPass()
	{
		return $this->upass;
	}

	function setEnable($enable)
	{
		$this->enable = $enable;
	}
	
	function getEnable()
	{
		return $this->enable;
	}

	function setALevel($alevel)
	{
		$this->alevel = $alevel;
	}
	
	function getALevel()
	{
		return $this->alevel;
	}
}
