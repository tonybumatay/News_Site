<?php
$mysqli = new mysqli('localhost', 'phpBuddy', 'phpPassword','forum');
if($mysqli->connect_errno){
	printf("Connection failed: %s\n", $mysqli->connect_error);
	exit;
}
?>