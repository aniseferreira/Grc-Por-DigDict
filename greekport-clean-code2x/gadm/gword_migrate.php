<?php

//DB
require_once 'db/DBMySqlConnection.php';
require_once 'db/DBMySqlResultSet.php';

$db = DBMySqlConnection::getInstance();

$sql = "TRNCATE TABLE gword";
$rs = $db->query($sql);

$sql = "SELECT id, gword FROM entry ORDER BY id";
$rs = $db->query($sql);
while ($a = $rs->fetchAssoc())
{
	$db->query(
		sprintf("INSERT INTO gword (entryid, gword) VALUES (%s, '%s')",
			$a['id'],
			$a['gword']
		)
	);
}
