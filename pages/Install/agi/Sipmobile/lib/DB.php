<?php
require_once __DIR__.DIRECTORY_SEPARATOR.'Variables.php';

class DB{

	public static  $con;
	private $agi;

	/**
	 * mysql connection
	 */
	function __construct($agi){
		try {
			$this->con = mysql_connect(Variables::$strMysqlIp,Variables::$strMysqlUser,Variables::$strMysqlPassword);
			$this->agi = $agi;
			// Check connection
			if (!$this->con){
				$this->agi->conlog('Could not connect: ' . mysql_error());
			}
		} catch (Exception $e) {
			$e->getMessage();
		}
	}
	/**
	 *
	 * Enter description here ...
	 */
	function __destruct() {
		mysql_close($this->con);
	}

	/**
	 *
	 * common function to execute a query
	 * @param unknown_type $query
	 * @param unknown_type $db
	 */
	function executeQuery($query, $db){
		if (!$this->con){
			$this->con = mysql_connect(Variables::$strMysqlIp,Variables::$strMysqlUser,Variables::$strMysqlPassword);
		}
		mysql_select_db($db, $this->con);
		return mysql_query($query);
	}

	/**
	 *
	 * common insert function
	 * @example $toAdd = array('name'=>'Yo', 'balance' = 50);
	 * @example mysql_insert('sipcomcall', 'user', $toAdd);
	 * @param unknown_type $table
	 * @param unknown_type $toAdd
	 */
	function mysql_insert($db, $table, $toAdd){

		$fields = implode(array_keys($toAdd), ',');
		$values = "'".implode(array_values($toAdd), "','")."'";

		$query = 'INSERT INTO `'.$table.'` ('.$fields.') VALUES ('.$values.')';
		$res = $this->executeQuery($query, $db);
		return true;
	}

	/**
	 * common update function
	 * mysql_update('sipcomcall', 'user', array('name'=>$name, 'balance' => 50), "id=3,")
	 * @param unknown_type $table
	 * @param array $update
	 * @param condiction $where
	 */
	function mysql_update($db, $table, $update, $where){
		$fields = array_keys($update);
		$values = array_values($update);
		$i=0;
		$query="UPDATE ".$table." SET ";
		while($i < count($fields)){
			if($i>0){$query.=", ";}
			$query.=$fields[$i]." = '".$values[$i]."'";
			$i++;
		}
		$query.=" WHERE ".$where." LIMIT 1;";
		//echo $query;
		$this->executeQuery($query, $db);
		return true;
	}

	/**
	 * common select function
	 * @example mysql_select('sipcomcall', 'user', "name=0123456780")
	 * @example mysql_select('sipcomcall', 'user', "1")
	 * @param unknown_type $table
	 * @param condiction $where
	 * @return query result set
	 */
	function mysql_select($db, $table, $where){
		if(empty($where))
		$where = "1";
		$query="SELECT * FROM ".$table." WHERE ".$where.";";
		//echo $query;
		return $this->executeQuery($query, $db);
	}

	/**
	 * common delete function
	 * @example mysql_delete('sipcomcall', 'user', "name=0123456780")
	 * @param unknown_type $table
	 * @param condiction $where
	 */
	function mysql_delete($db, $table, $where){
		if(isset($where)){
			$query="DELETE FROM ".$table." WHERE ".$where." LIMIT 1;";
			return $this->executeQuery($query, $db);
		}else{
			return false;
		}

	}

	/**
	 *
	 * Enter description here ...
	 *
	 */
	public function user_Select(){
		$query="SELECT * FROM  `user`";
		return  $this->executeQuery($query, Variables::$strSipcomcall);
	}

