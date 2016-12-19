<?php
require 'database.php';
session_start();
$fID = $_POST['formID'];
$stmt = $mysqli->prepare("delete from stories where false_id=?");
if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('s', $fID);
	$stmt->execute();
	$stmt->close();
	header("Location: user_history.php?method=posts");
?>