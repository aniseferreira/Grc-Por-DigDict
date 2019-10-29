<?php

class AbbrevType
{
	private $id;
	private $description;
	
	function setId($id)
	{
		$this->id = $id;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function setDescription($d)
	{
		$this->description = $d;
	}
	
	function getDescription()
	{
		return $this->description;
	}
}
