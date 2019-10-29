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
require_once 'view/UserList.php';

//Model
require_once 'model/User.php';

//DAO
require_once 'dao/UserDAO.php';


//Delete record
if (isset($_GET['a']) && $_GET['a'] == 'del')
{
	if (isset($_GET['id']) && (int)$_GET['id'] > 0)
	{
		$id = (int) $_GET['id'];
		UserDAO::getInstance()->delete(UserDAO::getInstance()->findByPK($id));
	}
}

$clw = new UserList();
$clw->setStime(microtime());

$collection = null;
if (isset($_GET['param']))
{
	action_logger('UserList search for ' . $_GET['param']);
	$collection = UserDAO::getInstance()->getByHName($_GET['param']);
	$clw->setParam($_GET['param']);
}
else
{
	$collection = UserDAO::getInstance()->getFirst10();
}

$clw->setCollection($collection);
$clw->setEtime(microtime());

$cv = new HtmlView();
$cv->setTitle('Listagem de Usuários');

$ga = new GadmView();
$ga->setSessUser(session_user());
$ga->setContent($clw);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css">');
$cv->setBody($ga);
$cv->__toHtml();
$cv->write();

