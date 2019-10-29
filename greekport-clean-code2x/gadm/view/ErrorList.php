<?php

class ErrorList
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
				
				$html = '<br>
					<table>';
				
				$ncol = 10;
				$tbsize = $n;
				while(! (($tbsize%$ncol) == 0))
				{
					$tbsize++;
				}
				
				$aux = 0;
				for ($i=0; $i<($tbsize/$ncol); $i++)
				{
					$lzclass = 'lznormal';
					if ($i%2)
					{
						$lzclass = 'lzpait';
					}
					$html .= '<tr class='.$lzclass.'>';
						
					for ($j=0; $j<$ncol; $j++)
					{
						$id = ($aux<$n ? $this->collection[$aux] : 0);
						if ($id == 0)
						{
							$html .= '<td>&nbsp;</td>';
						}
						else
						{
							$html .= '<td><a href="error_detail.php?id='.$id.'">'.$id.'</a></td>';
						}
						$aux++;
					}
					
					$html .= '</tr>';
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
