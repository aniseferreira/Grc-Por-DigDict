<?php

class Gword
{
	private $id;
	private $entry;
	private $gword;
	
	function setId($id)
	{
		$this->id = $id;
	}
	
	function getId()
	{
		return $this->id;
	}
	
	function setEntry(Entry $entry)
	{
		$this->entry = $entry;
	}
	
	function getEntry()
	{
		return $this->entry;
	}
	
	function setGword($gword)
	{
		$this->gword = $gword;
	}
	
	function getGword()
	{
		return $this->gword;
	}
}
