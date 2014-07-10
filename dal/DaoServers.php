<?php
/**
 *
 */
include_once "Dao.php";
include_once "Variables.php";

//namespace sipcom\dal;
class DaoServers extends Dao{

	/**
	 * get all fax sent log
	 */
	public static function getServers(){
		$query = "SELECT * FROM servers;";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}

	/**
	 * Insert fax sent log
	 */
	public static function Servers_Insert($servername, $host, $port=NULL ,$username, $password, $timeout=NULL){
		$query = "INSERT INTO `servers` (`servername` ,`host` ,`port` ,`username` ,`password` ,`timeout`) VALUES ('".$servername."', '".$host."' , '".$port."', '".$username."', '".$password."', '".$timeout."');";
		//echo $query;
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}

	/**
	 * delete fax sent log by id
	 */
	public static function ServersById_Delete($id){
		$query = "DELETE FROM `servers` WHERE `id` = '".$id."';";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}
}
?>
