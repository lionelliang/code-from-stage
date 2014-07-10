<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../bll/Queue.php';
$room=Queue::getQueue();
$num=mysql_numrows($room);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="HTML Tidy, see www.w3.org">
<link rel="stylesheet" type="text/css" href="css/Site.css">
<title>Sipcom Asterisk Management</title>
</head>
<body>
	<h1>Asterisk Queue</h1>
    <div id="divleft">
	Ajouter un Queue:
	<br>
	<div>
		<table>
			<tr>
				<td>Name</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Music On Hold</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Announce</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Context</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Time Out</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Monitor Join</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Monitor Format</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Queue Youarenext</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Queue Thereare</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Queue Callswaiting</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Queue HoldTime</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>

			<tr>
				<td>Queue Minutes</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Queue Seconds</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Queue LessThan</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Queue Thankyou</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Queue ReportHold</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Announce Frequency</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Announce RoundSeconds</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Announce Holdtime</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Retry</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>WrapupTime</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Maxlen</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Service Level</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Strategy</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Join Empty</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Leave When Empty</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Event Member status</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Event When Called</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Report Hold Time</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Member Delay</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Weight</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Time Out Restart</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Periodic Announce</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Periodic Announce Frequency</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Ring in use</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td>Set interface var</td>
				<td><input type="text" name="queueInsert" /><br></td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<button onclick="queueInsert()">Ajouter un queue</button></td>
			</tr>
		</table>
		<textarea id="textareaQueueInsert" rows="2" cols="40">Ajouter une chambre de Queue&#13;&#10;</textarea>


	</div>
	<br />
	<br />

	<div id="divAMI"></div>

	</div>
	<div id="divright">
		
		<table>
			<tr>
				<td>Queue Name</td>
				<td>
					<select name="ddlqueue_memberInsert" id="ddlqueue_memberInsert">
						<?php 
							for ($i=0; $i < $num; $i++) { 
								$name=mysql_result($room,$i,"name");
						?>	
						<option value=<? echo $name?>><?php echo $name ?></option>
						<?php 
						}
						?>	
					</select>
				</td>
			</tr>	
			<tr>
				<td>Member Name</td>
				<td><input type="text" name="queue_memberInsert"/></td>		
			</tr>
			<tr>
				<td>Interface</td>
				<td><input type="text" name="queue_memberInsert"/></td>		
			</tr>
			<tr>
				<td>Penalty</td>
				<td><input type="text" name="queue_memberInsert"/></td>		
			</tr>
			<tr>
				<td>Paused</td>
				<td><input type="text" name="queue_memberInsert"/></td>		
			</tr>
			<tr>
				<td><button onclick="queue_memberInsert()">Ajouter un Queue Member</button></td>
			</tr>
		</table>
	    <div id="divQue"></div>
	</div>
	<script type="text/javascript">
	
	function get_data(file, controler){
		var xmlhttp;
		if (window.XMLHttpRequest)
		  {// code for IE7+, Firefox, Chrome, Opera, Safari
		  xmlhttp=new XMLHttpRequest();
		  }
		else
		  {// code for IE6, IE5
		  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		  }

		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    	if (controler!=null) {
		    		document.getElementById(controler).innerHTML=xmlhttp.responseText;
		    	};
		    }
		  }
		xmlhttp.open("GET",file,true);
		xmlhttp.send();
		}
	    var int = self.setInterval("get_data('view/ViewQueue.php','divAMI')",1000);
	    var int = self.setInterval("get_data('view/ViewQueue_member.php','divQue')",1000);
       
	    function queue_memberInsert(){
			var url = "actions/DBQueue_member.php?method=insert";
			var queue_memberInsert = document.getElementsByName("queue_memberInsert");
			var ddlresult = document.getElementById("ddlqueue_memberInsert");
			var ddlqueue_memberInsert = ddlresult.options[ddlresult.selectedIndex].value;
			if(ddlqueue_memberInsert != "")
			{
				url = url + "&queue_name=" + ddlqueue_memberInsert;
			}else
			{
				alert("Interface de queue est vide!");
				return;
			}
			if(queue_memberInsert[0].value != "")
			{
				url = url + "&membername=" + queue_memberInsert[0].value;
			}
			else
			{
				alert("queuename est vide!");
				return;
			}
			if(queue_memberInsert[1].value != "")
			{
				url = url + "&interface=" + queue_memberInsert[1].value;
			}
			if(queue_memberInsert[2].value != "")
			{
				url = url + "&penalty=" + queue_memberInsert[2].value;
			}
			if(queue_memberInsert[3].value != "")
			{
				url = url + "&paused=" + queue_memberInsert[3].value;
			}
			get_data(url,"textareaQueueInsert");	
			}
		
		function queue_memberDelete(id){
			var url = "actions/DBQueue_member.php?method=delete&id=" + id;
			alert("Supprimez queue_member "+id+"?");
			get_data(url, null);
		}

	    function queueDelete(name){
			var url = "actions/DBQueue.php?method=delete&name=" + name;
			alert("Supprimez queue "+name+"?");
			get_data(url,"textareaqueuesDelete");
			}
		
	    function queueInsert(){
			var url = "actions/DBQueue.php?method=insert";
			var queueInsert = document.getElementsByName("queueInsert");
			if(queueInsert[0].value != "")
			{
				url = url + "&name=" + queueInsert[0].value;
			}else
			{
				alert("Nom de queue est vide!");
				return;
			}
			if(queueInsert[1].value != "")
			{
				url = url + "&musiconhold=" + queueInsert[1].value;
			}
			else
			{
				alert("musiconhold est vide!");
				return;
			}
			if(queueInsert[2].value != "")
			{
				url = url + "&announce=" + queueInsert[2].value;
			}
			if(queueInsert[3].value != "")
			{
				url = url + "&context=" + queueInsert[3].value;
			}
			if(queueInsert[4].value != "")
			{
				url = url + "&timeout=" + queueInsert[4].value;
			}
			if(queueInsert[5].value != "")
			{
				url = url + "&monitor_join=" + queueInsert[5].value;
			}
			if(queueInsert[6].value != "")
			{
				url = url + "&monitor_format=" + queueInsert[6].value;
			}
			if(queueInsert[7].value != "")
			{
				url = url + "&queue_youarenext=" + queueInsert[7].value;
			}
			if(queueInsert[8].value != "")
			{
				url = url + "&queue_thereare=" + queueInsert[8].value;
			}
			if(queueInsert[9].value != "")
			{
				url = url + "&queue_callswaiting=" + queueInsert[9].value;
			}
			if(queueInsert[10].value != "")
			{
				url = url + "&queue_holdtime=" + queueInsert[10].value;
			}
			if(queueInsert[11].value != "")
			{
				url = url + "&queue_minutes=" + queueInsert[11].value;
			}
			if(queueInsert[12].value != "")
			{
				url = url + "&queue_seconds=" + queueInsert[12].value;
			}
			if(queueInsert[13].value != "")
			{
				url = url + "&queue_lessthan=" + queueInsert[13].value;
			}
			if(queueInsert[14].value != "")
			{
				url = url + "&queue_thankyou=" + queueInsert[14].value;
			}
			if(queueInsert[15].value != "")
			{
				url = url + "&queue_reporthold=" + queueInsert[15].value;
			}
			if(queueInsert[16].value != "")
			{
				url = url + "&announce_frequency=" + queueInsert[16].value;
			}
			if(queueInsert[17].value != "")
			{
				url = url + "&announce_round_seconds=" + queueInsert[17].value;
			}
			if(queueInsert[18].value != "")
			{
				url = url + "&announce_holdtime=" + queueInsert[18].value;
			}
			if(queueInsert[19].value != "")
			{
				url = url + "&retry=" + queueInsert[19].value;
			}
			if(queueInsert[20].value != "")
			{
				url = url + "&wrapuptime=" + queueInsert[20].value;
			}
			if(queueInsert[21].value != "")
			{
				url = url + "&maxlen=" + queueInsert[21].value;
			}
			if(queueInsert[22].value != "")
			{
				url = url + "&servicelevel=" + queueInsert[22].value;
			}
			if(queueInsert[23].value != "")
			{
				url = url + "&strategy=" + queueInsert[23].value;
			}
			if(queueInsert[24].value != "")
			{
				url = url + "&joinempty=" + queueInsert[24].value;
			}
			if(queueInsert[25].value != "")
			{
				url = url + "&leavewhenempty=" + queueInsert[25].value;
			}
			if(queueInsert[26].value != "")
			{
				url = url + "&eventmemberstatus=" + queueInsert[26].value;
			}
			if(queueInsert[27].value != "")
			{
				url = url + "&eventwhencalled=" + queueInsert[27].value;
			}
			if(queueInsert[28].value != "")
			{
				url = url + "&reportholdtime=" + queueInsert[28].value;
			}
			if(queueInsert[29].value != "")
			{
				url = url + "&memberdelay=" + queueInsert[29].value;
			}
			if(queueInsert[30].value != "")
			{
				url = url + "&weight=" + queueInsert[30].value;
			}
			if(queueInsert[31].value != "")
			{
				url = url + "&timeoutrestart=" + queueInsert[31].value;
			}
			if(queueInsert[32].value != "")
			{
				url = url + "&periodic_announce=" + queueInsert[32].value;
			}
			if(queueInsert[33].value != "")
			{
				url = url + "&periodic_announce_frequency=" + queueInsert[33].value;
			}
			if(queueInsert[34].value != "")
			{
				url = url + "&ringinuse=" + queueInsert[34].value;
			}
			if(queueInsert[35].value != "")
			{
				url = url + "&setinterfacevar=" + queueInsert[35].value;
			}
			get_data(url,"textareaQueueInsert");	
			}
</script>
</body>

</html>
