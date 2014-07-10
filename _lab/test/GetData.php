<?php
include_once "../bll/Users.php";
include_once "../bll/Peers.php";
if(Peers::Login()){
	$res = Peers::getPeers();
	echo "login users:".$res[1][0]."<br>";

	foreach ($res[0] as $users){
		echo "User: ".$users[0]." status: ";
		$res=Peers::getPeerByCallerid($users[1]);
		echo $res[status]."<br>";
	}
	}else{
		echo "Login failed<br>";
	}

echo "<br><br>";
?>