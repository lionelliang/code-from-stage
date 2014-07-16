<?php
/**
 *
 */
include_once "Dao.php";
include_once "Variables.php";

//namespace sipcom\dal;
class DaoFax extends Dao{

	/**
	 * get all fax sent log
	 */
	public static function getFaxSent(){
		$query = "SELECT * FROM faxsent;";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}

	/**
	 * Insert fax sent log
	 */
	public static function faxSent_Insert($numerodefax ,$date ,$recude ,$fichier){
		$query = "INSERT INTO `faxsent` (`numerodefax` ,`date` ,`recude` ,`fichier`) VALUES ('".$numerodefax."', '".$date."' , '".$recude."', '".$fichier."');";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}
	/**
	 * log the sent fax in windows SQL server
	 * @param string $codeclient
	 * @param string $numerodefax
	 * @param string $date
	 * @param string $recude
	 * @param string $fichier
	 * @return mixed
	 */
	public static function msfax_Insert($codeclient, $number ,$date ,$file){
		$query = "INSERT INTO fax (fk_codeclient, destinationnumber, filename, dateupload, server)
						VALUES ('".$codeclient."', '".$number."', '".$file."' , '".$date."','".Variables::$strThisServerIP."' );
				  SELECT SCOPE_IDENTITY() AS idfaxrecord;";
		$db = Variables::$strSipcomweb;
		return self::executeMSSQLQuery($query, $db);
	}

	/**
	 * delete fax sent log by id
	 */
	public static function faxSentById_Delete($id){
		$query = "DELETE FROM `faxsent` WHERE `id` = '".$id."';";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}
	
	/**
	 * get all fax received log
	 */
	public static function getFaxReceived(){
		$query = "SELECT * FROM faxcdr;";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}


	/**
	 * delete fax received log by id
	 */
	public static function faxReceivedById_Delete($id){
		$query = "DELETE FROM `faxcdr` WHERE `id` = '".$id."';";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}
}
?>