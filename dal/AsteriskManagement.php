<?php
include_once  __DIR__.DIRECTORY_SEPARATOR."Variables.php";
//namespace sipcom\dal;

class AsteriskManagement {

	public static $socket;
	public static $error;

	/**
	 *login to asterisk server
	 */
	public static function Login($host, $port, $username, $password, $timeout){
		if(!isset($host)) $host=Variables::$strAsteriskIp;
		if(!isset($port) || $port == '0') $port=Variables::$strAsteriskPort;
		if(!isset($username)) $username=Variables::$strAsteriskUser;
		if(!isset($password)) $password=Variables::$strAsteriskPassword;
		if(!isset($timeout) || $timeout == '0') $timeout=Variables::$strAsteriskTimeOut;
		self::$socket = @fsockopen($host,$port, $errno, $errstr, $timeout);
		if (!self::$socket) {
			self::$error =  "Could not connect - $errstr ($errno)";
			//echo self::$error;
			return FALSE;
		}else{
			stream_set_timeout(self::$socket, 1);

			$wrets = self::QueryNoResult("Action: Login\r\nUserName: $username\r\nSecret: $password\r\nEvents: off\r\n\r\n");

			if (strpos($wrets, "Message: Authentication accepted") != FALSE){
				return true;
			}else{
				self::$error = "Could not login - Authentication failed";
				fclose(self::$socket);
				self::$socket = FALSE;
				return FALSE;
			}
		}
	}

	/**
	 *logout asterisk server
	 */
	public static function Logout(){
		if (self::$socket){
			$wrets = "";
			fputs(self::$socket, "Action: Logoff\r\n\r\n");
			while (!feof(self::$socket)) {
				$wrets .= fread(self::$socket, 8192);
			}
			fclose(self::$socket);
			self::$socket = "FALSE";
		}
	}


	/**
	 *execute a cli command
	 *ExecuteCLI("sip show peers");
	 *@return array;
	 */
	public static function ExecuteCLICommand($command){
		//$wrets = self::QueryNoResult("Action: Command\r\ncommand: ".$command."\r\n\r\n");
		$resualts=self::QueryLine("Action: Command\r\ncommand: ".$command."\r\n\r\n");
		return $resualts;
	}

	/**
	 *execute a cli command
	 *ExecuteCLI("sip show peers");
	 *@return array;
	 */
	public static function GetVar($variable){
		//$wrets = self::QueryNoResult("Action: Command\r\ncommand: ".$command."\r\n\r\n");
		$resualts=self::QueryLine("Action: GetVar\r\nVariable: ".$variable."\r\n\r\n");
		return $resualts;
	}

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
	public static function Originate($channel,
	$exten=NULL, $context=NULL, $priority=1,
	$application=NULL, $data=NULL,
	$timeout=NULL, $callerid=NULL, $variable=NULL, $account=NULL, $async=NULL, $actionid=NULL)
	{

		//save the variable and its value in the array 
		$parameters = array('Action'=>'Originate');
		if($channel) $parameters['Channel'] = $channel;

		if($exten) $parameters['Exten'] = $exten;
		if($context) $parameters['Context'] = $context;
		if($priority) $parameters['Priority'] = $priority;

		if($application) $parameters['Application'] = $application;
		if($data) $parameters['Data'] = $data;

		if($timeout) $parameters['Timeout'] = $timeout;
		if($callerid) $parameters['CallerID'] = $callerid;
		if($variable) $parameters['Variable'] = $variable;
		if($account) $parameters['Account'] = $account;
		if(!is_null($async)) $parameters['Async'] = ($async) ? 'true' : 'false';
		if($actionid) $parameters['ActionID'] = $actionid;

		//convert the array to string
		$lineAction = self::getExpression($parameters);
		//
		$aMsg = self::QueryNoResult($lineAction);
		return $aMsg;
	}

	/**
	 *Get status
	 *@return array;
	 */
	public static function GetServerStatus(){
		$resualts=self::QueryLine("Action: Status\r\n\r\n");
		return $resualts;
	}

