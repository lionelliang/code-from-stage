<?php
/**
 *
 */
include_once "Dao.php";
include_once "Variables.php";

//namespace sipcom\dal;
class DaoUsers extends Dao{
	
	/**
	 * users login 
	 * @param string $username
	 * @param string $password
	 * @return resource
	 */
	public static function login($username, $password){
		$query = "SELECT * FROM utilisateurs WHERE login='$username' AND pwd= '$password'";
		$db = Variables::$strSipcomcall;
		return self::execute_query($query, $db);
	}
	
	/**
	 * get registed users
	 */
	public static function getUsers(){
		$query = "SELECT * FROM sippeers";
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}
}
?>
