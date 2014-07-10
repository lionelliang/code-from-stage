
<?php
/**
 *
 */
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/DaoUsers.php";
class Users{

	/**
	 * users login
	 * @param string $username
	 * @param string $password
	 * @return resource
	 */
	public static function login($username, $password){
		return DaoUsers::login($username, $password);
	}
	/**
	 * get registed users
	 */
	public static function getUsers(){
		$result = DaoUsers::getUsers();
		return $result;
	}
}
?>
