<?php
include_once __DIR__.DIRECTORY_SEPARATOR.'../../bll/Users.php';

try {
	$result= Users::getUsers();
	while($row = mysql_fetch_array($result))
	{
		echo $row['id'] . " " . $row['name'];
		echo "<br />";
	}
	echo "<br/>";
} catch (Exception $e) {
	echo $e->getMessage();
}