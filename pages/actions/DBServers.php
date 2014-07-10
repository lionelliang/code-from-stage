<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Servers.php';

if(count($_GET) > 0) {
	$method = trim($_GET['method']);
	switch ($method){
		case 'delete':
			{
				unset($_GET['method']);
				foreach ($_GET as $key => $value){
					$value = trim($value);
					if(is_numeric($value)){
					if(Servers::ServersById_Delete($value))
						echo "serveur $value est supprimé\n";
					}else{
						echo "Echec, $value n'est pas un chifre";
					}
				}
			}
			break;
		case 'insert':
			$servername=$host=$port=$username=$password=$timeout=null;
			if(isset($_GET['servername']) && trim($_GET['servername'])!="") $servername=trim($_GET['servername']);
			if(isset($_GET['host']) && trim($_GET['host'])!="") $host=trim($_GET['host']);
			if(isset($_GET['port']) && trim($_GET['port'])!="") $port=trim($_GET['port']);
			if(isset($_GET['username']) && trim($_GET['username'])!="") $username=trim($_GET['username']);
			if(isset($_GET['password']) && trim($_GET['password'])!="") $password=trim($_GET['password']);
			if(isset($_GET['timeout']) && trim($_GET['timeout'])!="") $timeout=trim($_GET['timeout']);
			
			if(Servers::Servers_Insert($servername, $host, $port, $username, $password, $timeout)){
				echo "$servername est ajouté sur la liste\n";
			}
			else{
				echo "échec d'ajouter $servername";
			}
			break;
	}
}else{
	echo "Non parametre";
}