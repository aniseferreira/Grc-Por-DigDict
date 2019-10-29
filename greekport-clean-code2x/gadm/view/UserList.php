<?php

class UserList
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
						<div>
							<div class="blbtnewrecord">
								<a class="abuttom" href="user_form.php"><span>Novo registro</span></a>
							</div>
							<form class="blsrecord" method="GET" action="user_list.php">
								<input type="text" name="param" value="'.$this->param.'">
								<input type="submit" value="Buscar">
							</form>
						</div>';

				$html .= '<table>
					<tr>
						<th>ID</th>
						<th>Nome</th>
						<th>Login</th>
						<th>Senha</th>
						<th>Ativo</th>
						<th>Level</th>
					</tr>';
				
				$i = 0;
				
				foreach($this->collection as $item)
				{
					$lzclass = 'lznormal';
					if ($i%2)
						$lzclass = 'lzpait';
						
					$html .= sprintf('<tr class="'.$lzclass.'">
									<td>%s</td>
									<td><a href="user_form.php?id=%s">%s</a></td>
									<td>%s</td>
									<td>%s</td>
									<td>%s</td>
									<td>%s</td>
								</tr>',
								
							$item->getId(),
							$item->getId(),
							$item->getHName(),
							$item->getUName(),
							$item->getUPass(),
							$item->getEnable(),
							$item->getALevel()
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
