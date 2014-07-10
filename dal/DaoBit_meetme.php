<?php
/**
 *
 */
include_once "Dao.php";
include_once "Variables.php";

//namespace sipcom\dal;
class DaoBit_meetme extends Dao{

	/**
	 * get all fax sent log
	 */
	public static function getBit_meetme(){
		$query = "SELECT * FROM bit_meetme;";
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}

	/**
	 * Insert fax sent log
	 */
	public static function Bit_meetme_Insert($confno, $starttime, $endtime, $pin, $opts=NULL, $adminpin=NULL, $adminopts=NULL, $members=NULL, $maxusers=NULL){
		$query = "INSERT INTO `bit_meetme` (`confno` ,`starttime` ,`endtime` ,`pin` ,`opts` ,`adminpin` ,`adminopts` ,`members` ,`maxusers`) VALUES ('".$confno."', '".$starttime."' , '".$endtime."', '".$pin."', '".$opts."', '".$adminpin."', '".$adminopts."', '".$members."', '".$maxusers."');";
		//echo $query;
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}

	/**
	 * delete fax sent log by id
	 */
	public static function Bit_meetmeById_Delete($confno){
		$query = "DELETE FROM `bit_meetme` WHERE `confno` = '".$confno."';";
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}
}
?>
