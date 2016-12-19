<?php
require 'database.php';
session_start();
$fID = $_POST['formID'];
$stmt = $mysqli->prepare("delete from comments where comment_FalseID=?");
if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('s', $fID);
	$stmt->execute();
	$stmt->close();
	header("Location: user_history.php?method=comments");



?>