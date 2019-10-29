<?php

// logger 
function logger($msg)
{
	$dstr = date('Y-m-d H:i:s');
	GlogDAO::getInstance()->logMSG("[$dstr] $msg");
}

function action_logger($msg)
{
	$un = 'guest';
	if (isset($_SESSION['user']) && (($user = unserialize($_SESSION['user'])) instanceof User))
	{
		$un = $user->getUName();
	}
	
	logger("$un $msg");
}

// user session
function session_user_login(User $u)
{
	if ($u != NULL)
	{
		$_SESSION['user'] = serialize($u);
		$_SESSION['user_logged'] = 1;
		action_logger('logged in');
	}
}

function session_user_logged()
{
	if (isset($_SESSION['user_logged']))
	{
		return (bool) $_SESSION['user_logged'];
	}
	
	return FALSE;
}

function session_user_logout()
{
	$_SESSION['user_logged'] = 0;
	action_logger('logged out');
}

function session_user()
{
	if (! isset($_SESSION['user']))
	{
		return new User();
	}
	
	$u = unserialize($_SESSION['user']);
	if ($u instanceof User)
	{
		return $u;
	}
	else
	{
		return new User();
	}
}

function session_user_hasperm($p)
{
	if ($_SESSION['user'] instanceof User)
	{
		return ($p == $_SESSION['user']->getALevel());
	}
	
	return FALSE;
}

function require_login()
{
	if (!session_user_logged())
	{
		header("Refresh:0; url=ulogin.php");
		exit();
	}
}
