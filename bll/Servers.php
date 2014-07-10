<?php

/**
 *
 */
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/DaoServers.php";
class Servers
{

	/**
	 * get all servers
	 */
	public static function getServers(){
		return DaoServers::getServers();
	}

	/**
	 * Insert a server
	 */
	public static function Servers_Insert($servername, $host, $port=NULL, $username, $password, $timeout=NULL){
		return DaoServers::Servers_Insert($servername, $host, $port, $username, $password, $timeout);
	}

	/**
	 * delete servers by id
	 */
	public static function ServersById_Delete($id){
		return DaoServers::ServersById_Delete($id);
	}
}
?>
