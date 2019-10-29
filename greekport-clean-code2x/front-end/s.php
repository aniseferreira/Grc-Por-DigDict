<?php
require_once 'setup.php';

$gword = '';
if (isset($_GET['pattern']) && !empty($gword = trim($_GET['pattern'])))
{
	$gword = $mysqli->real_escape_string($gword);
	$gword = str_replace('*', '%', $gword);
	
	$sql = "SELECT gw.gword, en.pdesc FROM gword gw, entry en WHERE en.id = gw.entryid AND gw.gword LIKE '{$gword}' ORDER BY gw.gword LIMIT 30";
	$result = $mysqli->query($sql);
}
else if (isset($_GET['id']))
{
	$id = (int) $_GET['id'];
	$sql = "SELECT gw.gword, en.pdesc FROM gword gw, entry en WHERE en.id = gw.entryid AND gw.id = {$id}";
	$result = $mysqli->query($sql);
}
else
{
	header("Refresh:0; url=index.php");
	exit;
}

?><!DOCTYPE html>
<html>
	<head>
		<title><?php echo $lang == 'pt' ? 'Dicionário Digital Grego-Português' : 'Greek-Portuguese Digital Dictionary'; ?></title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="media/normalize.css">
		<link href="https://fonts.googleapis.com/css?family=Alegreya+Sans|Alegreya+Sans+SC&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="media/main.css">
		<script type="text/javascript" src="js/greekcode.js"></script>
		<script type="text/javascript" src="js/jquery/3.4.1/jquery.min.js"></script>
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>
		<div id="main">
			<div class="wrap">
				<div id="header">
					<div id="lang-select">
							<a href="setlang.php?lang=<?php echo $lang == 'pt' ? 'en' : 'pt' ; ?>"><img src="media/<?php echo $lang == 'pt' ? 'en' : 'pt' ; ?>.svg"><br><?php echo $lang == 'pt' ? 'English' : 'Português'; ?></a>
						</div>
					<h1><?php echo $lang == 'pt' ? 'Dicionário Digital Grego-Português' : 'Greek-Portuguese Digital Dictionary'; ?></h1>
				</div>
				<div id="content">
					<form id="mainsearch" method="GET" action="s.php" autocomplete="off">
						<div>
							<div class="autocomplete">
								<div class="search-field">
									<input type="text" value="<?php echo isset($_GET['pattern']) ? $_GET['pattern'] : ''; ?>" name="pattern" placeholder="<?php echo $lang == 'pt' ? 'Inserir termo' : 'Insert word'; ?>" onkeyup="autoComplete(this);" autocomplete="off">
									<input type="submit" name="submit" value="<?php echo $lang == 'pt' ? 'Buscar' : 'Search' ; ?>">
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
													b.innerHTML = "<a class=\"a-autocomplete-item\" href=\"s.php?id="+data[i].id+"\">"+data[i].gword+"</a>";
													a.appendChild(b);
												}
											});
										}
									}
									</script>
								</div>
							</div>
							&nbsp;
						</div>
						<?php
							if ($result)
							{
								switch($result->num_rows)
								{
									case 0:
										echo '<div id="wresult"><b>Nenhum registro encontrado para esta busca!</b></div>';
									break;
									
									case 1:
										$row = $result->fetch_assoc();
										
										$descStyle = preg_replace_callback('/\n\d+ /i', function ($item) { return '<b>' . trim($item[0]) . '</b> '; }, "\n" . $row["pdesc"]);
										$descStyle = preg_replace_callback('/\n\d+\t/i', function ($item) { return '<b>' . trim($item[0]) . '</b>&nbsp;&nbsp;&nbsp;&nbsp;'; }, $descStyle);
										
										// Abbreviation style
										$rs = $mysqli->query("SELECT a.abbrev, a.description FROM abbrev a, abbrevtype at WHERE a.abbrevtypeid=at.id AND at.id != 1 ");
										
										$asearch = array();
										$areplace = array();
										while ($item = $rs->fetch_assoc())
										{
											$asearch[]  = str_replace('.', '\.', "/ {$item['abbrev']}/");
											$areplace[] = " <span title=\"{$item['description']}\" class=\"abbrev\">{$item['abbrev']}</span>";
										}
										
										$descStyle = preg_replace($asearch, $areplace, $descStyle);
										
										// Authors
										$rs = $mysqli->query("SELECT a.abbrev, a.description FROM abbrev a, abbrevtype at WHERE a.abbrevtypeid=at.id AND at.id = 1 ");
										
										$asearch = array();
										$areplace = array();
										while ($item = $rs->fetch_assoc())
										{
											$asearch[]  = str_replace('.', '\.', "/ {$item['abbrev']}/");
											$areplace[] = " <span title=\"{$item['description']}\" class=\"abbrevaut\">{$item['abbrev']}</span>";
										}
										
										$descStyle = preg_replace($asearch, $areplace, $descStyle);
										
										echo '<div style="text-align: justify;" id="wresult">';
										echo '<p><span class="gword">'.$row["gword"].'</span></p>';
										echo '<p style="text-align: justify;">' . nl2br(trim($descStyle)) . '</p>';
										echo '</div>';
									break;
									
									default:
										echo '<ul id="wrlist">';
										while ($row = $result->fetch_assoc())
										{
											echo '<li><a href="s.php?pattern='.$row["gword"].'">'.$row["gword"].'</a></li>';
										}
										echo '</ul>';
									break;
								}

								$result->close();
							}
							else
							{
								echo '<div id="wresult"><b>Erro ao processar esta consulta. Por favor tente novamente.</b></div>';
							}
						?>
					</form>
				</div>
			</div>
		</div>
		<div id="foot">
			<div class="wrap">
				<div id="footer">
					<div class="footitem">
						<span><b><i>Agradecimentos</i></b> às coordenadoras dos volumes impressos: M. Celeste C. Dezotti,&nbsp;Daisi Malhadas e M. Helena M. Neves e <a href="javascript:void()" onclick="showModalImg('id01', 1);">aos autores</a>; à colaboração da equipe do <a href="http://www.perseus.tufts.edu/hopper/" target="_blank" data-content="http://www.perseus.tufts.edu/hopper/" data-type="external">Perseus Project, Tufts U.</a> e <a href="http://www.dh.uni-leipzig.de/wo/" target="_blank" data-content="http://www.dh.uni-leipzig.de/wo/" data-type="external">Humboldt Chair of Digital Humanities, U. Leipzig</a>: G. Crane, M. Berti, B.Almas e T. Yousef.</span>
					</div>
					<div class="footitem">
						<span><b><i>Apoios</i></b> PPG em Linguística e Língua Portuguesa, Área de grego, Departamento de Linguística e DTI da </span>
						<a href="http://www.fclar.unesp.br/" target="_blank" data-content="http://www.fclar.unesp.br" data-type="external">FCL-Ar /UNESP</a>
						CNPq, FAPESP
					</div>
					<div class="footitem">
						<a href="https://github.com/aniseferreira/Grc-Por-DigDict">Projeto em desenvolvimento</a> por: Rúbens A. Rodrigues, <a href="mailto:anise@fclar.unesp.br?subject=DGP-digital" target="_self" data-content="anise@fclar.unesp.br" data-type="mail">Anise D'O. Ferreira</a> e  M. Celeste C. Dezotti - Letras Clássicas Digitais <a href="http://www.fclar.unesp.br/" target="_blank" data-content="http://www.fclar.unesp.br" data-type="external"> FCLAr/UNESP</a>
					</div>
					<div class="footitem">
						<span>2017 - <?php echo date('Y');?>  Esta obra está licenciada sob uma licença <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/" target="_blank" data-content="http://creativecommons.org/licenses/by-nc-sa/4.0/" data-type="external">Creative Commons Atribuição-NãoCommercial-CompartilhaIgual 4.0 International.</a></span>
					</div>
				</div>
			</div>
		</div>
		
		<div id="id01" class="w3-modal">
			<div class="w3-modal-content">
				<div class="w3-container">
					<span onclick="document.getElementById('id01').style.display='none'" class="w3-closebtn">&nbsp;&times;&nbsp;</span>
					
					<div class="w3-content w3-display-container">
						<iframe class="mySlides" src="autores.html" style="width:100%; height:500px;">
							<p>Your browser does not support iframes.</p>
						</iframe>
						<br>
					</div>
				</div>
			</div>
		</div>

		<script>
		var slideIndex = 1;
		showDivs(slideIndex);

		function showDivs(n) {
			var i;
			var x = document.getElementsByClassName("mySlides");
			if (n > x.length) {slideIndex = 1}    
			if (n < 1) {slideIndex = x.length}
			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";  
			}
			x[slideIndex-1].style.display = "block";  
		}

		function showModalImg(modalId, idx) {
			document.getElementById(modalId).style.display='block';
			showDivs(slideIndex = idx);
		}
		</script>
	</body>
</html>
