<?php
//webserviceFax.php
include_once __DIR__.DIRECTORY_SEPARATOR.'../bll/Fax.php';

function sendFax($number, $file, $idfaxrecord){

	//return "$number $file $idfaxrecord";
	if(!empty($number) && !empty($file) && !empty($idfaxrecord)){
		$exten = "3345";
		$context = "sipint";
		$priority = 1;

		if(!empty($number) && !empty($file)){
			$numerodefax = "Server";
			//$channel = "SIP/sipcomdevtrunk/".$number;
			$channel = "SIP/sipcomtrunk/".$number;
			$uploaddir = '/var/www/sipcom/data/fax/faxsending/';
			$faxfile = $uploaddir.$file;

			$path_parts = pathinfo($faxfile);
			$extension = $path_parts['extension'];
			$filename = $path_parts['filename'];

			if (strtolower($extension) == 'pdf'){
				$outFile = $uploaddir.$filename.".tiff";
				Fax::pdf2Tiff($faxfile, $outFile);
				$faxfile = $outFile;
			}elseif (strtolower($extension) != 'tiff'  && strtolower($extension) != 'tif'){
				return "$file n'est pas tiff/pdf format\n";
			}
			if (file_exists($faxfile)){

				if(Fax::sendFaxByExtension($channel, $faxfile, $idfaxrecord)){
					return "En train d'envoyer ".$file." à ".$channel."!\n";
					Fax::faxSent_Insert($numerodefax, $number, $file);
				}else{
					return "Echec d'envoyer ".$file." à ".$channel."!\n";
				}
			}else{
				return "$file n'exist pas\n";
			}
		}

	}else{
		return "Mouvais parametres";
	}
}

$server = new SoapServer("webserviceFax.wsdl");
$server->addFunction("sendFax");
$server->handle();
?>