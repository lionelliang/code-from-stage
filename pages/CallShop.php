<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="HTML Tidy, see www.w3.org"
	charset="UTF-8">
<title>Sipcom Asterisk Management</title>
</head>
<body onload="get_data('view/ViewServersMonitor.php','divAMI');">
	<h1>Sipcom Callshop Monitoring</h1>
	Ajouter un serveur:
	<br>
	<div>
		<table>
			<tr>
				<td>Nom de Société</td>
				<td><input type="text" name="callshopInsert" /><br></td>
			</tr>
			<tr>
				<td>Address</td>
				<td><input type="text" name="callshopInsert" /><br></td>
			</tr>
			<tr>
				<td>CP</td>
				<td><input type="text" name="callshopInsert" /><br></td>
			</tr>
			<tr>
				<td>Ville</td>
				<td><input type="text" name="callshopInsert" /><br></td>
			</tr>
			<tr>
				<td colspan="2" align="right">
					<button onclick="callshopInsert()">Ajouter un serveur</button></td>
			</tr>
		</table>
		<textarea id="textareaCallshopInsert" rows="2" cols="40">Ajouter un callshop&#13;&#10;</textarea>
	</div>
	<br />
	<br />
	<div id="divAMI">Information de Callshop, attendez...............</div>
	<br>

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
	    var int = self.setInterval("get_data('view/ViewCallshop.php','divAMI')",1000);

		function callshopDelete(id){
			var url = "actions/DBCallshop.php?method=delete&id="+id;
			alert("Supprimez callshop "+id+"?");
			get_data(url,"textareaCallshopDelete");
			}

		function callshopInsert(){
			var url = "actions/DBCallshop.php?method=insert";
			var callshopInsert = document.getElementsByName("callshopInsert");
			if(callshopInsert[0].value != "")
			{
				url = url + "&societe=" + callshopInsert[0].value;
			}else
			{
				alert("Nom de societe est vide!");
				return;
			}
			if(callshopInsert[1].value != "")
			{
				url = url + "&addresse=" + callshopInsert[1].value;
			}
			if(callshopInsert[2].value != "")
			{
				url = url + "&cp=" + callshopInsert[2].value;
			}
			if(callshopInsert[3].value != "")
			{
				url = url + "&ville=" + callshopInsert[3].value;
			}
			//alert(url);
			get_data(url,"textareaCallshopInsert");
			}
</script>
</body>
</html>
