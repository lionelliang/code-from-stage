<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Peers.php';

try {
	if(Peers::Login()){
		$res = Peers::getPeers();
		echo "login users:".$res[1][0]."<br>";

		foreach ($res[0] as $users){
			$username = explode('/', $users[0]);
			echo "User: ".$username[0]." status: ";
			$resPeers=Peers::getPeerByCallerid($username[0]);
			echo $resPeers['status']."<br>";
		}
		echo "<b>Asterisk Server Status:</b><br>";
		$results=Peers::GetServerStatus();
		for($i=0;$i<sizeof($results);$i++){
			echo $results[$i];
		}
	}else{
		echo "Login failed";
	}
	Peers::Logout();
} catch (Exception $e) {
	echo $e->getMessage();
}