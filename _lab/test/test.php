<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Fax.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'../../dal/Variables.php';

$username ="";
$codeclient = "1000";



	//$channel="SIP/0123456781";
	$exten = "3345";
	$context = "sipint";
	$priority = 1;
	$number = "0123456";
	$file = "fax.tiff";
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

			$result = Fax::msfax_Insert($codeclient, $number, $file);
			if($result){
				$idfaxrecord = mssql_result($result, 0, 'idfaxrecord');
				echo "pass";
			}
			echo $idfaxrecord.$codeclient.$number.$file;
	}
