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
require_once 'view/EntryList.php';

//Model
require_once 'model/Entry.php';
require_once 'model/User.php';
require_once 'model/Gword.php';

//DAO
require_once 'dao/EntryDAO.php';
require_once 'dao/GwordDAO.php';

//Delete record
if (isset($_GET['a']) && $_GET['a'] == 'del')
{
	if (isset($_GET['id']) && (int)$_GET['id'] > 0)
	{
		$id = (int) $_GET['id'];
		EntryDAO::getInstance()->delete(EntryDAO::getInstance()->findByPK($id));
	}
}

$clw = new EntryList();
$clw->setStime(microtime());

$collection = null;
if (isset($_GET['param']) || isset($_SESSION['param']))
{
	if (isset($_GET['param'])) {
		$clw->setParam($_GET['param']);
		if (strlen(trim($_GET['param'])) > 0)
		{
			action_logger('EntryList search for ' . $_GET['param']);
			$collection = GwordDAO::getInstance()->getByGword($_GET['param']);
			$_SESSION['param'] = $_GET['param'];
		}
		else if (isset($_SESSION['param']))
		{
			$collection = GwordDAO::getInstance()->getFirst20();
			unset($_SESSION['param']);
		}
		else
		{
			$collection = GwordDAO::getInstance()->getFirst20();
		}
	}
	else if (isset($_SESSION['param']))
	{
		$collection = GwordDAO::getInstance()->getByGword($_SESSION['param']);
		$clw->setParam($_SESSION['param']);
	}
}
else
{
	$collection = GwordDAO::getInstance()->getFirst20();
}

$clw->setCollection($collection);
$clw->setEtime(microtime());

$cv = new HtmlView();
$cv->setTitle('Listagem de Entradas');

$ga = new GadmView();
$ga->setSessUser(session_user());
$ga->setContent($clw);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css"><script type="text/javascript" src="js/greekcode.js"></script><script type="text/javascript" src="js/jquery/3.4.1/jquery.min.js"></script>');
$cv->setBody($ga);
$cv->__toHtml();
$cv->write();

