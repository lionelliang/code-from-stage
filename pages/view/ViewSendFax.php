<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Fax.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'../../dal/Variables.php';

if(count($_GET) > 0) {

	//$channel="SIP/0123456781";
	$exten = "3345";
	$context = "sipint";
	$priority = 1;
	$number = $_GET['number'];
	$file = $_GET['file'];
	if(!empty($number) && !empty($file)){
		$numerodefax = "Server";
		$channel = Variables::$strTrunk.$number;
		$uploaddir = '/var/www/sipcom/data/fax/faxsending/';
		$data = $uploaddir.$file;

		$path_parts = pathinfo($data);
		$extension = $path_parts['extension'];
		$filename = $path_parts['filename'];

		if (strtolower($extension) == 'pdf'){
			$outFile = $uploaddir.$filename.".tiff";
			Fax::pdf2Tiff($data, $outFile);
			$data = $outFile;
		}elseif (strtolower($extension) != 'tiff' && strtolower($extension) != 'tif'){
				echo "$file n'est pas tiff/pdf format\n";
			}
		if (file_exists($data)){

			if(Fax::sendFaxOutgoing($channel, $data)){
				echo "Réussir à envoyer fax à ".$channel."\n";
				Fax::faxSent_Insert($numerodefax, $number, $file);
			}else{
				echo "échec à envoyé fax à ".$channel."\n";
			}
		}else{
			echo "$data n\'existe pas\n";
		}
	}

}else{
	echo "mouvais parametres";
}