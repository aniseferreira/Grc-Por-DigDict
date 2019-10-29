<?php

class Abbrev
{
	private $id;
	private $abbrev;
	private $description;
	private $abbrevType;
	
	function setId($id)
	{
		$this->id = $id;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function setAbbrev($a)
	{
		$this->abbrev = $a;
	}
	
	function getAbbrev()
	{
		return $this->abbrev;
	}
	
	function setDescription($d)
	{
		$this->description = $d;
	}
	
	function getDescription()
	{
		return $this->description;
	}
	
	function setAbbrevType(AbbrevType $o)
	{
		$this->abbrevType = $o;
	}
	
	function getAbbrevType()
	{
		return $this->abbrevType;
	}
}
