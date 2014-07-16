<?php
//namespace sipcom\dal;

class Variables{

	//asterisk server
	public static $strThisServerIP ="192.168.0.20";
	public static $strAsteriskIp ="localhost";			// "192.168.0.160";
	public static $strAsteriskPort = "5038";
	public static $strAsteriskUser="admin";
	public static $strAsteriskPassword="123456";
	public static $strAsteriskTimeOut="2000";

	//mysql server
	public static $strMysqlIp = "localhost:3306";
	public static $strMysqlUser="asterisk";
	public static $strMysqlPassword="123456";
	
	//database
	public static $strSipcomcall = "sipcomcall";
	public static $strAsterisk = "asterisk";
	public static $strSipcom = "sipcom";				// sipcom in windows SQL server 
	public static $strSipcomweb = "sipcomweb";			// sipcomweb in windows SQL server 
	
	//parameters' name
	public static $strTrunk = "SIP/sipcomtrunk/";		//sipcomdevtrunk, sipcomtrunk
	public static $strContext = "internal";				//internal, sipint
	
	//upload file
	//public static $strMAX_FILE_SIZE = 10000000;
	
	//Microsoft SQL server
	public static $strMicrosoftsqlIp = "192.168.0.97";
	public static $strMicrosoftsqlUser = "sa";
	public static $strMicrosoftsqlPassword = "123456";
}
?>
