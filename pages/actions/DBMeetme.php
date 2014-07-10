<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Meetme.php';

if(count($_GET) > 0) {
	$method = trim($_GET['method']);
	switch ($method){
		case 'delete':
			{
				unset($_GET['method']);
				foreach ($_GET as $key => $value){
					$value = trim($value);
					if(is_numeric($value)){
						if(Meetme::Bit_meetmeById_Delete($value))
						echo "Chambre $value est supprimé\n";
					}else{
						echo "Echec, $value n'est pas un chifre";
					}
				}
			}
			break;
		case 'insert':
			$confno=$starttime=$endtime=$pin=$opts=$adminpin=$adminopts=$members=$maxusers=null;
			if(isset($_GET['confno']) && trim($_GET['confno'])!="") $confno=trim($_GET['confno']);
			if(isset($_GET['starttime']) && trim($_GET['starttime'])!="") $starttime=trim($_GET['starttime']);
			if(isset($_GET['endtime']) && trim($_GET['endtime'])!="") $endtime=trim($_GET['endtime']);
			if(isset($_GET['pin']) && trim($_GET['pin'])!="") $pin=trim($_GET['pin']);
			if(isset($_GET['opts']) && trim($_GET['opts'])!="") $opts=trim($_GET['opts']);
			if(isset($_GET['adminpin']) && trim($_GET['adminpin'])!="") $adminpin=trim($_GET['adminpin']);
			if(isset($_GET['adminopts']) && trim($_GET['adminopts'])!="") $adminopts=trim($_GET['adminopts']);
			if(isset($_GET['members']) && trim($_GET['members'])!="") $members=trim($_GET['members']);
			if(isset($_GET['maxusers']) && trim($_GET['maxusers'])!="") $maxusers=trim($_GET['maxusers']);
			
			if(Meetme::Bit_meetme_Insert($confno, $starttime, $endtime, $pin, $opts, $adminpin, $adminopts, $members, $maxusers)){
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