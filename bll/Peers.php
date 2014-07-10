<?php

/**
 *
 */
use PAMI\Message\Event\PeerEntryEvent;
include_once  __DIR__.DIRECTORY_SEPARATOR."AMI.php";
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/AsteriskManagement.php";
//namespace sipcom\bll;
//use sipcom\dal\AsteriskManagement;
class Peers extends AMI
{

	/**
	 *@return $value[0]={123456780/0123456780,192.168.0.127,D,Yes,Yes,48886,OK}
	 *Name/username             Host                                    Dyn Forcerport Comedia    ACL Port     Status
	 *0123456780/0123456780     192.168.0.127                            D  Yes        Yes            48886    OK
		*$value[1] ={2,1,1,0,0}
		*2 sip peers [Monitored: 1 online, 1 offline Unmonitored: 0 online, 0 offline]
		*/
	public static function getPeers(){
		$results = AsteriskManagement::ExecuteCLICommand("sip show peers");
		if ($results){

			$parse_sys = self::getResumInfo($results);
			$sys_info[0] = $parse_sys[0];
			$sys_info[1] = $parse_sys[4];
			$sys_info[2] = $parse_sys[6];
			$sys_info[3] = $parse_sys[9];
			$sys_info[4] = $parse_sys[11];

			self::trimResult($results);
			unset($results[2]);						// reomove" Name/username Host Dyn Forcerport Comedia ACL Port Status Description Realtime

			$user_info = self::getContentByEspace($results);

			$value[0] = $user_info;
			$value[1] = $sys_info;

			return $value;
		}
	}

	/**
	 * Enter description here ...
	 * @param unknown_type $callerid
	 * @return Ambigous <string;, array;, boolean, string>
	 */
	public static function getPeerByCallerid($callerid){
		$results = AsteriskManagement::ExecuteCLICommand("sip show peer ".$callerid);

		if(self::isError($results)){
			echo $results[0];
			return false;
		}
		if(strpos($results[2],"not found") == true){
			echo $results[2];
			return false;
		}
		if ($results){
			self::trimResult2($results);
			$keys = self::getContentByColon($results);
			return $keys;
		}
	}

	/**
	 *Get status
	 *@return array;
	 */
	public static function GetServerStatus(){
		$resualts=AsteriskManagement::GetServerStatus();

		return $resualts;
	}

}
?>
