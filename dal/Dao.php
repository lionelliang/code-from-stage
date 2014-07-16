<?php
include_once "Variables.php";
//namespace sipcom\dal;

class Dao{
	
	public static function execute_query($query,$db){
		try {
			$con = mysql_connect(Variables::$strMysqlIp,Variables::$strMysqlUser,Variables::$strMysqlPassword) or die(mysql_error());
		} catch (Exception $e) {
			die('Exception could not connect: ' . mysql_error());
		}
		if (!$con)
		  {
		  	die('Could not connect: ' . mysql_error());
		  }
		mysql_select_db($db, $con);
		$result = mysql_query($query);
		mysql_close($con);
		return $result;
	}
	
	/**
	 *
	 * common function to execute a query on remote microsoft sql server via tcp port 1433
	 * @param string $query
	 * @param string $db
	 */
	function executeMSSQLQuery($query, $db){
		try {
			$conMSSQL = mssql_connect(Variables::$strMicrosoftsqlIp, Variables::$strMicrosoftsqlUser, Variables::$strMicrosoftsqlPassword);
		} catch (Exception $e) {
			die('Exception could not connect: ' . mssql_error());
		}
		if (!isset($conMSSQL) || !$conMSSQL){
			die('Could not connect: ' . mysql_error());
		}
		
		mssql_select_db($db, $conMSSQL);
		return mssql_query($query, $conMSSQL);
	}
}
?>
