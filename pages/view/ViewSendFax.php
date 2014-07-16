<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Fax.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'../../dal/Variables.php';

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
	header('Location: ./../../index.php');
}
$username = $_SESSION['username'];
$codeclient = $_SESSION['codeclient'];

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

			$result = Fax::msfax_Insert($codeclient, $number, $file);
			if($result){
				$idfaxrecord = mssql_result($result, 0, 'idfaxrecord');
			}
			echo $idfaxrecord.$codeclient.$number.$file;

			//if(Fax::sendFaxOutgoing($channel, $data)){
			if(Fax::sendFaxByExtension($channel, $data, $idfaxrecord)){
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