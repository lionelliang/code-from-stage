<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Fax.php';

if(count($_GET) > 0) {
	$method = trim($_GET['method']);
	switch ($method){
		case 'delete':
			{
				unset($_GET['method']);
				foreach ($_GET as $key => $value){
					$value = trim($value);
					if(is_numeric($value)){
						if(Fax::faxSentById_Delete($value))
						echo "Réussir à supprimer fax $value \n";
					}else{
						echo "Echec, $value n'est pas un chifre";
					}
				}
			}
			break;
		case 'select':?>
<font face="Arial, Helvetica, sans-serif">Historique des fax envoyés:</font>
		<?php
		$result=Fax::getFaxSent();
		$num=mysql_numrows($result);?>
<table border="0" cellspacing="2" cellpadding="2">
	<tr>
		<th><font face="Arial, Helvetica, sans-serif">id</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Numéro de fax</font>
		</th>
		<th><font face="Arial, Helvetica, sans-serif">Date</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Reçu de</font></th>
		<th><font face="Arial, Helvetica, sans-serif">Fichier</font></th>
	</tr>
	<?php $i=0;
	if($num > 0){
		while ($i < $num) {
			$id=mysql_result($result,$i,"id");
			$numerodefax=mysql_result($result,$i,"numerodefax");
			$date=mysql_result($result,$i,"date");
			$recude=mysql_result($result,$i,"recude");
			$fichier=mysql_result($result,$i,"fichier");
			?>
	<tr>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $id; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $numerodefax; ?>
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $date; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $recude; ?> </font>
		</td>
		<td><font face="Arial, Helvetica, sans-serif"><?php echo $fichier; ?>
		</font></td>
		<td><font face="Arial, Helvetica, sans-serif">Supprimer </font><input
			type='checkbox' name='faxSentDelete' value=<?php echo $id; ?>>
		</td>
	</tr>
	<?php
	$i++;
		}
	}else{
		echo "aucun fax log";
	}
	?>
</table>
<button onclick="faxSentDelete()">Supprimer le</button>
<br>
	<?php break;
	}
}else{
	echo "Non parametre";
}