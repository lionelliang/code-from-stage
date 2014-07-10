<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Queue_member.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Queue.php';

try {?>
<font face="Arial, Helvetica, sans-serif">Liste des Queues</font>
<br/><br/>
<?php
$room=Queue::getQueue();
$num=mysql_numrows($room);?>

<font face="Arial, Helvetica, sans-serif">Etat de chaque Queues:</font>
<br>
<br>
	<?php
	if($num > 0){
			$i=0;
			while ($i < $num) {
				$name=mysql_result($room,$i,"name");
				echo "Queues $i $name State <br>";

				$resQueueMembers = Queue_member::QueuememeberByQueueName($name);
				$numQueueMembers = mysql_numrows($resQueueMembers);
				if($numQueueMembers > 0){?>

<table border="0" cellspacing="2" cellpadding="2">
	<tr>
		<th><font face="Arial, Helvetica, sans-serif">Id</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Member Name</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Queue Name</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Interface</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Penalty</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Paused</font></th>
	</tr>
	<?php
	$j=0;
	if($numQueueMembers > 0){
		while ($j < $numQueueMembers) {
			$uniqueid=mysql_result($resQueueMembers,$j,"uniqueid");
			$membername=mysql_result($resQueueMembers,$j,"membername");
			$queue_name=mysql_result($resQueueMembers,$j,"queue_name");
			$interface=mysql_result($resQueueMembers,$j,"interface");
			$penalty=mysql_result($resQueueMembers,$j,"penalty");
			$paused=mysql_result($resQueueMembers,$j,"paused");
			?>
	<tr>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $uniqueid; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $membername; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $queue_name; ?>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $interface; ?>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $penalty; ?>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $paused; ?>
		</font>
		</td>
		<td align="right"><button
				onclick="queue_memberDelete('<?php echo $uniqueid; ?>')">Supprimer</button>
		</td>
	</tr>
	<?php
	$j++;
		}
		?>
		</table>
		<?php
	}
	?>

<br><br>
	<?php }else{
		echo "aucun queue member<br/>";
	}
			$i++;
			}
	}else{
		echo "aucun Queues<br/>";
	}
	?>
<br>
<br>
	<?php } catch (Exception $e) {
		echo $e->getMessage();
	}
