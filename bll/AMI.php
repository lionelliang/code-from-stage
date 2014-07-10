<?php

/**
 *
 */
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/AsteriskManagement.php";
//namespace sipcom\bll;
//use sipcom\dal\AsteriskManagement;
class AMI
{
	/**
	 * login to asterisk server
	 */
	public static function Login($host=NULL, $port=NULL, $username=NULL, $password=NULL, $timeout=NULL){
		return AsteriskManagement::Login($host, $port, $username, $password, $timeout);
	}

	/**
	 * logout to asterisk server
	 */
	public static function Logout(){
		return AsteriskManagement::Logout();
	}

	/**
	 *
	 * getContentByEspace
	 * @param array $results
	 */
	public static function getContentByEspace($results){
		$i=0;
		$user_info;

		foreach ($results as $result) {
			$parse = preg_split ("/\s+/", trim($result));
			$j=0;
			foreach ($parse as $userinfo){
				$user_info[$i][$j++] = trim($userinfo);
				//echo $user_info[$i][$j-1]."  ";
				$a=$user_info[0][0];
			}
			$i += 1;
		}
		//echo $user_info[0][0];
		return $user_info;
	}

	/**
	 *
	 * getContentByColon
	 * @param unknown_type $results
	 */
	public static function getContentByColon($results){
		$keys=array();
		foreach ($results as $result) {
			//echo $result."<br>";
			$content = explode(':', $result);
			$name = strtolower(trim($content[0]));
			unset($content[0]);
			$value = isset($content[1]) ? trim(implode(':', $content)) : '';
			$keys[$name]=(string)$value;
			//echo $name." ".$keys[$name]."<br>";
		}
		return $keys;
	}

	/**
	 *
	 * Enter get Resum Infomation
	 * @param array $results
	 * @return array $parse_sys
	 */
	public static function getResumInfo($results){
		$resultSize=sizeof($results);
		echo $results[$resultSize-3]."<br>";
		$line_sys = $results[$resultSize-3];
		$parse_sys = preg_split ("/\s+/", trim($line_sys));
		return $parse_sys;
	}

	public static function trimResult(&$results){
		$resultSize=sizeof($results);
		unset($results[0]);						// remove Response: Follows
		unset($results[1]);						// remove Privilege: Command
		unset($results[$resultSize-3]);			// remove Result Infomation.
		unset($results[$resultSize-2]);			// remove --END COMMAND--
		unset($results[$resultSize-1]);			// remove  \r\n
	}

	public static function trimResult2(&$results){
		$resultSize=sizeof($results);
		unset($results[0]);						// remove Response: Follows
		unset($results[1]);						// remove Privilege: Command
		unset($results[2]);						// remove Response: Follows
		unset($results[3]);						// remove Privilege: Command
		unset($results[$resultSize-2]);			// remove --END COMMAND--
		unset($results[$resultSize-1]);			// remove  \r\n
	}
	
	public static function trimResult3(&$results){
		$resultSize=sizeof($results);
		unset($results[0]);						// remove Response: Success
		unset($results[$resultSize-1]);			// remove  \r\n
	}

	public static function isError($results){
		if(strpos($results[0], "Error") == true){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * GetVar("MEETMEADMINSTATUS")
	 */
	public static function GetVar($variable){
		return AsteriskManagement::GetVar($variable);
	}
}
?>