<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Queue.php';
echo "ojojj";
if(count($_GET) > 0) {
	echo "ojojj";
	$method = trim($_GET['method']);
	switch ($method){
		case 'delete':
			{
				unset($_GET['method']);
				foreach ($_GET as $key => $value){
					$value = trim($value);
					if(Queue::QueueById_Delete($value))
					echo "Chambre $value est supprimé\n";
				}
			}
			break;
		case 'insert':
			$name=$musiconhold=$announce=$context=$timeout=$monitor_join=$monitor_format=$queue_youarenext=$queue_thereare=$queue_callswaiting=$queue_holdtime=$queue_minutes=$queue_seconds=$queue_lessthan=$queue_thankyou=$queue_reporthold=$announce_frequency=$announce_round_seconds=$announce_holdtime=$retry=$wrapuptime=$maxlen=$servicelevel=$strategy=$joinempty=$leavewhenempty=$eventmemberstatus=$eventwhencalled=$reportholdtime=$memberdelay=$weight=$timeoutrestart=$periodic_announce=$periodic_announce_frequency=$ringinuse=$setinterfacevar=null;
			if(isset($_GET['name']) && trim($_GET['name'])!="") $name=trim($_GET['name']);
			if(isset($_GET['musiconhold']) && trim($_GET['musiconhold'])!="") $musiconhold=trim($_GET['musiconhold']);
			if(isset($_GET['announce']) && trim($_GET['announce'])!="") $announce=trim($_GET['announce']);
			if(isset($_GET['context']) && trim($_GET['context'])!="") $context=trim($_GET['context']);
			if(isset($_GET['timeout']) && trim($_GET['timeout'])!="") $timeout=trim($_GET['timeout']);
			if(isset($_GET['monitor_join']) && trim($_GET['monitor_join'])!="") $monitor_join=trim($_GET['monitor_join']);
			if(isset($_GET['monitor_format']) && trim($_GET['monitor_format'])!="") $monitor_format=trim($_GET['monitor_format']);
			if(isset($_GET['queue_youarenext']) && trim($_GET['queue_youarenext'])!="") $queue_youarenext=trim($_GET['queue_youarenext']);
			if(isset($_GET['queue_thereare']) && trim($_GET['queue_thereare'])!="") $queue_thereare=trim($_GET['queue_thereare']);
			if(isset($_GET['queue_callswaiting']) && trim($_GET['queue_callswaiting'])!="") $queue_callswaiting=trim($_GET['queue_callswaiting']);
			if(isset($_GET['queue_holdtime']) && trim($_GET['queue_holdtime'])!="") $queue_holdtime=trim($_GET['queue_holdtime']);
			if(isset($_GET['queue_minutes']) && trim($_GET['queue_minutes'])!="") $queue_minutes=trim($_GET['queue_minutes']);
			if(isset($_GET['queue_seconds']) && trim($_GET['queue_seconds'])!="") $queue_seconds=trim($_GET['queue_seconds']);
			if(isset($_GET['queue_lessthan']) && trim($_GET['queue_lessthan'])!="") $queue_lessthan=trim($_GET['queue_lessthan']);
			if(isset($_GET['queue_thankyou']) && trim($_GET['queue_thankyou'])!="") $queue_thankyou=trim($_GET['queue_thankyou']);
			if(isset($_GET['queue_reporthold']) && trim($_GET['queue_reporthold'])!="") $queue_reporthold=trim($_GET['queue_reporthold']);
			if(isset($_GET['announce_frequency']) && trim($_GET['announce_frequency'])!="") $announce_frequency=trim($_GET['announce_frequency']);
			if(isset($_GET['announce_round_seconds']) && trim($_GET['announce_round_seconds'])!="") $announce_round_seconds=trim($_GET['announce_round_seconds']);
			if(isset($_GET['announce_holdtime']) && trim($_GET['announce_holdtime'])!="") $announce_holdtime=trim($_GET['announce_holdtime']);
			if(isset($_GET['retry']) && trim($_GET['retry'])!="") $retry=trim($_GET['retry']);
			if(isset($_GET['wrapuptime']) && trim($_GET['wrapuptime'])!="") $wrapuptime=trim($_GET['wrapuptime']);
			if(isset($_GET['maxlen']) && trim($_GET['maxlen'])!="") $maxlen=trim($_GET['maxlen']);
			if(isset($_GET['servicelevel']) && trim($_GET['servicelevel'])!="") $servicelevel=trim($_GET['servicelevel']);
			if(isset($_GET['strategy']) && trim($_GET['strategy'])!="") $strategy=trim($_GET['strategy']);
			if(isset($_GET['joinempty']) && trim($_GET['joinempty'])!="") $joinempty=trim($_GET['joinempty']);
			if(isset($_GET['leavewhenempty']) && trim($_GET['leavewhenempty'])!="") $leavewhenempty=trim($_GET['leavewhenempty']);
			if(isset($_GET['eventmemberstatus']) && trim($_GET['eventmemberstatus'])!="") $eventmemberstatus=trim($_GET['eventmemberstatus']);
			if(isset($_GET['eventwhencalled']) && trim($_GET['eventwhencalled'])!="") $eventwhencalled=trim($_GET['eventwhencalled']);
			if(isset($_GET['reportholdtime']) && trim($_GET['reportholdtime'])!="") $reportholdtime=trim($_GET['reportholdtime']);
			if(isset($_GET['memberdelay']) && trim($_GET['memberdelay'])!="") $memberdelay=trim($_GET['memberdelay']);
			if(isset($_GET['weight']) && trim($_GET['weight'])!="") $weight=trim($_GET['weight']);
			if(isset($_GET['timeoutrestart']) && trim($_GET['timeoutrestart'])!="") $timeoutrestart=trim($_GET['timeoutrestart']);
			if(isset($_GET['periodic_announce']) && trim($_GET['periodic_announce'])!="") $periodic_announce=trim($_GET['periodic_announce']);
			if(isset($_GET['periodic_announce_frequency']) && trim($_GET['periodic_announce_frequency'])!="") $periodic_announce_frequency=trim($_GET['periodic_announce_frequency']);
			if(isset($_GET['ringinuse']) && trim($_GET['ringinuse'])!="") $ringinuse=trim($_GET['ringinuse']);
			if(isset($_GET['setinterfacevar']) && trim($_GET['setinterfacevar'])!="") $setinterfacevar=trim($_GET['setinterfacevar']);
				
			if(Queue::Queue_Insert($name, $musiconhold, $announce, $context, $timeout, $monitor_join, $monitor_format, $queue_youarenext, $queue_thereare, $queue_callswaiting,$queue_holdtime,$queue_minutes,$queue_seconds,$queue_lessthan,$queue_thankyou,$queue_reporthold,$announce_frequency,$announce_round_seconds,$announce_holdtime,$retry,$wrapuptime,$maxlen,$servicelevel,$strategy,$joinempty,$leavewhenempty,$eventmemberstatus,$eventwhencalled,$reportholdtime,$memberdelay,$weight,$timeoutrestart,$periodic_announce,$periodic_announce_frequency,$ringinuse,$setinterfacevar)){
				echo "$confno est ajouté sur la liste\n";
			}
			else{
				echo "échec d'ajouter $confno";
			}
			break;
	}
}else{
	echo "Non parametre";
}
