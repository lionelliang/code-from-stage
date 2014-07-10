<?php
include_once __DIR__ . DIRECTORY_SEPARATOR . '../../bll/Users.php';
$username = $_POST ['username'];
$password = $_POST ['password'];

if (empty ( $username ) || empty ( $password )) {
	echo "Information incomplete";
	exit ();
}

$result = Users::login ( $username, $password );
$num = mysql_numrows ( $result );

if ($num == 1) {
	$usertype = mysql_result( $result, 0, "usertype" );
	session_register ( "username" );
	$_SESSION ["username"] = $username;
	echo $usertype;
	if ($usertype == 1) {
		header ( "Location: ../index.php?usertype");
		exit ();
	} else {
		header ( "Location: ../SendFax.php?usertype" );
		exit ();
	}
} else {
	echo "Information incorrecte";
}
?>  