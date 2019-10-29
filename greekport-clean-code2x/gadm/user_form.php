<?php

//Basic setup
require_once 'setup.php';
require_once 'lib/gadmlib.php';

require_login(); // called here to avoid unecessary cpu usage

//DB
require_once 'db/DBMySqlConnection.php';
require_once 'db/DBMySqlResultSet.php';

//View
require_once 'view/HtmlView.php';
require_once 'view/GadmView.php';
require_once 'view/UserForm.php';

//Model
require_once 'model/User.php';

//DAO
require_once 'dao/UserDAO.php';


$_USER = new User();

$msg = '';
if(isset($_POST['id']) )
{
	$_USER->setId((int) $_POST['id']);
	$_USER->setHName($_POST['hname']);
	$_USER->setUName($_POST['uname']);
	if (!empty($_POST['upass']))
	{
		$_USER->setUPass(md5($_POST['upass']));
	}
	$_USER->setEnable((int)$_POST['enable']);
	$_USER->setALevel((int)$_POST['alevel']);
	
	if ($_USER->getId() > 0)
	{
		$_OLDUSER = UserDAO::getInstance()->findByPK($_USER->getId());
		action_logger("UserForm update id {$_USER->getId()} from [[{$_OLDUSER->getHName()};;{$_OLDUSER->getUName()};;{$_OLDUSER->getUPass()}]] to [[{$_USER->getHName()};;{$_USER->getUName()};;{$_USER->getUPass()}]]");
	}
	else
	{
		action_logger("UserForm insert [[{$_USER->getHName()};;{$_USER->getUName()};;{$_USER->getUPass()}]]");
	}
	
	if(UserDAO::getInstance()->save($_USER))
	{
		header("Refresh:0; url=user_list.php");
	}
	$_USER->setUPass('');
}

// Recuperar registro do BD
if (isset($_GET['id']) && ((int)$_GET['id'] > 0))
{
	$id = (int) $_GET['id'];
	$_USER = UserDAO::getInstance()->findByPK($id);
	$_USER->setUPass('');
}

$cv = new HtmlView();
$cv->setTitle('Cadastro de Usuário');

$cfw = new UserForm();
$cfw->setUser($_USER);
$cfw->setMessage($msg);

$ga = new GadmView();
$ga->setSessUser(session_user());
$ga->setContent($cfw);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css">');
$cv->setBody($ga);

$cv->__toHtml();
$cv->write();
