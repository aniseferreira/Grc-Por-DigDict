<?php

class UserForm
{
	private $msg = '';
	
	private $o;
	
	function setUser(User $c)
	{
		$this->o = $c;
	}
	
	function setMessage($m)
	{
		$this->msg = $m;
	}
	
	function __toHtml()
	{
		if (!$this->o instanceof User)
			$this->o = new User();
		
		return '<br>
		<div style="text-align: right;">
			<a class="abuttom" href="user_list.php">Listar Usuários</a>
		</div>
		<form class="formbox formrecord" method="POST" action="user_form.php">
			<h2>Cadastro de Usuário</h2>
			<span>' . $this->msg . '</span>
			<input type="hidden" name="id" value="' . $this->o->getId() . '">
			
			Nome:<br>
			<input type="text" name="hname" value="' . $this->o->getHName() . '"><br><br>
			
			Login:<br>
			<input type="text" name="uname" value="' . $this->o->getUName() . '"><br><br>
			
			Senha:<br>
			<input type="password" name="upass" value="' . $this->o->getUPass() . '"><br><br>
			
			Ativo:<br>
			<input type="checkbox" name="enable" value="1" '.((bool)$this->o->getEnable()?"checked":"").'><br><br>
			
			Nível de acesso:<br>
			<select name="alevel">
				<option value="0"'.($this->o->getALevel()==0?" selected":"").'>Administrador</option>
				<option value="1"'.($this->o->getALevel()==1?" selected":"").'>Moderador</option>
				<option value="2"'.($this->o->getALevel()==2?" selected":"").'>Pesquisador</option>
				<option value="-1"'.($this->o->getALevel()==-1?" selected":"").'>ROOT</option>
			</select><br><br>
			<input type="submit" value="Gravar"><br><br>
		</form>';
	}
}
