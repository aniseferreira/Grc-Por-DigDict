<?php

class AbbrevForm
{
	private $msg = '';
	private $collection;
	
	private $o;
	
	function setAbbrev(Abbrev $c)
	{
		$this->o = $c;
	}
	
	function setCollection($c)
	{
		
		if (is_array($c))
			$this->collection = $c;
	}
	
	function setMessage($m)
	{
		$this->msg = $m;
	}
	
	function __toHtml()
	{
		if (!$this->o instanceof Abbrev)
			$this->o = new Abbrev();
		
		$options = '';
		foreach ($this->collection as $item)
		{
			$options .= '<option value="'.$item->getId().'" '.($this->o->getAbbrevType()->getId() == $item->getId()?'SELECTED':'').'>'.$item->getDescription().'</option>';
		}
		
		return '<br>
		<div style="text-align: right;">
			<a class="abuttom" href="abbrev_list.php">Listar</a>
		</div>
		<form class="formbox formrecord" method="POST" action="abbrev_form.php">
			<h2>Cadastro de Tipo de Abreviatura</h2>
			<span>' . $this->msg . '</span>
			<input type="hidden" name="id" value="' . $this->o->getId() . '">
			
			Abreviatura:<br>
			<input type="text" name="abbrev" value="' . $this->o->getAbbrev() . '"><br><br>
			
			Descrição:<br>
			<input type="text" name="description" value="' . $this->o->getDescription() . '"><br><br>
			
			Tipo:<br>
			<select name="abbrevtypeid">'.$options.'</select><br><br>
			
			<input type="submit" value="Gravar"><br><br>
		</form>';
	}
}
