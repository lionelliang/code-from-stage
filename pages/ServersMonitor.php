<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="HTML Tidy, see www.w3.org" charset="UTF-8">
<title>Sipcom Asterisk Management</title>
</head>
<body onload="get_data('view/ViewServersMonitor.php','divAMI');">
	<h1>Asterisk Servers Monitoring</h1>
	Ajouter un serveur:<br>
	<div>
		<table>
			<tr>
				<td>Nom de serveur</td>
				<td><input type="text" name="serversInsert" /><br></td>
			</tr>
			<tr>
				<td>Host Address</td>
				<td><input type="text" name="serversInsert" /><br></td>
			</tr>
			<tr>
				<td>Port</td>
				<td><input type="text" name="serversInsert" value="5038"/><br></td>
			</tr>
			<tr>
				<td>Login</td>
				<td><input type="text" name="serversInsert" /><br></td>
			</tr>
			<tr>
				<td>Mot de Pass</td>
				<td><input type="text" name="serversInsert" /><br></td>
			</tr>
			<tr>
				<td>Timeout</td>
				<td><input type="text" name="serversInsert"/><br></td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<button onclick="serversInsert()">Ajouter un serveur</button></td>
			</tr>
		</table>
		<textarea id="textareaserversInsert" rows="2" cols="40">Ajouter un serveur&#13;&#10;</textarea>
	</div>
	<br />
	<br />
	<div id="divAMI">Information de Serveur, attendez...............</div>
	<br>

	<script type="text/javascript">
	
	    var int = self.setInterval("get_data('view/ViewServersMonitor.php','divAMI')",1000);

		function serversDelete(){
			var url = "actions/DBServers.php?method=delete&";
			var serversDelete = document.getElementsByName("serversDelete");
			isChecked = false;
			//For each checkbox see if it has been checked, record the value.
			for (i = 0; i < serversDelete.length; i++)
			{
				if(serversDelete[i].checked){
					url = url + "server" + i + "=" + serversDelete[i].value + "&";
					isChecked = true;
				}
			}
			if(!isChecked){
				alert("Choisissez serveur à supprimer!");
				return;
			}
			url = url.slice(0,-1);
			//alert(url);
			alert("Supprimez leurs?");
			get_data(url,"textareaserversDelete");
			gdata('view/ViewServersMonitor.php','divAMI');
			}

		function serversInsert(){
			var url = "actions/DBServers.php?method=insert";
			var serversInsert = document.getElementsByName("serversInsert");
			if(serversInsert[0].value != "")
			{
				url = url + "&servername=" + serversInsert[0].value;
			}else
			{
				alert("Nom de serveur est vide!");
				return;
			}
			if(serversInsert[1].value != "")
			{
				url = url + "&host=" + serversInsert[1].value;
			}else
			{
				alert("host IP est vide!");
				return;
			}
			if(serversInsert[2].value != "")
			{
				url = url + "&port=" + serversInsert[2].value;
			}
			if(serversInsert[3].value != "")
			{
				url = url + "&username=" + serversInsert[3].value;
			}else
			{
				alert("login est vide!");
				return;
			}
			if(serversInsert[4].value != "")
			{
				url = url + "&password=" + serversInsert[4].value;
			}else
			{
				alert("Mot de pass est vide!");
				return;
			}
			if(serversInsert[5].value != "")
			{
				url = url + "&timeout=" + serversInsert[5].value;
			}
			//alert(url);
			get_data(url,"textareaserversInsert")
			get_data('view/ViewServersMonitor.php','divAMI');
			}
		
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
</script>
</body>
</html>

