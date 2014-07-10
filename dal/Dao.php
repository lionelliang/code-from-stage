<?php
/**
* 
*/
include_once "Variables.php";
//namespace sipcom\dal;

class Dao{
	
	public static function execute_query($query,$db){
		$con = mysql_connect(Variables::$strMysqlIp,Variables::$strMysqlUser,Variables::$strMysqlPassword) or die(mysql_error());
		if (!$con)
		  {
		  die('Could not connect: ' . mysql_error());
		  }
		mysql_select_db($db, $con);
		$result = mysql_query($query);
		mysql_close($con);
		return $result;
	}
}
?>
