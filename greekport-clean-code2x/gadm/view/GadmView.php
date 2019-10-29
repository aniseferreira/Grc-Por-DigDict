<?php

class GadmView
{
	private $content;
	private $sessUser;
	
	function setContent($c)
	{
		$this->content = $c;
	}
	
	function setSessUser(User $u)
	{
		$this->sessUser = $u;
	}
	
	function __toHtml()
	{
		return '
		<div id="wrap">
			<div id="header">'.$this->header().'</div>
			<div id="menu">'.$this->menu().'</div>
			<div id="contet">'.$this->content->__toHtml().'</div>
			<div id="footer"></div>
		</div>';
	}
	
	function header()
	{
		if (! $this->sessUser instanceof User)
		{
			$this->sessUser = new User();
		}
		return '<h1>Área administrativa</h1><div><span>'.$this->sessUser->getHName().' (<a href="ulogin.php?logout=1">Sair</a>)</span></div>';
	}
	
	function menu()
	{
		$r  = '<nav><ul><li><a href="index.php">Home</a></li>';
		$r .= ' <li><a href="entry_list.php">Entradas</a></li>';
		$r .= ' <li><a href="abbrev_list.php">Abreviaturas</a></li>';
		$r .= ($this->sessUser->getAlevel() < 2) ? ' <li><a href="user_list.php">Usuários</a></li>' : '';
		//$r .= ($this->sessUser->getAlevel() < 2) ? ' <li><a href="error_list.php">Erros</a></li>' : '';
		$r .= ($this->sessUser->getAlevel() < 2) ? ' <li><a href="glog_list.php">Log</a></li>' : '';
		
		$r .= '</ul></nav>';
		
		return $r;
	}
}
