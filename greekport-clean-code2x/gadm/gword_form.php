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
require_once 'view/GwordForm.php';

//Model
require_once 'model/Entry.php';
require_once 'model/Gword.php';
require_once 'model/User.php';

//DAO
require_once 'dao/EntryDAO.php';
require_once 'dao/GwordDAO.php';



if (isset($_GET['eid']) && ((int)$_GET['eid'] > 0))
{
	$_SESSION['entry'] = serialize(EntryDAO::getInstance()->findByPK((int)$_GET['eid']));
}
else if (!isset($_SESSION['entry']))
{
	header("Refresh:0; url=entry_list.php");
	exit;
}

$msg = '';
$_GWORD = new Gword();
$_ENTRY = unserialize($_SESSION['entry']);

if(isset($_POST['id']))
{
	$_GWORD->setId((int) $_POST['id']);
	$_GWORD->setGword($_POST['gword']);
	$_GWORD->setEntry($_ENTRY);

	
	if ($_GWORD->getId() > 0)
	{
		$_OLDENTRY = GwordDAO::getInstance()->findByPK($_GWORD->getId());
		action_logger("GwordForm update id {$_GWORD->getId()} from [[{$_OLDENTRY->getGword()}}]] to [[{$_GWORD->getGword()}]]");
	}
	else
	{
		action_logger("GwordForm insert [[{$_GWORD->getGword()}]]");
	}
	
	if (GwordDAO::getInstance()->save($_GWORD))
	{
		$_GWORD = new Gword();
	}
	
}

$collection = GwordDAO::getInstance()->getByEntry($_ENTRY);

// Recuperar registro do BD
if (isset($_GET['id']) && ((int)$_GET['id'] > 0))
{
	$id = (int) $_GET['id'];
	$_GWORD = GwordDAO::getInstance()->findByPK($id);
	action_logger("GwordForm load {$_GWORD->getId()} {$_GWORD->getGword()}");
}

$cv = new HtmlView();
$cv->setTitle('Cadastro de Palavras');

$cfw = new GwordForm();
$cfw->setGword($_GWORD);
$cfw->setEntry($_ENTRY);
$cfw->setMessage($msg);
$cfw->setCollection($collection);

$ga = new GadmView();
$ga->setSessUser(session_user());
$ga->setContent($cfw);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css"><script type="text/javascript" src="js/greekcode.js"></script>');
$cv->setBody($ga);
$cv->__toHtml();
$cv->write();
