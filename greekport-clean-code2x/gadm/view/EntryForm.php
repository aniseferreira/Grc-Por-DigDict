<?php

class EntryForm
{
	private $msg = '';
	
	private $entry;
	
	function setEntry(Entry $c)
	{
		$this->entry = $c;
	}
	
	function setMessage($m)
	{
		$this->msg = $m;
	}
	
	function __toHtml()
	{
		if (!$this->entry instanceof Entry)
			$this->entry = new Entry();
		
		$html = '<br>
		<div style="text-align: right;">
			<a class="abuttom" href="entry_list.php">Listar Entradas</a>
		</div>
		<form class="formbox formrecord" method="POST" action="entry_form.php">
			<h2>Cadastro de Entradas</h2>
			<span>' . $this->msg . '</span>
			<input type="hidden" name="id" value="' . $this->entry->getId() . '">';
			
			if (!$this->entry->getId())
			{
				$html .= '
					Caractere:<br>
					<input type="text" onkeyup="searchChange(this);" name="gchar" value="' . $this->entry->getGchar() . '"><br><br>
					
					Entrada:<br>
					<input type="text" onkeyup="searchChange(this);" name="gword" value="' . $this->entry->getGword() . '"><br><br>';
			}
			else
			{
				$html .= '
					<input type="hidden" name="gchar" value="' . $this->entry->getGchar() . '">
					<input type="hidden" name="gword" value="' . $this->entry->getGword() . '">';
			}
			
		$html .= '
			Descrição:<br>
			<textarea name="pdesc">' . $this->entry->getPdesc() . '</textarea> <br><br>
			
			<input type="submit" value="Gravar"><br><br>
		</form>';
		
		return $html;
	}
}
