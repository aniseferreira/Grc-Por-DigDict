<?php

class AbbrevTypeList
{
	private $collection;
	private $stime; //Start time
	private $etime; //End time
	
	function setCollection($c)
	{
		if (is_array($c))
			$this->collection = $c;
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
				$html = '<br>
						<div>
							<div class="blbtnewrecord">
								<a class="abuttom" href="abbrev_type_form.php"><span title="novo registro">Novo registro</span></a>
							</div>
						</div>';

				$html .= '<table>
					<tr>
						<th>ID</th>
						<th>Descrição</th>
					</tr>';
				
				$i = 0;
				
				foreach($this->collection as $item)
				{
					$lzclass = 'lznormal';
					if ($i%2)
						$lzclass = 'lzpait';
						
					$html .= sprintf('<tr class="'.$lzclass.'">
									<td>%s</td>
									<td><a href="abbrev_type_form.php?id=%s">%s</a></td>
								</tr>',
								
							$item->getId(),
							$item->getId(),
							$item->getDescription()
						);
					
					$i++;
				}
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
