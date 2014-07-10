<?php
/**
 *
 */
include_once "Dao.php";
include_once "Variables.php";

//namespace sipcom\dal;
class DaoQueue_member extends Dao{

	/**
	 * get all fax sent log
	 */
	public static function getQueue(){
		$query = "SELECT * FROM queue_table;";
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}

	/**
	 * get all fax sent log
	 */
	public static function QueuememeberByQueueName($queue_name){
		$query = "SELECT * FROM queue_member_table where queue_name = '".$queue_name."';";
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}

	/**
	 * Insert fax sent log
	 */
	public static function Queue_member_Insert($membername, $queue_name, $interface, $penalty, $paused){
		$query = "INSERT INTO `queue_member_table` (`membername` ,`queue_name` ,`interface` ,`penalty` ,`paused`) VALUES 
		('".$membername."', '".$queue_name."' , '".$interface."', '".$penalty."', '".$paused."');";
		//echo $query;
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}

	/**
	 * delete fax sent log by id
	 */
	public static function Queue_memberById_Delete($id){
		$query = "DELETE FROM `queue_member_table` WHERE `uniqueid` = '".$id."';";
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}


}
?>
