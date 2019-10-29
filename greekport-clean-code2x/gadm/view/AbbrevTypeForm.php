<?php

class AbbrevTypeForm
{
	private $msg = '';
	
	private $o;
	
	function setAbbrevType(AbbrevType $c)
	{
		$this->o = $c;
	}
	
	function setMessage($m)
	{
		$this->msg = $m;
	}
	
	function __toHtml()
	{
		if (!$this->o instanceof AbbrevType)
			$this->o = new AbbrevType();
		
		return '<br>
		<div style="text-align: right;">
			<a class="abuttom" href="abbrev_type_list.php">Listar Tipos</a>
		</div>
		<form class="formbox formrecord" method="POST" action="abbrev_type_form.php">
			<h2>Cadastro de Tipo de Abreviatura</h2>
			<span>' . $this->msg . '</span>
			<input type="hidden" name="id" value="' . $this->o->getId() . '">
			
			Descrição:<br>
			<input type="text" name="description" value="' . $this->o->getDescription() . '"><br><br>
			<input type="submit" value="Gravar"><br><br>
		</form>';
	}
}
