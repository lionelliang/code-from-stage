<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Peers.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Servers.php';

try {?>
<font face="Arial, Helvetica, sans-serif">Liste des Serveurs:</font>
<?php
$result=Servers::getServers();
$num=mysql_numrows($result);?>
<table border="0" cellspacing="2" cellpadding="2">
	<tr>
		<th><font face="Arial, Helvetica, sans-serif">id</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Nom de Serveur</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Address</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Supprimer</font></th>
	</tr>
	<?php
	$i=0;
	if($num > 0){
		while ($i < $num) {
			$id=mysql_result($result,$i,"id");
			$servername=mysql_result($result,$i,"servername");
			$host=mysql_result($result,$i,"host");
			?>
	<tr>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $id; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $servername; ?>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $host; ?> </font>
		</td>
		<td align="right"><input type='checkbox' name='serversDelete'
			value=<?php echo $id; ?>>
		</td>
	</tr>
	<?php
	$i++;
		}
	}else{
		echo "aucun serveur";
	}
	?>
	<tr>
		<td colspan="4" align="right"><button onclick="serversDelete()">Supprimer
				le</button></td>
	</tr>
</table>
<textarea id="textareaserversDelete" rows="2" cols="40">supprimer un serveur</textarea>
<br>
<br>
<br>
<font face="Arial, Helvetica, sans-serif">Etat de chaque serveur:</font>
<br>
<br>

	<?php
	if(Peers::Login()){?>
Serveur&nbsp;
	<?php echo "Local&nbsp;State&nbsp;"?>
<img
	src="imgs/serveron.png" alt="serveur off" height="15" width="15">
<br>
<br>
	<?php
	$res = Peers::getPeers();
	echo "login users: ".$res[1][0]."<br>";

	foreach ($res[0] as $users){
		$username = explode('/', $users[0]);
		echo "User: ".$username[0]." status: ";
		$resPeers=Peers::getPeerByCallerid($username[0]);
		echo $resPeers['status']."<br>";
	}
	}else{?>
Serveur:
	<?php echo "Local "?>
<img
	src="imgs/serveroff.png" alt="serveur off" height="15" width="15">
	<?php }
	Peers::Logout(); ?>
<br>
<br>
	<?php
	$i=0;
	if($num > 0){
		while ($i <= $num) {
			$id=mysql_result($result,$i,"id");
			$servername=mysql_result($result,$i,"servername");
			$host=mysql_result($result,$i,"host");
			$port=mysql_result($result,$i,"port");
			$username=mysql_result($result,$i,"username");
			$password=mysql_result($result,$i,"password");
			$timeout=mysql_result($result,$i,"timeout");
			if(Peers::Login($host, $port, $username, $password, $timeout)){?>
Serveur&nbsp;
			<?php echo "$i&nbsp;$servername&nbsp;State&nbsp;"?>
<img
	src="imgs/serveron.png" alt="serveur off" height="15" width="15">
<br>
<br>
			<?php
			$res = Peers::getPeers();
			echo "login users: ".$res[1][0]."<br>";

			foreach ($res[0] as $users){
				$username = explode('/', $users[0]);
				echo "User: ".$username[0]." status: ";
				$resPeers=Peers::getPeerByCallerid($username[0]);
				echo $resPeers['status']."<br>";
			}
			echo "<br><br>";
			}else{?>
Serveur&nbsp;
			<?php echo "$i&nbsp;$servername&nbsp;State&nbsp;"?>
<img
	src="imgs/serveroff.png" alt="serveur off" height="15" width="15">
<br>
<br>
			<?php }
			Peers::Logout();
			$i++;
		}
	}else{
		echo "aucun serveur";
	}
	?>
<br>
<br>
	<?php } catch (Exception $e) {
		echo $e->getMessage();
	}