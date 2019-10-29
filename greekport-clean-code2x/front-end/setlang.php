<?php
ob_start();

if ($_GET['lang'] == 'pt')
{
	setcookie( 'language', 'pt', time()+(60*60*24*30) );
}
else
{
	setcookie( 'language', 'en', time()+(60*60*24*30) );
}

ob_end_clean();
header('Refresh:0; url=index.php');
exit;
