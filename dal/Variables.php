<?php
//namespace sipcom\dal;

class Variables{

	//asterisk server
	public static $strAsteriskIp ="localhost";// "192.168.0.160";
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
	
	//parameters' name
	public static $strTrunk = "SIP/sipcomtrunk/";	//sipcomdevtrunk, sipcomtrunk
	public static $strContext = "internal";				//internal, sipint
	
	//upload file
	//public static $strMAX_FILE_SIZE = 10000000;
}
?>
