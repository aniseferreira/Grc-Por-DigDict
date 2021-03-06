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
require_once 'view/AbbrevTypeList.php';

//Model
require_once 'model/User.php';
require_once 'model/AbbrevType.php';

//DAO
require_once 'dao/AbbrevTypeDAO.php';


//Delete record
if (isset($_GET['a']) && $_GET['a'] == 'del')
{
	if (isset($_GET['id']) && (int)$_GET['id'] > 0)
	{
		$id = (int) $_GET['id'];
		AbbrevTypeDAO::getInstance()->delete(AbbrevTypeDAO::getInstance()->findByPK($id));
	}
}

$clw = new AbbrevTypeList();
$clw->setStime(microtime());

$collection = AbbrevTypeDAO::getInstance()->getAll();
$clw->setCollection($collection);
$clw->setEtime(microtime());

$cv = new HtmlView();
$cv->setTitle('Listagem de Tipo de Abreviatura');

$ga = new GadmView();
$ga->setSessUser(session_user());
$ga->setContent($clw);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css">');
$cv->setBody($ga);
$cv->__toHtml();
$cv->write();

