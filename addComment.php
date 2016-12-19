<?php
require 'database.php';
session_start();

$username=$_SESSION['username'];
$commentary=$_POST['commentary'];
$formID=$_POST['formID'];
$stmt = $mysqli->prepare("insert into comments (comment, username, post_number) values (?,?,?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('sss', $commentary, $username, $formID);
	$stmt->execute();
	$stmt->close();
	header("Location: home.php");
?>
