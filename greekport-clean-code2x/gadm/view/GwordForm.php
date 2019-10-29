<?php

class GwordForm
{
	private $msg = '';
	
	private $gword;
	private $collection;
	private $entry;
	
	function setEntry(Entry $o)
	{
		$this->entry = $o;
	}
	
	function setCollection($c)
	{
		if (is_array($c))
			$this->collection = $c;
	}
	
	function setGword(Gword $o)
	{
		$this->gword = $o;
	}
	
	function setMessage($m)
	{
		$this->msg = $m;
	}
	
	function __toHtml()
	{
		if (!$this->entry instanceof Entry)
			$this->entry = new Entry();
			
		if (!$this->gword instanceof Gword)
			$this->gword = new Gword();
		
		$html = '<br>
		<form class="formbox formrecord" method="POST" action="gword_form.php">
			<h2>Cadastro de Palavras</h2>
			<span>' . $this->msg . '</span>
			<input type="hidden" name="id" value="' . $this->gword->getId() . '">
			
			Palavra:<br>
			<input type="text" onkeyup="searchChange(this);" name="gword" value="' . $this->gword->getGword() . '"><br><br>
			
			<input type="submit" value="Adicionar"><br><br>
		</form>';
		
		if (($n = count($this->collection)) > 0)
		{
			$html .= '<div class="gwords">';
			
			$i = 0;
			
			foreach($this->collection as $item)
			{
				$html .= sprintf('<span class="gword">%s
								<a href="gword_form.php?id=%s">E</a>
								<!--<a href="gword_form.php?del=%s">X</a>-->
							</span>',
						
						$item->getGword(),
						$item->getId(),
						$item->getId()
					);
				
				$i++;
			}
			$html .= '</div>';
		}
		$html .= '<div style="text-align: right;">
			<a class="abuttom" href="entry_detail.php?id=' . $this->entry->getId() . '">Continuar</a>
		</div>';
		
		return $html;
	}
}
