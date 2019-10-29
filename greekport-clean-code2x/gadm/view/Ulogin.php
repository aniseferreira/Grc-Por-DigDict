<?php

class Ulogin
{
	private $msg = '';
	
	function setMessage($m)
	{
		$this->msg = $m;
	}
	
	function __toHtml()
	{
		return '
		<form class="formbox formlogin formrecord" method="POST" action="ulogin.php">
			<h2>Login</h2>
			'.$this->msg.'<br><br>
			Login:<br>
			<input type="text" name="uname" value=""><br><br>
			
			Senha:<br>
			<input type="password" name="upass" value=""><br><br>
			<input type="submit" name="login" value="Login"><br><br>
		</form>';
	}
}
