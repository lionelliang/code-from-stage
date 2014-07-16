<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '../../bll/Users.php';
$username = $_POST ['username'];
$password = $_POST ['password'];

if (empty ( $username ) || empty ( $password )) {
	echo "Information Incomplete";
	exit ();
}

// Inialize session
session_start();

$result = Users::login ( $username, $password );
$num = mssql_num_rows ( $result );

if ($num == 1) {
	$codeclient = mssql_result($result, 0, 'codeclient');
	session_register ( "codeclient" );
	$_SESSION ["codeclient"] = $codeclient;
	session_register ( "username" );
	$_SESSION ["username"] = $username;
	header ( "Location: ../SendFax.php");
	exit ();
} else {
	echo "Information Incorrecte";
}
?>  