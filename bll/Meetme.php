<?php

/**
 *
 */
include_once  __DIR__.DIRECTORY_SEPARATOR."AMI.php";
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/AsteriskManagement.php";
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/DaoBit_meetme.php";
//namespace sipcom\bll;
//use sipcom\dal\AsteriskManagement;
class Meetme extends AMI
{
	/** List all conferences or a specific conference.
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

	/** meetme kick Kick a conference or a user in a conference.
	 * @return
	 */
	public static function MeetmeKick($confno, $userno)
	{
		if(!isset($confno) || $confno == "")
		return false;
		if(!isset($userno) || $userno == "")
		return false;

		$command = "meetme kick ".$confno." ".$userno;
		AsteriskManagement::ExecuteCLICommand($command);
		$keys = self::getMeetmeAdminStatus();
		if($keys['value'] == 'OK' || $keys['value'] == 'ok'){
			return true;
		}else{
			echo $keys['value'];
			return false;
		}
	}

	/** meetme {lock|unlock} Lock or unlock a conference to new users.
	 * @return
	 */
	public static function MeetmeLock($confno, $tolock)
	{
		if(!isset($confno) || $confno == "")
		return false;
		if(!isset($tolock))
		return false;
		if($tolock){
			$command = "meetme lock ".$confno;
		}else{
			$command = "meetme unlock ".$confno;
		}
		$results = AsteriskManagement::ExecuteCLICommand($command);
		foreach ($results as $ret)
		echo $ret."<br>";
		$keys = self::getMeetmeAdminStatus();
		if($keys['value'] == 'OK' || $keys['value'] == 'ok'){
			return true;
		}else{
			echo $keys['value'];
			return false;
		}
	}

	/** meetme {mute|unmute} Mute or unmute a conference or a user in a conference.
	 * @return
	 */
	public static function MeetmeMute($confno, $toMute, $userno)
	{
		if(!isset($confno) || $confno == "")
		return false;
		if(!isset($toMute))
		return false;

		if($toMute)
		$command = "meetme mute ".$confno;
		else
		$command = "meetme unmute ".$confno;
		if(isset($userno) && $userno!="")
		$command = $command." ".$userno;
		else
		$command = $command." all";
		$results = AsteriskManagement::ExecuteCLICommand($command);
		foreach ($results as $ret)
		echo $ret."<br>";
		$keys = self::getMeetmeAdminStatus();
		if($keys['value'] == 'OK' || $keys['value'] == 'ok'){
			return true;
		}else{
			echo $keys['value'];
			return false;
		}
	}

	/** meetme MEETMEADMINSTATUS
	 * @return
	 */
	public static function getMeetmeAdminStatus()
	{
		$results = self::GetVar("MEETMEADMINSTATUS");
		if(strpos($results[0],"Success") == true){
			self::trimResult3($results);
			$keys = self::getContentByColon($results);
			return $keys;
		}else{
			return false;
		}
	}

	/**
	 * get all Bit_meetme
	 */
	public static function getBit_meetme(){
		return DaoBit_meetme::getBit_meetme();
	}

	/**
	 * Insert a Bit_meetme
	 */
	public static function Bit_meetme_Insert($confno, $starttime, $endtime, $pin, $opts=NULL, $adminpin=NULL, $adminopts=NULL, $members=NULL, $maxusers=NULL){
		return DaoBit_meetme::Bit_meetme_Insert($confno, $starttime, $endtime, $pin, $opts, $adminpin, $adminopts, $members, $maxusers);
	}

	/**
	 * delete Bit_meetme by id
	 */
	public static function Bit_meetmeById_Delete($confno){
		return DaoBit_meetme::Bit_meetmeById_Delete($confno);
	}
}
?>