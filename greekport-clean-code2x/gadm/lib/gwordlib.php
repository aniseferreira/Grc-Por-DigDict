<?php

function gword_session_save(Gword $o)
{
	$_SESSION['gwords'][] = $o;
}
