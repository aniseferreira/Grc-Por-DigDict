<?php

class EntryList
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
			$html = '<br>
					<div>
						<div class="blbtnewrecord">
							<a class="abuttom" href="entry_form.php"><span>Novo registro</span></a>
						</div>
						<form id="search" class="blsrecord" method="GET" action="entry_list.php" autocomplete="off">
							<div class="autocomplete" style="width:70%;">
								<input type="text" onkeyup="autoComplete(this);" name="param" value="'.$this->param.'" style="width:100%;">
							</div>
							<input type="submit" value="Buscar">
							
							<script>
							function autoComplete (obj) {
								searchChange(obj);
								var x = document.getElementById(obj.id + "autocomplete-list");
								if (x != null) {
									obj.parentNode.removeChild(x);
								}
								
								if (obj.value.trim().length > 0)  {
									$.get("gword_query.php?param=" + obj.value, function(data, status) {
										var a = document.createElement("DIV");
										a.setAttribute("id", obj.id + "autocomplete-list");
										a.setAttribute("class", "autocomplete-items");
										obj.parentNode.appendChild(a);


										for (i = 0; i < data.length; i++) {
											b = document.createElement("DIV");
											b.innerHTML = "<a class=\"a-autocomplete-item\" href=\"entry_detail.php?id="+data[i].id+"\">"+data[i].gword+"</a>";
											a.appendChild(b);
										}
									});
								}
							}
							</script>
							
						</form>
					</div>';
			
			if (($n = count($this->collection)) > 0)
			{
				$html .= '<table>';
				$html .= '<tr>
						<th>ID</th>
						<th>Caractere</th>
						<th>Palavra</th>
						<th>Definição</th>
						<!--<th>&nbsp;</th>-->
					</tr>';
				
				$i = 0;
				
				foreach($this->collection as $item)
				{
					$lzclass = 'lznormal';
					if ($i%2)
						$lzclass = 'lzpait';
						
					$html .= sprintf('<tr class='.$lzclass.'>
									<td>%s</td>
									<td>%s</td>
									<td><a href="entry_detail.php?id=%s">%s</a></td>
									<td><pre>%s</pre></td>
									<!--<td><a href="entry_list.php?param=%s&a=del&id=%s">Excluir</a></td>-->
								</tr>',
								
							$item->getEntry()->getId(),
							$item->getEntry()->getGchar(),
							$item->getEntry()->getId(),
							$item->getGword(),
							strlen($item->getEntry()->getPdesc()) > 50 ? substr($item->getEntry()->getPdesc(), 0, 45) . ' ...' : $item->getEntry()->getPdesc(),
							$this->param,
							$item->getEntry()->getId()
						);
					
					$i++;
				}
				$html .= '</table>';
				
				if ($this->stime)
					$html .= sprintf('<br>%s Registros encontrados em %s microsegundos', $n, round($this->etime - $this->stime, 6));
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
