<?php

define('SETUP', 1);

date_default_timezone_set('America/Sao_Paulo');


session_start();

header('Content-Type: text/html; charset=utf-8');

require_once 'model/Glog.php';
require_once 'dao/GlogDAO.php';
