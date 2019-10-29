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
require_once 'view/EntryForm.php';

//Model
require_once 'model/Entry.php';
require_once 'model/Gword.php';
require_once 'model/User.php';

//DAO
require_once 'dao/EntryDAO.php';
require_once 'dao/GwordDAO.php';


$_ENTRY = new Entry();

$msg = '';
if(isset($_POST['id']) )
{
	$_ENTRY->setId((int) $_POST['id']);
	$_ENTRY->setGchar($_POST['gchar']);
	$_ENTRY->setGword($_POST['gword']);
	
	$_POST['pdesc'] = str_replace('<', '〈', str_replace('>', '〉', $_POST['pdesc']));
	$_ENTRY->setPdesc($_POST['pdesc']);
	
	$isnew = true;
	if ($_ENTRY->getId() > 0)
	{
		$isnew = false;
		$_OLDENTRY = EntryDAO::getInstance()->findByPK($_ENTRY->getId());
		action_logger("EntryForm update id {$_ENTRY->getId()} from [[{$_OLDENTRY->getGword()};;{$_OLDENTRY->getPdesc()}]] to [[{$_ENTRY->getGword()};;{$_ENTRY->getPdesc()}]]");
	}
	else
	{
		action_logger("EntryForm insert [[{$_ENTRY->getGword()};;{$_ENTRY->getPdesc()}]]");
	}
	
	if($e = EntryDAO::getInstance()->save($_ENTRY))
	{
		if ($isnew)
		{ 
			$gword = new Gword();
			$gword->setGword($_POST['gword']);
			$gword->setEntry($e);
			if (GwordDAO::getInstance()->save($gword))
			{
				action_logger("GwordForm insert [[{$gword->getGword()}}]]");
			}
		}
		
		header("Refresh:0; url=entry_detail.php?id={$e->getId()}");
		exit;
	}
}

// Recuperar registro do BD
if (isset($_GET['id']) && ((int)$_GET['id'] > 0))
{
	$id = (int) $_GET['id'];
	$_ENTRY = EntryDAO::getInstance()->findByPK($id);
	action_logger("EntryForm load {$_ENTRY->getId()} {$_ENTRY->getGword()}");
}

$cv = new HtmlView();
$cv->setTitle('Cadastro de Entrada');

$cfw = new EntryForm();
$cfw->setEntry($_ENTRY);
$cfw->setMessage($msg);

$ga = new GadmView();
$ga->setSessUser(session_user());
$ga->setContent($cfw);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css"><script type="text/javascript" src="js/greekcode.js"></script>');
$cv->setBody($ga);
$cv->__toHtml();
$cv->write();
