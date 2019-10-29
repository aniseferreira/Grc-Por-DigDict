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
require_once 'view/AbbrevTypeForm.php';

//Model
require_once 'model/User.php';
require_once 'model/AbbrevType.php';

//DAO
require_once 'dao/AbbrevTypeDAO.php';


$_ABBREVTYPE = new AbbrevType();

$msg = '';
if(isset($_POST['id']) )
{
	$_ABBREVTYPE->setId((int) $_POST['id']);
	$_ABBREVTYPE->setDescription($_POST['description']);
	if ($_ABBREVTYPE->getId() > 0)
	{
		$_OLDABBREVTYPE = AbbrevTypeDAO::getInstance()->findByPK($_ABBREVTYPE->getId());
		action_logger("AbbrevTypeForm update id {$_ABBREVTYPE->getId()} from [[{$_OLDABBREVTYPE->getDescription()}]] to [[{$_ABBREVTYPE->getDescription()}]]");
	}
	else
	{
		action_logger("AbbrevTypeForm insert [[{$_ABBREVTYPE->getDescription()}]]");
	}
	
	if(AbbrevTypeDAO::getInstance()->save($_ABBREVTYPE))
	{
		header("Refresh:0; url=abbrev_type_list.php");
	}
}

// Recuperar registro do BD
if (isset($_GET['id']) && ((int)$_GET['id'] > 0))
{
	$id = (int) $_GET['id'];
	$_ABBREVTYPE = AbbrevTypeDAO::getInstance()->findByPK($id);
}

$cv = new HtmlView();
$cv->setTitle('Cadastro de Tipos de Abreviatura');

$cfw = new AbbrevTypeForm();
$cfw->setAbbrevType($_ABBREVTYPE);
$cfw->setMessage($msg);

$ga = new GadmView();
$ga->setSessUser(session_user());
$ga->setContent($cfw);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css">');
$cv->setBody($ga);

$cv->__toHtml();
$cv->write();
