<?php
require 'database.php';

$usernamen = $_POST['usern'];
$passwordw = $_POST['passw'];
$verifyv = $_POST['verify_password'];


if( !preg_match('/^[\w_\.\-]+$/', $usernamen) ){
	echo "Invalid username";
	exit;
}

if( !preg_match('/^[\w_\.\-]+$/', $passwordw) ){
	echo "Invalid password";
	exit;
}

if($passwordw == $verifyv){
	$hashed = password_hash($passwordw, PASSWORD_DEFAULT);
	$date = date('Y-m-d');
	$stmt = $mysqli->prepare("insert into users (username, password, created) values (?,?,?)");
	if(!$stmt){
		printf("Query Prep Failed: %s\n", $mysqli->error);
		exit;
	}
	$stmt->bind_param('sss', $usernamen, $hashed, $date);
	$stmt->execute();
	$stmt->close();
	echo("end");
	header("Location: home.php");
} else {
	header("Location: create_account.html");
	//echo "You have entered an invalid username or password. Try again.";
	exit;
}




?>