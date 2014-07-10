<?php
/**
 *
 */
include_once "Dao.php";
include_once "Variables.php";

//namespace sipcom\dal;
class DaoCallshop extends Dao{
	/**
	 * Get registed callshop
	 */
	public static function getCallshop(){
		$query = "SELECT * FROM callshop";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}

	/**
	 * Get callshop users
	 */
	public static function getUsersByFk_callshop($fk_callshop){
		$query = "SELECT * FROM `user` WHERE `fk_callshop` = '".$fk_callshop."';";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}

	/**
	 * Insert callshop
	 */
	public static function Callshop_Insert($societe, $addresse, $cp, $ville){
		$query = "INSERT INTO `callshop` (`societe` ,`addresse` ,`cp` ,`ville`) VALUES ('".$societe."', '".$addresse."' , '".$cp."', '".$ville."');";
		//echo $query;id	societe	addresse	cp	ville
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}

	/**
	 * Delete callshop by id
	 */
	public static function CallshopById_Delete($id){
		$query = "DELETE FROM `callshop` WHERE `id` = '".$id."';";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}
}
?>
