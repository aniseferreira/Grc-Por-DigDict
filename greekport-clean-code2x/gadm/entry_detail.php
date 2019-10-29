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
require_once 'view/EntryDetail.php';

//Model
require_once 'model/Entry.php';
require_once 'model/Gword.php';
require_once 'model/User.php';
require_once 'model/Abbrev.php';
require_once 'model/AbbrevType.php';

//DAO
require_once 'dao/EntryDAO.php';
require_once 'dao/GwordDAO.php';
require_once 'dao/AbbrevDAO.php';
require_once 'dao/AbbrevTypeDAO.php';


$_ENTRY = new Entry();

// Recuperar registro do BD
if (isset($_GET['id']) && ((int)$_GET['id'] > 0))
{
	$id = (int) $_GET['id'];
	$_ENTRY = EntryDAO::getInstance()->findByPK($id);
	action_logger("EntryForm load {$_ENTRY->getId()} {$_ENTRY->getGword()}");
}

$collection = GwordDAO::getInstance()->getByEntry($_ENTRY);

//print_r($collection); exit;

$cv = new HtmlView();
$cv->setTitle('Detalhe de Entrada');

$cfw = new EntryDetail();
$cfw->setEntry($_ENTRY);
$cfw->setGwords($collection);

$ga = new GadmView();
$ga->setSessUser(session_user());
$ga->setContent($cfw);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css"><script type="text/javascript" src="js/greekcode.js"></script>');
$cv->setBody($ga);
$cv->__toHtml();
$cv->write();
