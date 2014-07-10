<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Fax.php';

if(count($_GET) > 0) {

	//$channel="SIP/0123456781";
	$exten = "3345";
	$context = "sipint";
	$priority = 1;
	$number = $_GET['number'];
	$file = $_GET['file'];
	if(!empty($number) && !empty($file)){
		$channel = "SIP/sipcomdevtrunk/".$number;
		$uploaddir = '/var/www/sipcom/data/fax/faxsending/';
		$data = $uploaddir.$file;
		if(Fax::sendFax($channel, $data)){
			echo "Send fax to ".$channel.", successful!\n";
		}else{
			echo "Send fax to ".$channel.", faild\n";
		}
	}

}else{
	echo "need parameters";
}

