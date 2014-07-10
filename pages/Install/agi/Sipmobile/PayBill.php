#!/usr/bin/php -q
<?php
set_time_limit(30);
require_once __DIR__.DIRECTORY_SEPARATOR.'lib/phpagi.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'lib/Appel.php';


$starttime = time();
$agi = new AGI();
$appel = new Appel($agi);

$id = $appel->cdr_Insert();

$cid = $agi->parse_callerid();

$welcommessage = 'Welcome to sipcom paying platform';
if(!isset($cid['username'])){
	$agi->conlog("GetInfo: {$cid['username']}");
	//$welcommessage += "Mr {$cid['username']}"; 
}
$agi->text2wav('Hello', '1');
$agi->text2wav($welcommessage, '1');

$choices=array('1'=>'*Pay by credit card press 1', // text2wav reads if prompt starts with * else stream_file
 '2'=>'*Pay by RIB press 2',
 '3'=>'*For support Press 3');
$keys=$agi->menu($choices, 5000);
$agi->conlog("Get choice: {$keys}");
switch ($keys){
	case '1':
		$agi->text2wav('You choose to pay by credit card');
		$destination = $appel->getDestination('Please enter your credit card number, end with #', 20);
		$agi->text2wav("You entered $destination");
		break;
	case '2':
		$agi->text2wav('You choose to pay by RIB');
		break;
	case '3':
		$agi->text2wav('Welcom to support');
		break;
	default:
		$agi->text2wav('Do not get right choice, please try again');
		break;
}

$agi->text2wav('Goodbye');

$endtime = time();
$duration = $endtime-$starttime;
$agi->conlog("Reponce duration:{$duration}");
$appel->cdr_Update($starttime, $endtime, $id);

$agi->hangup();
?>
