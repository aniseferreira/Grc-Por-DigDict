<?php

define('VERSION', '1.3.2');

$lang = 'pt';
if (isset($_COOKIE['language']))
{
	if ($_COOKIE['language'] != 'pt')
	{
		$lang = 'en';
	}
}
else
{
	if (substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) != 'pt')
	{
		$lang = 'en';
	}
}

// Database routines
$mysqli = new mysqli('localhost', 'user', 'pass', 'database');

// check connection
if ($mysqli->connect_errno)
{
	printf("Connect failed: %s\n", $mysqli->connect_error);
	exit();
}

$mysqli->query("UPDATE counters SET access=access+1 LIMIT 1");
