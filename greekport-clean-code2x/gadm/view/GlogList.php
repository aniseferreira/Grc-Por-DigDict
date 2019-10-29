<?php

class GlogList
{
	private $collection;
	private $param;
	private $param2;
	
	function setCollection($c)
	{
		if (is_array($c))
			$this->collection = $c;
	}
	
	function setParam($p)
	{
		$this->param = $p;
	}
	
	function setParam2($p)
	{
		$this->param2 = $p;
	}
	
	function __toHtml()
	{
		$html = '';
		
		if (is_array($this->collection))
		{
			$html = '<br>
					<div>
						<form class="blslog" method="GET" action="glog_list.php">
							<select id="stype" name="stype" onchange="showFieldByType()">
								<option value="1">Data</option>
								<option value="2">Período</option>
								<option value="3">Descrição</option>
							</select>
							<input id="param" type="text" name="param" value="'.$this->param.'">
							<input id="param2" type="text" name="param2" value="'.$this->param2.'">
							<input type="submit" value="Buscar">
						</form>
					</div>
					<script>
						function showFieldByType()
						{
							var x = document.getElementById("stype").value;
							if (x == 2)
							{
								document.getElementById("param2").setAttribute("type", "text");
							}
							else
							{
								document.getElementById("param2").setAttribute("type", "hidden");
							}
						}
						
						document.getElementById("param2").setAttribute("type", "hidden");
					</script>';
			
			if (($n = count($this->collection)) > 0)
			{
				$html .= '<div>';
				
				$i = 0;
				
				foreach($this->collection as $item)
				{
					$lzclass = 'lzpait';
					if ($i%2)
						$lzclass = 'lznormal';
						
					$html .= sprintf('<div class="logentry '.$lzclass.'">%s</div>',
						str_replace( '[[', '<div>',
							str_replace( ']]', '</div>',
								str_replace(']] to [[', '</div> <div class="ftto"> <b>TO: </b>',
									str_replace('from [[', '<div class="ftfrom"> <b>FROM: </b>',
										$item->getLog()
									)
								)
							)
						)
					);
					
					$i++;
				}
				$html .= '</div>';
			}
			else
			{
				$html .= '<br><b>Nenhum registro encontrado!</b>';
			}
		}
		else
		{
			$html .= '<br><b>Erro ao executar a consulta!</b>';
		}
		
		return $html;
	}
}
