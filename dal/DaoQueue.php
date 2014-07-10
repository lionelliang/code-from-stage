<?php
/**
 *
 */
include_once "Dao.php";
include_once "Variables.php";

//namespace sipcom\dal;
class DaoQueue extends Dao{

	/**
	 * get all fax sent log
	 */
	public static function getQueue(){
		$query = "SELECT * FROM queue_table;";
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}

	/**
	 * Insert fax sent log
	 */
	public static function Queue_Insert($name, $musiconhold=NULL, $announce=NULL, $context, $timeout=NULL, $monitor_join=NULL, $monitor_format=NULL, $queue_youarenext=NULL, $queue_thereare=NULL, $queue_callswaiting=NULL, $queue_holdtime=NULL, $queue_minutes=NULL, $queue_seconds=NULL, $queue_lessthan=NULL, $queue_thankyou=NULL, $queue_reporthold=NULL, $announce_frequency=NULL, $announce_round_seconds=NULL, $announce_holdtime=NULL, $retry=NULL, $wrapuptime=NULL, $maxlen=NULL, $servicelevel=NULL, $strategy=NULL, $joinempty=NULL, $leavewhenempty=NULL, $eventmemberstatus=NULL, $eventwhencalled=NULL, $reportholdtime=NULL, $memberdelay=NULL, $weight=NULL, $timeoutrestart=NULL, $periodic_announce=NULL, $periodic_announce_frequency=NULL, $ringinuse=NULL, $setinterfacevar=NULL){
		$query = "INSERT INTO `queue_table` (`name` ,`musiconhold` ,`announce` ,`context` ,`timeout` ,`monitor_join` ,`monitor_format` ,`queue_youarenext` ,`queue_thereare`,`queue_callswaiting`,`queue_holdtime`,`queue_minutes`,`queue_seconds`,`queue_lessthan`,`queue_thankyou`,`queue_reporthold`,`announce_frequency`,`announce_round_seconds`,`announce_holdtime`,`retry`,`wrapuptime`,`maxlen`,`servicelevel`,`strategy`,`joinempty`,`leavewhenempty`,`eventmemberstatus`,`eventwhencalled`,`reportholdtime`,`memberdelay`,`weight`,`timeoutrestart`,`periodic_announce`,`periodic_announce_frequency`,`ringinuse`,`setinterfacevar`) VALUES 
		('".$name."', '".$musiconhold."' , '".$announce."', '".$context."', '".$timeout."', '".$monitor_join."', '".$monitor_format."', '".$queue_youarenext."', '".$queue_thereare."', '".$queue_callswaiting."', '".$queue_holdtime."', '".$queue_minutes."', '".$queue_seconds."', '".$queue_lessthan."', '".$queue_thankyou."', '".$queue_reporthold."', '".$announce_frequency."', '".$announce_round_seconds."', '".$announce_holdtime."', '".$retry."', '".$wrapuptime."', '".$maxlen."', '".$servicelevel."', '".$strategy."', '".$joinempty."', '".$leavewhenempty."', '".$eventmemberstatus."', '".$eventwhencalled."', '".$reportholdtime."', '".$memberdelay."', '".$weight."', '".$timeoutrestart."', '".$periodic_announce."', '".$periodic_announce_frequency."', '".$ringinuse."', '".$setinterfacevar."');";
		//echo $query;
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}

	/**
	 * delete fax sent log by id
	 */
	public static function QueueById_Delete($name){
		$query = "DELETE FROM `queue_table` WHERE `name` = '".$name."';";
		$db = Variables::$strAsterisk;
		return self::execute_query($query, $db);
	}
}
?>
