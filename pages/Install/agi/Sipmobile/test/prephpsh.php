<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'../lib/DB.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'../lib/phpagi.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'../lib/Appel.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'../lib/Variables.php';
require_once __DIR__.DIRECTORY_SEPARATOR.'../lib/phpagi-asmanager.php';
$agi = "";//new AGI();
$agimanager = new AGI_AsteriskManager();
//$appel = new Appel($agi);

$db = new DB($agi);
//$ret = $db->faxcdr_Insert(1, 2, 21, 24, 32, 231, 58, 5, 65, 65, 647, 64, 5, 95, 57, 8, 654, 5, 56, 31, 65, 36, 13, 5, 31, 54, 321, 58, 321, 658, 1);