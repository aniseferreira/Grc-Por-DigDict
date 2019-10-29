<?php

class ErrorDetail
{
	private $collection;
	private $param;
	private $stime; //Start time
	private $etime; //End time
	
	function setCollection($c)
	{
		if (is_array($c))
			$this->collection = $c;
	}
	
	function setParam($p)
	{
		$this->param = $p;
	}
	
	function setStime($t)
	{
		$this->stime = $t;
	}
	
	function setEtime($t)
	{
		$this->etime = $t;
	}
	
	function __toHtml()
	{
		$html = '';
		
		if (is_array($this->collection))
		{
			if (($n = count($this->collection)) > 0)
			{
				
				$lzclass = 'lzpait';
				$html = '<br>
					<table>
						<tr>
							<th style="width: 33%">Registro 1</th>
							<th>Registro 2</th>
							<th style="width: 33%">Registro 3</th>
						</tr>';
					
				$html .= '<tr>
						<td><a href="entry_form.php?id='.$this->collection[0]->getId().'">'.$this->collection[0]->getId().'</a></td>
						<td class="'.$lzclass.'"><a href="entry_form.php?id='.$this->collection[1]->getId().'">'.$this->collection[1]->getId().'</a></td>
						<td><a href="entry_form.php?id='.$this->collection[2]->getId().'">'.$this->collection[2]->getId().'</a></td>
					</tr>';
				
				$html .= '<tr>
						<td>'.$this->collection[0]->getGchar().'</td>
						<td class="'.$lzclass.'">'.$this->collection[1]->getGchar().'</td>
						<td>'.$this->collection[2]->getGchar().'</td>
					</tr>';

				$html .= '<tr>
						<td><b>'.$this->collection[0]->getGword().'</b></td>
						<td class="'.$lzclass.'"><b>'.$this->collection[1]->getGword().'</b></td>
						<td><b>'.$this->collection[2]->getGword().'</b></td>
					</tr>';
				
				$html .= '<tr>
						<td valign="top">'.$this->collection[0]->getPdesc().'</td>
						<td class="'.$lzclass.'" valign="top">'.$this->collection[1]->getPdesc().'</td>
						<td valign="top">'.$this->collection[2]->getPdesc().'</td>
					</tr>';
				
				$html .= '</table>';
				
				if ($this->stime)
					$html .= sprintf('<br>%s Registros encontrados em %s microsegundos', $n, round($this->etime - $this->stime, 6));
			}
			else
			{
				$html .= '<b>Nenhum registro encontrado!</b>';
			}
		}
		else
		{
			$html .= '<b>Erro ao executar a consulta!</b>';
		}
		
		return $html;
	}
}
