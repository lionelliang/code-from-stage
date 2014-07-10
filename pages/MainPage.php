<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="HTML Tidy, see www.w3.org" charset="UTF-8">
<title>Sipcom Asterisk Management</title>
</head>
<body>
	<h1>Welcome To Asterisk Servers</h1>

	<b>System Information(%):</b><br>
	<div id="divSystemInformation"></div>
	<br /> 

	<b>AMI : Asterisk Management Interface:</b><br />
	<div id="divAMI"></div>
	<br />	
 
	<b>DB Users:</b><br/>
	<div id="divDBUser"></div>
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
		var int = self.setInterval("get_data('view/SysInformation.php','divSystemInformation')",1000);
	    var int = self.setInterval("get_data('view/ViewPeers.php','divAMI')",1000);
	    var int = self.setInterval("get_data('view/ViewUsers.php','divDBUser')",1000);
</script>
</body>

</html>