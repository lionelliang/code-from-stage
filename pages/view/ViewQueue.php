<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Queue.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Meetme.php';

try {?>
<font face="Arial, Helvetica, sans-serif">Liste des Queue:</font>
<?php
$room=Queue::getQueue();
$num=mysql_numrows($room);?>
<table border="0" cellspacing="2" cellpadding="2">
	<tr>
		<th><font face="Arial, Helvetica, sans-serif">Name</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Music On hold</font></th>

		<th><font face="Arial, Helvetica, sans-serif">Announce</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Context</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Time Out</font></th>
	</tr>
	<?php
	$i=0;
	if($num > 0){
		while ($i < $num) {
			$name=mysql_result($room,$i,"name");
			$musiconhold=mysql_result($room,$i,"musiconhold");
			$announce=mysql_result($room,$i,"announce");
			$context=mysql_result($room,$i,"context");
			$timeout=mysql_result($room,$i,"timeout");
			?>
	<tr>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $name; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $musiconhold; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $announce; ?>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $context; ?>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $timeout; ?>
		</font>
		</td>
		<td align="right"><button
				onclick="queueDelete('<?php echo $name; ?>')">Supprimer</button>
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
<textarea id="textareaqueuesDelete" rows="2" cols="40">supprimer un queue</textarea>
<br>
<br>
<br>
	<?if(Meetme::Login()){?>
<font face="Arial, Helvetica, sans-serif">Liste des queue:</font>
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
	foreach ($results[0] as $conference){
		echo "<font face='Arial, Helvetica, sans-serif'> $conference[0]:</font><br>";
		$users = Meetme::MeetmeListDetail($conference[0]);
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
	</tr>
	<?php
	foreach ($users[0] as $user){
		echo "<tr>";
		echo "<td><font face='Arial, Helvetica, sans-serif'>$user[2]</font></td>";
		echo "<td><font face='Arial, Helvetica, sans-serif'>$user[3]</font></td>";
		echo "<td><font face='Arial, Helvetica, sans-serif'>$user[4]</font></td>";
		echo "<td><font face='Arial, Helvetica, sans-serif'>$user[6]</font></td>";
		echo "<td><font face='Arial, Helvetica, sans-serif'>$user[7]</font></td>";
		echo "<td><font face='Arial, Helvetica, sans-serif'>$user[8]</font></td>";
		echo "</tr>";
	}
		}else{
			echo "aucun conference";
		}
		?>
</table>
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
