<!DOCTYPE html>
<html lang="fr">
<head>
<meta name="generator" content="HTML Tidy, see www.w3.org" charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/Site.css">
<title>Sipcom Asterisk Management</title>
</head>

<body onload="faxSentSelect();faxReceivedSelect()">

	<h1>Sending Fax Page</h1>
	<div id='divall'>
		<div id='divleft'>
			Le Log des fax est effectuer par le fichier AGI LogReceiveFax.php <br/><br/>
		
			Choisir un fichier à envoyer par fax(le nom soit seulement nombre, lettre et tiré bas.pdf,.tiff):
			<form method="post" target='iframeUploaded'
				action="../bll/file_uploader.php" enctype="multipart/form-data">
				<input type="hidden" name="MAX_FILE_SIZE" value="10000000" /> <input
					id="inputUpload" type='file' name='upfile' /> <br> <input
					type='submit' value="upload" />
			</form>
			<label id="lblupload"></label>
			<iframe name="iframeUploaded" id="iframeUploaded"
				style="display: no;" height="50" width="400"></iframe>
			<br> <br>To Whom: <input id="inputNumber" type="text"
				name="telnumber" required pattern="[0-9]{10} maxlength="
				10" value="0143006375"> <br> <br>
			<button onclick="sendfax()">Send Fax</button>
			<br> <br>
			<textarea id="textareaFaxSent" rows="30" cols="70">Sending Fax Page&#13;&#10;</textarea>
		</div>
		<div id='divmiddle'></div>
		<div id='divright'></div>
	</div>
	<br>

	<script type="text/javascript">

		function sendfax(){
				//var url = "view/ViewFax.php?number=0143006375&file=fax.tif";
				var url = "view/ViewSendFax.php?number=";
				var upfileElement = document.getElementById("inputUpload");
				var fullPath = upfileElement.value.trim();
				var iframeElement = document.getElementById("iframeUploaded");
				var iframeMsg = iframeElement.contentWindow.document.body.innerHTML;
				
				var telnumberElement = document.getElementById("inputNumber");
				var telnumber = telnumberElement.value.trim();
				if(fullPath==null || fullPath=='')
				{
					alert("choose a file to send");
					upfileElement.focus();
					return;
			    }
			    else
				{
					var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
					var fileName = fullPath.substring(startIndex);
					if (fileName.indexOf('\\') === 0 || fileName.indexOf('/') === 0)
					{
						fileName = fileName.substring(1);
					}
				}
				if(iframeMsg.indexOf("successfully") == -1)
				{
					alert("upload chosen file");
					return;
				}
				if(telnumber==null || telnumber=='')
				{
					alert("no destanation number");
					telnumberElement.focus();
					return;
			    }
				url += telnumber;
				url = url + "&file=" + fileName;
				alert("send " + fileName + " to " + telnumber);
				get_data(url,"textareaFaxSent");
				document.getElementById("textareaFaxSent").innerHTML+=xmlhttp.responseText;
				document.getElementById("iframeUploaded").contentWindow.document.body.innerHTML="";
				}
		
		function faxSentDelete(){
			var url = "actions/DBFaxSent.php?method=delete&";
			var faxSentDelete = document.getElementsByName("faxSentDelete");
			isChecked = false;
			//For each checkbox see if it has been checked, record the value.
			for (i = 0; i < faxSentDelete.length; i++)
			{
				if(faxSentDelete[i].checked){
					url = url + "fax" + i + "=" + faxSentDelete[i].value + "&";
					isChecked = true;
				}
			}

			if(!isChecked){
				alert("Choisissez fax log à supprimer!");
				return;
			}
			url = url.slice(0,-1);
			//alert(url);
			get_data(url, null);
			faxSentSelect();
			}

		function faxSentSelect(){
			var url = "actions/DBFaxSent.php?method=select";
			get_data(url,"divmiddle");	
			}

		function faxReceivedDelete(){
			var url = "actions/DBFaxReceived.php?method=delete&";
			var faxReceivedDelete = document.getElementsByName("faxReceivedDelete");
			isChecked = false;
			//For each checkbox see if it has been checked, record the value.
			for (i = 0; i < faxReceivedDelete.length; i++)
			{
				if(faxReceivedDelete[i].checked){
					url = url + "fax" + i + "=" + faxReceivedDelete[i].value + "&";
					isChecked = true;
				}
			}

			if(!isChecked){
				alert("Choisissez fax log à supprimer!");
				return;
			}
			url = url.slice(0,-1);
			//alert(url);
			get_data(url, null);
			faxReceivedSelect();
			}

		function faxReceivedSelect(){
			var url = "actions/DBFaxReceived.php?method=select";
			get_data(url,"divright");	
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
