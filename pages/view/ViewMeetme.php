<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Meetme.php';
try {?>
<font face="Arial, Helvetica, sans-serif">Liste des Chambres de
	Conférence:</font>
<?php
$room=Meetme::getBit_meetme();
$num=mysql_numrows($room);?>
<table border="0" cellspacing="2" cellpadding="2">
	<tr>
		<th><font face="Arial, Helvetica, sans-serif">Conference Number</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Pin</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Adminpin</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Members</font></th>
		<th><font face="Arial, Helvetica, sans-serif">MaxUsers</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Option </font></th>
	</tr>
	<?php
	$i=0;
	if($num > 0){
		while ($i < $num) {
			$confno=mysql_result($room,$i,"confno");
			$pin=mysql_result($room,$i,"pin");
			$adminpin=mysql_result($room,$i,"adminpin");
			$members=mysql_result($room,$i,"members");
			$host=mysql_result($room,$i,"maxusers");
			?>
	<tr>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $confno; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $pin; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $adminpin; ?>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $members; ?>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $maxusers; ?>
		</font>
		</td>
		<td align="right"><button
				onclick="conferencesDelete(<?php echo $confno; ?>)">Supprimer</button>
		</td>
	</tr>
	<?php
	$i++;
		}
	}else{
		echo "aucun conférence";
	}
	?>
</table>
<textarea id="textareaconferencesDelete" rows="2" cols="40">supprimer un conférences</textarea>
<br>
<br>
<br>
	<?if(Meetme::Login()){?>
<font face="Arial, Helvetica, sans-serif">Liste des Conférences:</font>
<br>
	<?php $results = Meetme::MeetmeList();
	if($results){?>

<table border="0" cellspacing="2" cellpadding="2">
	<tr>
		<th><font face="Arial, Helvetica, sans-serif">Conf Num</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Parties</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Marked</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Activity </font></th>
		<th><font face="Arial, Helvetica, sans-serif">Creation </font></th>
		<th><font face="Arial, Helvetica, sans-serif">Locked </font></th>
	</tr>
	<?php
	foreach ($results[0] as $result){
		echo "<tr>";
		foreach ($result as $res){
			echo "<td><font face='Arial, Helvetica, sans-serif'>$res</font></td>";
		}
		echo "</tr>";
	}
	}else{
		echo "aucun conference";
	}
	?>
</table>
<br>
<font face="Arial, Helvetica, sans-serif">Etat de chaque conférence:</font>
<br>
<br>

	<?php
	foreach ($results[0] as $conference){?>
<font face='Arial, Helvetica, sans-serif'> <?php echo $conference[0]?>:</font><br>
<button onclick='conferencesLock(<?php
if(strstr($conference[5],"No") == true || strstr($conference[5],"NO") == true){
	$tolock = "true";
	$msg = "Lock it";
}else{
	$tolock = "false";
	$msg = "Unlock it";
}
echo "$conference[0],$tolock";
?>)'><?php echo $msg;?></button>
<button onclick='conferencesMute(<?php
echo "$conference[0]";
?>,"true","all")'>Mute All</button>
<button onclick='conferencesMute(<?php
echo "$conference[0]";
?>,"false","all")'>Unmute All</button>
<br>

<?php 	$users = Meetme::MeetmeListDetail($conference[0]);
		if($users){?>
<table border="0" cellspacing="2" cellpadding="2">
	<tr>
		<th><font face="Arial, Helvetica, sans-serif">Num</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Nom</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Userid</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Channel </font></th>
		<th><font face="Arial, Helvetica, sans-serif">Etat</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Temps d'activé </font></th>
		<th><font face="Arial, Helvetica, sans-serif">Actions</font></th>
	</tr>
	<?php
	foreach ($users[0] as $user){?>
<tr>
<td><font face='Arial, Helvetica, sans-serif'><?php echo $user[2]?></font></td>
<td><font face='Arial, Helvetica, sans-serif'><?php echo $user[3]?></font></td>
<td><font face='Arial, Helvetica, sans-serif'><?php echo $user[4]?></font></td>
<td><font face='Arial, Helvetica, sans-serif'><?php echo $user[6]?></font></td>
<td><font face='Arial, Helvetica, sans-serif'><?php if(strpos($user[8],"Muted") === false){
	echo $user[7];
}else{
	echo $user[7]." ".$user[8].$user[9];
}?></font></td>
<td><font face='Arial, Helvetica, sans-serif'><?php if(strpos($user[8],"Muted") === false){
	echo $user[8];
}else{
	echo $user[10];
}?> </font></td>
<td align='right'>
<button onclick='conferencesMute(<?php
if(strpos($user[8],"Muted") === false){
	$toMute = 'true';
	$msg = "Mute him";
}else{
	$toMute = 'false';
	$msg = "Unmute him";
}
echo "$conference[0],$toMute,$user[2]";
?>)'><?php echo $msg;?></button>
<button onclick='conferencesKick($conference[0], $user[2])'>Kick him out</button></td>
</tr>
	<?php }?>
</table><?php 
		
		}else{
			echo "aucun utilisateur";
		}
?>
<br>
<br>

		<?php
	}
	}else{
		echo "Login failed<br>";
	}
	Meetme::Logout();
} catch (Exception $e) {
	echo $e->getMessage();
}
