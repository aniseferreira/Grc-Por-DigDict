<?php

class EntryDetail
{
	private $msg = '';
	
	private $entry;
	private $gwords = array();
	
	function setEntry(Entry $c)
	{
		$this->entry = $c;
	}
	
	function setGwords($c)
	{
		if (is_array($c))
			$this->gwords = $c;
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
		</div>';
		
		$html .= '<div class="gwords basixbox">
		<b><i><small>Palavras:</small></i></b><br>
		<div style="text-align: right;">
			<a class="abuttom" href="gword_form.php?eid=' . $this->entry->getId() . '">Gerenciar</a>
		</div>';
		
		foreach($this->gwords as $item)
		{
			$html .= '<span class="gword">' . $item->getGword() . '</span>&nbsp;';
		}
		$html .= '</div>';
		
		$descStyle = preg_replace_callback('/\n\d+ /i', function ($item) { return '<b>' . trim($item[0]) . '</b> '; }, "\n" . $this->entry->getPdesc());
		$descStyle = preg_replace_callback('/\n\d+\t/i', function ($item) { return '<b>' . trim($item[0]) . '</b>&nbsp;&nbsp;&nbsp;&nbsp;'; }, $descStyle);
		
		$html .= '<div class="pdesc basixbox">
			<b><i><small>Definição:</small></i></b>
			<div style="text-align: right;">
				<a class="abuttom" href="entry_form.php?id=' . $this->entry->getId() . '">Editar</a>
			</div>
			<p style="text-align: justify;">' . nl2br(trim($descStyle)) . '</p>
		</div>';
		
		return $html;
	}
}
