<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Peers.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Callshop.php';

try {?>
<font face="Arial, Helvetica, sans-serif">Liste des Callshops:</font>
<?php
$result = Callshop::getCallshop();
$num = mysql_numrows($result);?>
<table border="0" cellspacing="2" cellpadding="2">
	<tr>
		<th><font face="Arial, Helvetica, sans-serif">id</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Société</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Address</font></th>
		<th><font face="Arial, Helvetica, sans-serif">CP </font></th>
		<th><font face="Arial, Helvetica, sans-serif">Ville </font></th>
	</tr>
	<?php
	$i=0;
	if($num > 0){
		while ($i < $num) {
			$id=mysql_result($result,$i,"id");
			$societe=mysql_result($result,$i,"societe");
			$addresse=mysql_result($result,$i,"addresse");
			$cp=mysql_result($result,$i,"cp");
			$ville=mysql_result($result,$i,"ville");
			?>
	<tr>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $id; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $societe; ?>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $addresse; ?>
		</font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $cp; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $ville; ?> </font>
		</td>
		<td align="right"><button
				onclick="callshopDelete(<?php echo $id; ?>)">Supprimer</button>
		</td>
	</tr>
	<?php
	$i++;
		}
	}else{
		echo "aucun Callshop";
	}
	?>
</table>
<textarea id="textareaCallshopDelete" rows="2" cols="40">supprimer un Callshop</textarea>
<br>
<br>
<br>
<font face="Arial, Helvetica, sans-serif">Etat de chaque Callshop:</font>
<br>
<br>
	<?php
	if($num > 0){
		if(Peers::Login()){
			$i=0;
			while ($i < $num) {
				$id = mysql_result($result,$i,"id");
				$societe = mysql_result($result,$i,"societe");
				echo "Callshop $i $societe State <br>";

				$resUsers = Callshop::getUsersByFk_callshop($id);
				$numUsers = mysql_numrows($resUsers);
				if($numUsers > 0){
					$j=0;
					while ($j < $numUsers) {
						$username=mysql_result($resUsers,$j,"username");
						echo "User: ".$username." status: ";
						$res = Peers::getPeerByCallerid($username);
						echo $res['status']."<br>";
						$j++;
					}
				echo "<br><br>";
				}
			$i++;
			}
			Peers::Logout();
		}
	}else{
		echo "aucun Callshop";
	}
	?>
<br>
<br>
	<?php } catch (Exception $e) {
		echo $e->getMessage();
	}