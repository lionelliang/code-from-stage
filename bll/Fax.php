<?php
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/DaoFax.php";

class Fax{

	/**
	 * Originate Call
	 *
	 * @link http://www.voip-info.org/wiki-Asterisk+Manager+API+Action+Originate
	 * @param string $channel Channel name to call
	 * @param string $exten Extension to use (requires 'Context' and 'Priority')
	 * @param string $context Context to use (requires 'Exten' and 'Priority')
	 * @param string $priority Priority to use (requires 'Exten' and 'Context')
	 * @param string $application Application to use
	 * @param string $data Data to use (requires 'Application')
	 * @param integer $timeout How long to wait for call to be answered (in ms)
	 * @param string $callerid Caller ID to be set on the outgoing channel
	 * @param string $variable Channel variable to set (VAR1=value1|VAR2=value2)
	 * @param string $account Account code
	 * @param boolean $async true fast origination
	 * @param string $actionid message matching variable
	 */
	/*
	 public static function sendFaxOriginate($channel, $exten, $context, $data){
		$aMsg = AsteriskManagement::Originate($channel, $exten, $context, 1, 'SendFax', $data, null, "FAX");
		return $aMsg;
		}*/

	/**
	 *
	 * send fax with .call file in /outging/, there no log
	 * @param string $channel Channel name to call
	 * @param string $data Data to use (requires 'Application')
	 * @param string $waittime
	 * @param string $maxretries
	 * @param string $retrytime
	 * @param string $account
	 * @param string $application Application to use
	 */
	public static function sendFaxOutgoing($channel, $data, $waittime = 120, $maxretries = 3, $retrytime = 300, $account = 10000, $application = "SendFax"){
		$msg = array(
		Channel => $channel,
		WaitTime => $waittime,
		Maxretries => $maxretries,
		RetryTime => $retrytime,
		Account => $account,
		Application => $application,
		Data => $data,
		);
		$req = "";
		foreach($msg as $var=>$val)
		$req .= "$var: $val\r\n";
		$name_sha1 = sha1_file($data);
		$callfile = "sendfax-".$name_sha1.".call";
		$file = "/var/www/sipcom/data/fax/tmp/".$callfile;
		file_put_contents($file, $req);
		$dest = "/var/spool/asterisk/outgoing/".$callfile;
		if(rename($file, $dest))
		return true;
		else
		return false;
	}

	/**
	 *
	 * send fax using extension send-tx/send update ms sql server record
	 * @param string $channel Channel name to call
	 * @param string $data Data to use (requires 'Application')
	 * @param string $waittime
	 * @param string $maxretries
	 * @param string $retrytime
	 * @param string $account
	 * @param string $application Application to use
	 */
	public static function sendFaxByExtension($channel, $faxfile, $idfaxrecord, $waittime = 120, 
			$maxretries = 3, $retrytime = 300, $callerid = "Fax", $context = "fax-tx", $extension = 'send'){
		$msg = array(
				Channel => $channel,
				WaitTime => $waittime,
				Maxretries => $maxretries,
				RetryTime => $retrytime,
				Callerid => $callerid,
				Context => $context,
				Extension => $extension,
				SetVar => "FAXFILE=".$faxfile,
		);
		$req = "";
		foreach($msg as $var=>$val)
			$req .= "$var: $val\r\n";
		$req .= "SetVar:idfaxrecord=$idfaxrecord\r\n";
		$name_sha1 = sha1_file($faxfile);
		$callfile = "sendfax-".$name_sha1.".call";
		$file = "/var/www/sipcom/data/fax/faxsending/".$callfile;
		file_put_contents($file, $req);
		//file_put_contents($callfile, $req);		//keep the call file to debug
		$dest = "/var/spool/asterisk/outgoing/".$callfile;
		//$dest = "/var/spool/asterisk/tmp/".$callfile;
		if(rename($file, $dest))
			return true;
		else
			return false;
	}
	
	/**
	 * 
	 * convert pdf file to tiff file
	 * @param string $inFile
	 * @param string $outFile
	 */
	public static function pdf2Tiff($inFile, $outFile){
		if (file_exists($inFile)){
			//$gs_command = "tiff2pdf -o ${$outFile} ${$inFile}";
			$gs_command = "gs -q -dNOPAUSE -dBATCH -sDEVICE=tiffg4 -sPAPERSIZE=a4 -sOutputFile=$outFile $inFile";
			system($gs_command, $retval);
			//echo $retval."\n";
			return $retval;
		}else{
			return false;
		}
	}

	/**
	 * get all fax log
	 */
	public static function getFaxSent(){
		return DaoFax::getFaxSent();
	}

	/**
	 * Insert fax log
	 */
	public static function faxSent_Insert($numerodefax ,$recude ,$file){
		$date = date("Y-m-d H:i:s"); 
		return DaoFax::faxSent_Insert($numerodefax, $date, $recude, $file);
	}

	public static function msfax_Insert($codeclient, $number ,$file){
		$date = date("Y-m-d H:i:s");
		return DaoFax::msfax_Insert($codeclient, $number, $date, $file);
	}
	
	/**
	 * delete fax log by id
	 */
	public static function faxSentById_Delete($id){
		return DaoFax::faxSentById_Delete($id);
	}

	/**
	 * get all fax received log
	 */
	public static function getFaxReceived(){
		return DaoFax::getFaxReceived();
	}


	/**
	 * delete fax received log by id
	 */
	public static function faxReceivedById_Delete($id){
		return DaoFax::faxReceivedById_Delete($id);
	}
}