<?php
require 'database.php';
session_start();
$username=$_SESSION['username'];
$title=$_POST['title'];
$commentary=$_POST['commentary'];
$link=$_POST['link'];
$category=$_POST['category'];

$stmt = $mysqli->prepare("insert into stories (title, link, commentary, username, categories, created) values (?,?,?,?,?, ?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$dateTime=date('Y-m-d H:i:s');
	$stmt->bind_param('ssssss', $title, $link, $commentary, $username, $category, $dateTime);
	$stmt->execute();
	$stmt->close();
	header("Location: home.php");
?>