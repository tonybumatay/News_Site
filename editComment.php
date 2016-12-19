<?php
require 'database.php';
session_start();

$username=$_SESSION['username'];
$commentary=$_POST['commentary'];
$formID=$_POST['formID'];
$stmt = $mysqli->prepare("update comments set comment=? where comment_FalseID=?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('ss', $commentary, $formID);
	$stmt->execute();
	$stmt->close();
	header("Location: home.php");
?>
