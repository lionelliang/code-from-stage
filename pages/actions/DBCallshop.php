<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Callshop.php';

if(count($_GET) > 0) {
	$method = trim($_GET['method']);
	switch ($method){
		case 'delete':
			{
				unset($_GET['method']);
				foreach ($_GET as $key => $value){
					$value = trim($value);
					if(is_numeric($value)){
						if(Callshop::CallshopById_Delete($value))
						echo "Callshop $value est supprimé\n";
					}else{
						echo "Echec, $value n'est pas un chifre";
					}
				}
			}
			break;
		case 'insert':
			$servername=$host=$port=$username=$password=$timeout=null;
			if(isset($_GET['societe']) && trim($_GET['societe'])!="") $societe=trim($_GET['societe']);
			if(isset($_GET['addresse']) && trim($_GET['addresse'])!="") $addresse=trim($_GET['addresse']);
			if(isset($_GET['cp']) && trim($_GET['port'])!="") $cp=trim($_GET['cp']);
			if(isset($_GET['ville']) && trim($_GET['ville'])!="") $ville=trim($_GET['ville']);
			
			if(Callshop::Callshop_Insert($societe, $addresse, $cp, $ville)){
				echo "$societe est ajouté sur la liste\n";
			}
			else{
				echo "échec d'ajouter $societe";
			}
			break;
	}
}else{
	echo "Non parametre";
}