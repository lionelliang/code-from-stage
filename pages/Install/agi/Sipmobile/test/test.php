#!/usr/bin/php -q
<?php
set_time_limit(30);
require_once __DIR__.DIRECTORY_SEPARATOR.'../lib/phpagi.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'../lib/Appel.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'../lib/phpagi-asmanager.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'../lib/Variables.php';
$start_time=time();
$agi = new AGI();

$agi->set_variable('Destination', "sip/0123456781");
$file = $agi->get_variable('Destination');
$agi->conlog($file['data']);
$end_time=time();
$agi->conlog($end_time-$start_time);
$agi->hangup();
?>