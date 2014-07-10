<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="HTML Tidy, see www.w3.org" charset="UTF-8">
<title>Sipcom Asterisk Management</title>
</head>
<body onload="get_data('view/ViewMeetme.php','divAMI')">
	<h1>Asterisk Conference - Meetme - To be CHECKED , Not cheched Yet</h1>

	Ajouter un serveur:
	<br>
	<div>
		<table>
			<tr>
				<td>Conference Number</td>
				<td><input type="text" name="conferencesInsert" /><br></td>
			</tr>
			<tr>
				<td>Start Time</td>
				<td><input type="text" name="conferencesInsert" /><br></td>
			</tr>
			<tr>
				<td>End Time</td>
				<td><input type="text" name="conferencesInsert" /><br></td>
			</tr>
			<tr>
				<td>Pin</td>
				<td><input type="text" name="conferencesInsert" /><br></td>
			</tr>
			<tr>
				<td>Opts</td>
				<td><input type="text" name="conferencesInsert" /><br></td>
			</tr>
			<tr>
				<td>Adminpin</td>
				<td><input type="text" name="conferencesInsert" /><br></td>
			</tr>
			<tr>
				<td>AdminOpts</td>
				<td><input type="text" name="conferencesInsert" /><br></td>
			</tr>
			<tr>
				<td>Members</td>
				<td><input type="text" name="conferencesInsert" /><br></td>
			</tr>
			<tr>
				<td>MaxUsers</td>
				<td><input type="text" name="conferencesInsert" /><br></td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<button onclick="conferencesInsert()">Ajouter un serveur</button></td>
			</tr>
		</table>
		<textarea id="textareaconferencesInsert" rows="2" cols="40">Ajouter une chambre de conférence&#13;&#10;</textarea>
	</div>
	<br />
	<br />

	<div id="divAMI"></div>
	<script type="text/javascript">
	
	var int = self.setInterval("get_data('view/ViewMeetme.php','divAMI')",1000);
	
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
	    

	    function conferencesDelete(confno){
			var url = "actions/DBMeetme.php?method=delete&confno=" + confno;

			alert("Supprimez "+confno+" ?");
			get_data(url,null);
			}
		
	    function conferencesInsert(){
			var url = "actions/DBMeetme.php?method=insert";
			var conferencesInsert = document.getElementsByName("conferencesInsert");
			if(conferencesInsert[0].value != "")
			{
				url = url + "&confno=" + conferencesInsert[0].value;
			}else
			{
				alert("Nom de conférence est vide!");
				return;
			}
			if(conferencesInsert[1].value != "")
			{
				url = url + "&starttime=" + conferencesInsert[1].value;
			}
			if(conferencesInsert[2].value != "")
			{
				url = url + "&endtime=" + conferencesInsert[2].value;
			}
			if(conferencesInsert[3].value != "")
			{
				url = url + "&pin=" + conferencesInsert[3].value;
			}else
			{
				alert("pin est vide!");
				return;
			}
			if(conferencesInsert[4].value != "")
			{
				url = url + "&opts=" + conferencesInsert[4].value;
			}
			if(conferencesInsert[5].value != "")
			{
				url = url + "&adminpin=" + conferencesInsert[5].value;
			}
			if(conferencesInsert[6].value != "")
			{
				url = url + "&adminopts=" + conferencesInsert[5].value;
			}
			if(conferencesInsert[7].value != "")
			{
				url = url + "&members=" + conferencesInsert[5].value;
			}
			if(conferencesInsert[8].value != "")
			{
				url = url + "&maxusers=" + conferencesInsert[5].value;
			}
			//alert(url);
			get_data(url,"textareaconferencesInsert");		
			}

	    function conferencesKick(confno, userno){
			var url = "actions/AMIMeetme.php?method=kick&confno=" + confno;
			url = url + "&userno=" + userno;
			alert("Kick "+userno+"?");
			get_data(url,null);	
			}

	    function conferencesLock(confno, tolock){
			var url = "actions/AMIMeetme.php?method=lock&confno=" + confno;
			url = url + "&tolock=" + tolock;
			alert(" Lock "+confno+"?");
			get_data(url, null);
			}

	    function conferencesMute(confno, toMute, userno){
			var url = "actions/AMIMeetme.php?method=mute&confno=" + confno;
			url = url + "&toMute=" + toMute;
			if(toMute == "true"){
				var msg = "Mute ";
			}else{
				var msg = "Unmute ";
			}
			if (userno != ""){
				url = url + "&userno=" + userno;
				confno = userno + " in " +confno;
			}
			alert(msg+confno+"?");
			get_data(url, null);
			}
</script>
</body>

</html>
