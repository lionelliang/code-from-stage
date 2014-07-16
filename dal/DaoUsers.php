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
		// do not use "select * ", datetime type exist. if not there would be a problem:
		//Unicode data in a Unicode-only collation or ntext data cannot be sent to clients using DB-Library
		
		$query = "SELECT codeclient, espaceclientIsEnabled, espaceclientLogin, espaceclientPass FROM clients WHERE espaceclientIsEnabled='1' AND espaceclientLogin='$username' AND espaceclientPass= '$password'";
		$db = Variables::$strSipcom;
		return self::executeMSSQLQuery($query, $db);
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
