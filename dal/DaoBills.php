<?php
/**
 *
 */
include_once "Dao.php";
include_once "Variables.php";

//namespace sipcom\dal;
class DaoBills extends Dao{

	/**
	 * get unpaid users
	 */
	public static function getUnPaidBills(){
		$query = "SELECT * FROM `bills` WHERE `ispaid` = 0;";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}
}
?>
