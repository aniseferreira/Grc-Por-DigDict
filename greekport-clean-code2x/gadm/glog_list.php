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
require_once 'view/GlogList.php';

//Model
require_once 'model/Glog.php';
require_once 'model/User.php';

//DAO
require_once 'dao/GlogDAO.php';

$clw = new GlogList();
$collection = array();
if (isset($_GET['param']) && !empty($_GET['param']))
{
	if ($_GET['stype'] == '1')
	{
		$d = date_create_from_format('d/m/Y', $_GET['param']);
		$collection =  GlogDAO::getInstance()->getByDate(strtotime($d->format('Y/m/d')));
	}

	if ($_GET['stype'] == '2')
	{
		$p1 = date_create_from_format('d/m/Y H:i:s', $_GET['param']);
		$p2 = date_create_from_format('d/m/Y H:i:s', $_GET['param2']);

		if ($p1 && $p2)
		{
			$collection =  GlogDAO::getInstance()->getByPeriod(
				strtotime($p1->format('Y/m/d H:i:s')),
				strtotime($p2->format('Y/m/d H:i:s'))
			);
		}
	}

		if ($_GET['stype'] == '3')
	{
		$collection =  GlogDAO::getInstance()->getByDesc($_GET['param']);
	}
	
	$clw->setParam($_GET['param']);
	$clw->setParam2($_GET['param2']);
}
else
{
	$collection = GlogDAO::getInstance()->getFirst20();
}

$clw->setCollection($collection);

$cv = new HtmlView();
$cv->setTitle('Listagem de ação');

$ga = new GadmView();
$ga->setSessUser(session_user());
$ga->setContent($clw);

$cv->setHeadStyle('<link rel="stylesheet" href="media/normalize.css"><link rel="stylesheet" href="media/main.css"><script type="text/javascript" src="js/greekcode.js"></script>');
$cv->setBody($ga);
$cv->__toHtml();
$cv->write();
