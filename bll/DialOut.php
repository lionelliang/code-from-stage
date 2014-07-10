<?php
include_once  __DIR__.DIRECTORY_SEPARATOR."../dal/AsteriskManagement.php";
include_once  __DIR__.DIRECTORY_SEPARATOR."AMI.php";

class DialOut extends AMI{

	/**
	 * Originate Call
	 *
	 * @link http://www.voip-info.org/wiki-Asterisk+Manager+API+Action+Originate
	 * @param string $channel Channel name to call
	 * @param string $exten Extension to use (requires 'Context' and 'Priority')
	 * @param string $context Context to use (requires 'Exten' and 'Priority')
	 * @param string $priority Priority to use (requires 'Exten' and 'Context')
	 * @param string $application Application to use
	 * @param string $data Data to use (requires 'Application')
	 * @param integer $timeout How long to wait for call to be answered (in ms)
	 * @param string $callerid Caller ID to be set on the outgoing channel
	 * @param string $variable Channel variable to set (VAR1=value1|VAR2=value2)
	 * @param string $account Account code
	 * @param boolean $async true fast origination
	 * @param string $actionid message matching variable
	 */
	public static function Originate($channel, $exten, $context="sipint", $priority=1){
		$aMsg = AsteriskManagement::Originate($channel, $exten, $context, $priority);
		return $aMsg;
	}
}