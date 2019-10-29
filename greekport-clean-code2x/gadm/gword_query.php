<?php

header('Content-Type: application/json; charset=utf-8');

//DB
require_once 'db/DBMySqlConnection.php';
require_once 'db/DBMySqlResultSet.php';

//Model
require_once 'model/Entry.php';
require_once 'model/Gword.php';

//DAO
require_once 'dao/EntryDAO.php';
require_once 'dao/GwordDAO.php';

$collection = array();
if (isset($_GET['param']))
{
	$db = DBMySqlConnection::getInstance();
	$param = $db->escapeString(str_replace('*', '%', $_GET['param']));
	$sql  = "SELECT entryid, gword FROM gword WHERE gword like '{$param}%' ORDER BY gword ASC LIMIT 10";
	$rs = $db->query($sql);
	if ($rs instanceof DBMySqlResultSet)
	{
		while ($a = $rs->fetchAssoc())
		{
			$collection[] = array
			(
				'id'    => $a['entryid'],
				'gword' => $a['gword']
			);
		}
	}
}

echo json_encode($collection);
flush();
