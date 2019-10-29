<?php

require_once 'setup.php';

header('Content-Type: application/json; charset=utf-8');

$collection = array();
if (isset($_GET['param']))
{
	$param = $mysqli->escape_string(str_replace('*', '%', $_GET['param']));
	$sql  = "SELECT id, gword FROM gword WHERE gword like '{$param}%' ORDER BY gword ASC LIMIT 10";
	$rs = $mysqli->query($sql);
	if ($rs instanceof MySQLi_Result)
	{
		while ($a = $rs->fetch_assoc())
		{
			$collection[] = array
			(
				'id'    => $a['id'],
				'gword' => $a['gword']
			);
		}
	}
}

echo json_encode($collection);
flush();
