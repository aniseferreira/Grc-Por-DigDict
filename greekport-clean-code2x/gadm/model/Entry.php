<?php

class Entry
{
	private $id;
	private $gchar;
	private $gword;
	private $pdesc;
	
	function setId($id)
	{
		$this->id = $id;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function setGchar($gchar)
	{
		$this->gchar = $gchar;
	}
	
	function getGchar()
	{
		return $this->gchar;
	}
	
	function setGword($gword)
	{
		$this->gword = $gword;
	}
	
	function getGword()
	{
		return $this->gword;
	}
	
	function setPdesc($pdesc)
	{
		$this->pdesc = $pdesc;
	}
	
	function getPdesc()
	{
		return $this->pdesc;
	}
}
