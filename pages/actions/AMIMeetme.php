<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Meetme.php';

if(count($_GET) > 0) {
	$method = trim($_GET['method']);
	switch ($method){
		case 'kick':
			{
				if(isset($_GET['confno']) && trim($_GET['confno'])!="") $confno=trim($_GET['confno']);
				if(isset($_GET['userno']) && trim($_GET['userno'])!="") $userno=trim($_GET['userno']);
				
				try {
					if(Meetme::Login()){
						Meetme::MeetmeKick($confno, $userno);
					}else{
						echo "Login failed<br>";
					}
					Peers::Logout();
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
			break;
		case 'lock':
			{
				$confno=$tolock=null;
				if(isset($_GET['confno']) && trim($_GET['confno'])!="") $confno=trim($_GET['confno']);
				if(isset($_GET['tolock']) && trim($_GET['tolock'])!="") $tolock=trim($_GET['tolock']);
				
				if($tolock == 'false' || $tolock == 'FALSE')
				$tolockValue = false;
				else
				$tolockValue = true;
				try {
					if(Meetme::Login()){
						Meetme::MeetmeLock($confno, $tolockValue);
					}else{
						echo "Login failed<br>";
					}
					Peers::Logout();
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
			break;
		case 'mute':
			{
				$confno=$toMute=$userno=null;
				if(isset($_GET['confno']) && trim($_GET['confno'])!="") $confno=trim($_GET['confno']);
				if(isset($_GET['userno']) && trim($_GET['userno'])!="") $userno=trim($_GET['userno']);
				if(isset($_GET['toMute']) && trim($_GET['toMute'])!="") $toMute=trim($_GET['toMute']);
				
				if($toMute == 'false' || $toMute == 'FALSE')
				$toMuteValue = false;
				else
				$toMuteValue = true;
				
				try {
					if(Meetme::Login()){
						Meetme::MeetmeMute($confno, $toMuteValue, $userno);
					}else{
						echo "Login failed<br>";
					}
					Peers::Logout();
				} catch (Exception $e) {
					echo $e->getMessage();
				}
			}
			break;
	}
}else{
	echo "Non parametre";
}