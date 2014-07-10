#!/usr/bin/php -q
<?php
set_time_limit(30);
require_once __DIR__.DIRECTORY_SEPARATOR.'lib/phpagi.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'lib/Appel.php';

$starttime = time();
$agi = new AGI();
$appel = new Appel($agi);

$agi->set_variable("starttime", $starttime);

$agi->text2wav("Welcome");
	$destination = $appel->getDestination("Please enter your conference number, end with #");
	$agi->set_variable("Destination", $destination);		//3345,3346,pwd=123546
	$agi->text2wav("Attend to ".$destination);
	$agi->conlog("Destination: $destination");
?>