	public function cdr_Insert($agi_callerid, $agi_calleridname, $agi_request,
	$agi_channel, $agi_language, $agi_type, $agi_uniqueid, $agi_context, $agi_extension,
	$agi_priority, $calldate){
		//$calldate = date("Y-m-d H:i:s", time());
		$toAdd = array(
				'agi_callerid' => $agi_callerid,
				'agi_calleridname' => $agi_calleridname,
				'agi_request' => $agi_request,
				'agi_channel' => $agi_channel,
				'agi_language' => $agi_language,
				'agi_type' => $agi_type,
				'agi_context' => $agi_context,
				'agi_extension' => $agi_extension,
				'agi_priority' => $agi_priority,
				'calldate' => $calldate,
				'agi_uniqueid' => $agi_uniqueid,
		);
		$this->mysql_insert(Variables::$strSipcomcall, "cdr", $toAdd);
	}

	public function cdr_Update($hangupcause, $dst, $starttime, $endtime, $duration, $bridgestart, $bridgeend, $id){

		$where = "id=".$id ;
		$update = array(
					'hangupcause' => $hangupcause,
					'dst' =>  $dst,
					'starttime' => $starttime,
					'endtime' => $endtime,
					'duration' => $duration,
					'bridgestart' => $bridgestart,
					'bridgeend' => $bridgeend,
		);
		$this->mysql_update(Variables::$strSipcomcall, "cdr", $update, $where);
	}

	public function getCEL($agi_uniqueid, $event){
		$where = "uniqueid='".$agi_uniqueid."' AND eventtype='".$event."'";//'BRIDGE_START'";
		return $this->mysql_select(Variables::$strAsterisk, "cel", $where);
	}

	public function getBalance($agi_calleridname){
		$where = "username='".$agi_calleridname."'";
		return $this->mysql_select(Variables::$strSipcomcall, "user", $where);
	}

	/**
	 *
	 * log faxtransmission infomation in sipcom.faxcdr
	 * @param string $agi_callerid
	 * @param string $agi_calleridname
	 * @param string $agi_request
	 * @param string $agi_channel
	 * @param string $agi_language
	 * @param string $agi_type
	 * @param string $agi_uniqueid
	 * @param string $agi_context
	 * @param string $agi_extension
	 * @param string $agi_priority
	 * @param string $calldate
	 */
	public function faxcdr_Insert($agi_callerid, $agi_calleridname,	$ecm, $filename, $headerinfo,
	$localstationid, $maxrate, $minrate, $pages, $rate, $remotestationid, $resolution,
	$status, $statusstr, $error, $agi_request, $agi_channel, $agi_language, $agi_callingpres,
	$agi_callingani2, $agi_callington, $agi_callingtns, $agi_rdnis, $agi_type, $agi_dnid,
	$agi_context, $agi_extension, $agi_priority,$agi_enhanced, $agi_threadid, $agi_uniqueid){
		
		$date = date("Y-m-d H:i:s");
		$toAdd = array(
				'agi_callerid' => $agi_callerid,
				'agi_calleridname' => $agi_calleridname,
				'date' => $date,
				'ecm' => $ecm,
				'filename' => $filename,
				'headerinfo' => $headerinfo,
				'localstationid' => $localstationid,
				'maxrate' => $maxrate,
				'minrate' => $minrate,
				'pages' => $pages,
				'rate' => $rate,
				'remotestationid' => $remotestationid,
				'resolution' => $resolution,
				'status' => $status,
				'statusstr' => $statusstr,
				'error' => $error,
				'agi_request' => $agi_request,
				'agi_channel' => $agi_channel,
				'agi_language' => $agi_language,
				'agi_callingpres' => $agi_callingpres,
				'agi_callingani2' => $agi_callingani2,
				'agi_callington' => $agi_callington,
				'agi_callingtns' => $agi_callingtns,
				'agi_rdnis' => $agi_rdnis,
				'agi_type' => $agi_type,
				'agi_dnid' => $agi_dnid,
				'agi_context' => $agi_context,
				'agi_extension' => $agi_extension,
				'agi_priority' => $agi_priority,
				'agi_enhanced' => $agi_enhanced,
				'agi_threadid' => $agi_threadid,
				'agi_uniqueid' => $agi_uniqueid,
		);
		$this->mysql_insert(Variables::$strSipcomcall, "faxcdr", $toAdd);
	}

}