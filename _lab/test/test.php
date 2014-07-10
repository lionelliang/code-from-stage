<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../bll/Fax.php';
try
{
	$inFile = '/var/www/sipcom/data/fax/faxsending/fax-for.pdf';
	$outFile = '/var/www/sipcom/data/fax/faxsending/fax-for.tiff';
   	Fax::pdf2Tiff($inFile, $outFile);
   	
} catch (Exception $e) {
	echo $e->getMessage() . "\n";
}
?>
