<!DOCTYPE html>
<html>
<head>
<meta name="generator" content="HTML Tidy, see www.w3.org" charset="UTF-8">
<title>Sipcom Asterisk Management</title>
</head>

<body>
	<h1>Dial out page</h1>
	Choose unpaid users to dial:
	<br>
	<?php
	include_once __DIR__.DIRECTORY_SEPARATOR.'../bll/Bills.php';
	$unpaidUsers = Bills::getUnPaidBills();
	$i = 0;
	foreach($unpaidUsers as $id => $user){
		echo "<input type='checkbox' name='unpaidusers' value=$user> $user<br>";
		$i++;
	}
	?>
	<br>
	<button onclick="dialout()">Call them to pay</button>
	<br>
	<br>
	<input type='text' id="inputdialoutDirect" value="0123456781">
	<button onclick="dialoutDirect()">Call him to pay</button>
	<br>
	<textarea id="textareaDialOut" rows=35 cols="50">Call those who didn't pay...&#13;&#10;
</textarea>

	<br>

	<script type="text/javascript">
		function dialout(){
				var url = "view/ViewDialOut.php?";
				var unpaidusers = document.getElementsByName("unpaidusers");
				isChecked = false;
				//For each checkbox see if it has been checked, record the value.
				var i;
				for (i = 0; i < unpaidusers.length; i++)
				{
					if(unpaidusers[i].checked){
						url = url + "user" + i + "=" + unpaidusers[i].value + "&";
						isChecked = true;
					}
				}

				if(!isChecked){
					alert("choose unpaied user!");
					return;
				}
				url = url.slice(0,-1);
				alert("Appellez les utilisateurs?");
				get_data(url,"textareaDialOut");
				}

		function dialoutDirect(){
			var url = "view/ViewDialOut.php?";
			var inputdialoutDirect = document.getElementById("inputdialoutDirect");
			isChecked = false;
			url = url + "user=" + inputdialoutDirect.value;

			alert("Appellez "+inputdialoutDirect.value+" ?");
			get_data(url,"textareaDialOut");
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