	/**
	 *read configuration file users.conf
	 *ReadUsersConfig();
	 *@return array();
	 */
	public static function ReadUsersConfig(){
		$value;
		$wrets = self::QueryNoResult("Action: GetConfig\r\nFilename: users.conf\r\n\r\n");

		if ($wrets){
			$value_start = strpos($wrets, "Response: Success\r\n") + 19;
			$value_stop = strpos($wrets, "--END COMMAND--\r\n", $value_start);
			if ($value_start > 18){
				$wrets = substr($wrets, $value_start, $value_stop - $value_start);
			}
			$lines = explode("\n", $wrets);
			foreach($lines as $line){
				if (strlen($line) > 4){
					$key_start = strpos($line, ": ") + 2;
					$key_stop = strpos($line, "=", $key_start);
					$key_length = strpos($line, "=") - strpos($line, ": ")-2;
					$key = substr($line, $key_start, $key_length);
					// echo $key."\r";
					$value_start = strpos($line, "=") + 1;
					$value_stop = strpos($line, " ", $value_start);
					$value_length = strpos($line, " ") - strpos($line, "=");
					$value[$key] = substr($line, $value_start);
				}
			}
			return $value;
		}
	}


	function GetError(){
		return self::$error;
	}

	function GetDB($family, $key){
		$value = "";

		$wrets = self::QueryNoResult("Action: Command\r\nCommand: database get $family $key\r\n\r\n");

		if ($wrets){
			$value_start = strpos($wrets, "Value: ") + 7;
			$value_stop = strpos($wrets, "\n", $value_start);
			if ($value_start > 8){
				$value = substr($wrets, $value_start, $value_stop - $value_start);
			}
		}
		return $value;
	}

	function PutDB($family, $key, $value){
		$wrets = self::QueryNoResult("Action: Command\r\nCommand: database put $family $key $value\r\n\r\n");

		if (strpos($wrets, "Updated database successfully") != FALSE){
			return TRUE;
		}
		self::$error =  "Could not updated database";
		return FALSE;
	}

	function DelDB($family, $key){
		$wrets = self::QueryNoResult("Action: Command\r\nCommand: database del $family $key\r\n\r\n");

		if (strpos($wrets, "Database entry removed.") != FALSE){
			return TRUE;
		}
		self::$error =  "Database entry does not exist";
		return FALSE;
	}


	function GetFamilyDB($family){
		$wrets = self::QueryNoResult("Action: Command\r\nCommand: database show $family\r\n\r\n");
		if ($wrets){
			$value_start = strpos($wrets, "Response: Follows\r\n") + 19;
			$value_stop = strpos($wrets, "--END COMMAND--\r\n", $value_start);
			if ($value_start > 18){
				$wrets = substr($wrets, $value_start, $value_stop - $value_start);
			}
			$lines = explode("\n", $wrets);
			foreach($lines as $line){
				if (strlen($line) > 4){
					$value_start = strpos($line, ": ") + 2;
					$value_stop = strpos($line, " ", $value_start);
					$key = trim(substr($line, strlen($family) + 2, strpos($line, " ") - strlen($family) + 2));
					$value[$key] = trim(substr($line, $value_start));
				}
			}
			return $value;
		}
		return FALSE;
	}

	/**
	 * common function: Send Command to Server with string returned
	 * @return string;
	 */
	public static function QueryNoResult($query){
		$wrets = "";
		//=== for object comparision
		if (self::$socket === FALSE)
		return FALSE;

		fputs(self::$socket, $query);
		do
		{
			$line = fgets(self::$socket, 4096);
			//echo $line."<br>";
			$wrets .= $line;
			$info = stream_get_meta_data(self::$socket);
		}while ($line != "\r\n" && $info['timed_out'] == false );
		return $wrets;
	}

	/**
	 * common function: Send Command to Server with array returned
	 * @return array;
	 */
	public static function QueryLine($query){
		$results = array();
		$i=0;

		if (self::$socket === FALSE)
		return FALSE;

		fputs(self::$socket, $query);
		do
		{
			$line = fgets(self::$socket, 4096);
			$results[] = trim($line);
			//echo $results[$i++]."<br>";
			$info = stream_get_meta_data(self::$socket);
		}while ($line != "\r\n" && $info['timed_out'] == false );
		return $results;
	}

	/**
	 *
	 * common function: convert a paramaters array to AMI string
	 * @param array $parameters
	 */
	public static function getExpression($parameters){
		$req = "";
		foreach($parameters as $var=>$val)
		$req .= "$var: $val\r\n";
		$req .= "\r\n";
		return $req;
	}
}
?>
