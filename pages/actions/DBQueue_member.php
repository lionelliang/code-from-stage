<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Queue_member.php';
if(count($_GET) > 0) {
	$method = trim($_GET['method']);
	switch ($method){
		case 'delete':
			{
				if(isset($_GET['id']) && trim($_GET['id'])!="") $id=trim($_GET['id']);
				if(Queue_member::Queue_memberById_Delete($id))
					echo "Chambre $id est supprimé\n";
			}
			break;

		case 'insert':
			$membername=$queue_name=$interface=$penalty=$paused=null;
			if(isset($_GET['membername']) && trim($_GET['membername'])!="") $membername=trim($_GET['membername']);
			if(isset($_GET['queue_name']) && trim($_GET['queue_name'])!="") $queue_name=trim($_GET['queue_name']);
			if(isset($_GET['interface']) && trim($_GET['interface'])!="") $interface=trim($_GET['interface']);
			if(isset($_GET['penalty']) && trim($_GET['penalty'])!="") $penalty=trim($_GET['penalty']);
			if(isset($_GET['paused']) && trim($_GET['paused'])!="") $paused=trim($_GET['paused']);

			if(Queue_member::Queue_member_Insert($membername, $queue_name, $interface, $penalty, $paused)){
				echo "$Queue member est ajouté sur la liste\n";
			}
			else{
				echo "échec d'ajouter Queue member";
			}
			break;
	}
}else{
	echo "Non parametre";
}
