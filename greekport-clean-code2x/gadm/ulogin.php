<?php

//Basic setup
require_once 'setup.php';
require_once 'lib/gadmlib.php';

//DB
require_once 'db/DBMySqlConnection.php';
require_once 'db/DBMySqlResultSet.php';

//View
require_once 'view/HtmlView.php';
require_once 'view/Ulogin.php';

//Model
require_once 'model/User.php';

//DAO
require_once 'dao/UserDAO.php';


$_USER = new User();

$msg = '';
if (isset($_POST['login']))
{
	$_USER = UserDAO::getInstance()->getByUName($_POST['uname']);
	if ($_USER == NULL)
	{
		$msg = 'Login inválido!';
	}
	else
	{
		if (strcmp($_USER->getUPass(), md5($_POST['upass'])) != 0)
		{
			$msg = 'Login inválido!';
		}
		else
		{
			session_user_login($_USER);
			header("Refresh:0; url=index.php");
			exit();
		}
	}
}
else if (isset($_GET['logout']))
{
	session_user_logout();
}

$cv = new HtmlView();
$cv->setTitle('Login');

$cfw = new Ulogin();
$cfw->setMessage($msg);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css">');
$cv->setBody($cfw);
$cv->__toHtml();
$cv->write();
