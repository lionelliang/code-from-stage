<?php

/**
 *
 */
include_once  __DIR__.DIRECTORY_SEPARATOR."AMI.php";
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/AsteriskManagement.php";
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/DaoQueue.php";
//namespace sipcom\bll;
//use sipcom\dal\AsteriskManagement;
class Queue extends AMI
{
	/**
	 * Conf Num Parties Marked Activity Creation Locked
	 * 3345 0002	 N/A 00:39:32 Static No
	 * Total number of MeetMe users: 2
	 * Meetme Action
	 * @param string $conference
	 * @return $value[0][0]={3345 0002	 N/A 00:39:32 Static No}
	 */
	public static function MeetmeList()
	{
		$command = "meetme list";
		$results = AsteriskManagement::ExecuteCLICommand($command);
		if(self::isError($results)){
			echo $results[0];
			return false;
		}
		if(strpos($results[2],"No active MeetMe conferences") == true){
			echo $results[2];
			return false;
		}
		if ($results){
			$parse_sys = self::getResumInfo($results); 	//echo 1 users in that conference.
			$sys_info = $parse_sys[0];					//$sys_info = 1
			self::trimResult($results);
			unset($results[2]);						// remove Conf Num       Parties        Marked     Activity  Creation  Locked
			$user_info = self::getContentByEspace($results);

			$value[0] = $user_info;
			$value[1] = $sys_info;

			return $value;
		}
	}

	/**
	 * User #: 01 00123456781 00123456781 Channel: SIP/0123456781-00000003 (unmonitored) 00:49:45
	 * 1 users in that conference.
	 * @param string $conference
	 * @return $value[0][0]={3345 0002	 N/A 00:39:32 Static No}
	 */
	public static function MeetmeListDetail($conference)
	{
		if(!isset($conference) || $conference == "")
		return false;
		$command = "meetme list ".$conference;
		$results = AsteriskManagement::ExecuteCLICommand($command);
		if(strpos($results[0],"Error") == true){
			echo $results[0];
			return false;
		}
		if ($results){

			$parse_sys = self::getResumInfo($results); 	//echo 1 users in that conference.
			$sys_info = $parse_sys[0];					//$sys_info = 1
			self::trimResult($results);

			$user_info = self::getContentByEspace($results);

			$value[0] = $user_info;
			$value[1] = $sys_info;

			return $value;
		}
	}

	/**
	 * get all Bit_meetme
	 */
	public static function getQueue(){
		return DaoQueue::getQueue();
	}

	/**
	 * Insert a Bit_meetme
	 */
	public static function Queue_Insert($name, $musiconhold=NULL, $announce=NULL, $context=NULL, $timeout=NULL, $monitor_join=NULL, $monitor_format=NULL, $queue_youarenext=NULL, $queue_thereare=NULL, $queue_callswaiting=NULL, $queue_holdtime=NULL, $queue_minutes=NULL, $queue_seconds=NULL, $queue_lessthan=NULL, $queue_thankyou=NULL, $queue_reporthold=NULL, $announce_frequency=NULL, $announce_round_seconds=NULL, $announce_holdtime=NULL, $retry=NULL, $wrapuptime=NULL, $maxlen=NULL, $servicelevel=NULL, $strategy=NULL, $joinempty=NULL, $leavewhenempty=NULL, $eventmemberstatus=NULL, $eventwhencalled=NULL, $reportholdtime=NULL, $memberdelay=NULL, $weight=NULL, $timeoutrestart=NULL, $periodic_announce=NULL, $periodic_announce_frequency=NULL, $ringinuse=NULL, $setinterfacevar=NULL){
		return DaoQueue::Queue_Insert($name, $musiconhold, $announce, $context, $timeout, $monitor_join, $monitor_format, $queue_youarenext, $queue_thereare, $queue_callswaiting, $queue_holdtime, $queue_minutes, $queue_seconds, $queue_lessthan, $queue_thankyou, $queue_reporthold, $announce_frequency, $announce_round_seconds, $announce_holdtime, $retry, $wrapuptime, $maxlen, $servicelevel, $strategy,$joinempty, $leavewhenempty, $eventmemberstatus, $eventwhencalled, $reportholdtime, $memberdelay, $weight, $timeoutrestart, $periodic_announce, $periodic_announce_frequency, $ringinuse, $setinterfacevar);
	}

	/**
	 * delete Bit_meetme by id
	 */
	public static function QueueById_Delete($name){
		return DaoQueue::QueueById_Delete($name);
	}
}
?>