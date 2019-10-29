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
require_once 'view/AbbrevForm.php';

//Model
require_once 'model/User.php';
require_once 'model/Abbrev.php';
require_once 'model/AbbrevType.php';

//DAO
require_once 'dao/AbbrevDAO.php';
require_once 'dao/AbbrevTypeDAO.php';


$_ABBREV = new Abbrev();
$_ABBREV->setAbbrevType(new AbbrevType);

$msg = '';
if(isset($_POST['id']) )
{
	$_ABBREV->setId((int) $_POST['id']);
	$_ABBREV->setAbbrev($_POST['abbrev']);
	$_ABBREV->setDescription($_POST['description']);
	$abt = AbbrevTypeDAO::getInstance()->findByPK($_POST['abbrevtypeid']);
	$_ABBREV->setAbbrevType($abt);
	
	if ($_ABBREV->getId() > 0)
	{
		$_OLDABBREV = AbbrevDAO::getInstance()->findByPK($_ABBREV->getId());
		action_logger("AbbrevForm update id {$_ABBREV->getId()} from [[{$_OLDABBREV->getAbbrevType()->getId()};;{$_OLDABBREV->getAbbrev()};;{$_OLDABBREV->getDescription()}]] to [[{$_ABBREV->getAbbrevType()->getId()};;{$_ABBREV->getAbbrev()};;{$_ABBREV->getDescription()}]]");
	}
	else
	{
		action_logger("AbbrevForm insert [[{$_ABBREV->getAbbrevType()->getId()};;{$_ABBREV->getAbbrev()};;{$_ABBREV->getDescription()}]]");
	}
	
	if(AbbrevDAO::getInstance()->save($_ABBREV))
	{
		header("Refresh:0; url=abbrev_list.php");
	}
}

// Recuperar registro do BD
if (isset($_GET['id']) && ((int)$_GET['id'] > 0))
{
	$id = (int) $_GET['id'];
	$_ABBREV = AbbrevDAO::getInstance()->findByPK($id);
}

$cv = new HtmlView();
$cv->setTitle('Cadastro de Abreviatura');

$collection = AbbrevTypeDAO::getInstance()->getAllOrderByDescription();
$cfw = new AbbrevForm();
$cfw->setAbbrev($_ABBREV);
$cfw->setCollection($collection);
$cfw->setMessage($msg);

$ga = new GadmView();
$ga->setSessUser(session_user());
$ga->setContent($cfw);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css">');
$cv->setBody($ga);

$cv->__toHtml();
$cv->write();
