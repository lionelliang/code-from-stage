<?php

/**
 *
 */
include_once  __DIR__.DIRECTORY_SEPARATOR."AMI.php";
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/AsteriskManagement.php";
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/DaoQueue_member.php";
//namespace sipcom\bll;
//use sipcom\dal\AsteriskManagement;
class Queue_member extends AMI
{
	/**
	 * get QueuememeberByQueueName
	 */
	public static function QueuememeberByQueueName($queue_name){
		return DaoQueue_member::QueuememeberByQueueName($queue_name);
	}

	/**
	 * get all Bit_meetme
	 */
	public static function getQueue_member(){
		return DaoQueue_member::getQueue_member();
	}

	/**
	 * Insert a Bit_meetme
	 * $membername, $queue_name, $interface, $penalty, $paused
	 **/
	public static function Queue_member_Insert($membername, $queue_name, $interface, $penalty, $paused){
		return DaoQueue_member::Queue_member_Insert($membername, $queue_name, $interface, $penalty, $paused);
	}

	/**
	 * delete Bit_meetme by id
	 */
	public static function Queue_memberById_Delete($id){
		return DaoQueue_member::Queue_memberById_Delete($id);
	}
}
?>