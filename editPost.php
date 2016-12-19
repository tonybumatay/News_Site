<?php
require 'database.php';
session_start();
$username=$_SESSION['username'];
$title=$_POST['title'];
$commentary=$_POST['commentary'];
$link=$_POST['link'];
$category=$_POST['category'];
$fID = $_POST['formID'];

$stmt = $mysqli->prepare("update stories set title=?, link=?, commentary=?, categories=? where false_id = ?");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param("sssss", $title, $link, $commentary, $category, $fID);
	$stmt->execute();
	$stmt->close();
	header("Location: home.php");
?>