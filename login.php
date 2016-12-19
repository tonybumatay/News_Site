<?php
	session_start();
	require 'database.php';
	$username= $_POST['username'];
	$password=$_POST['password'];
	if( !preg_match('/^[\w_\.\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

if( !preg_match('/^[\w_\.\-]+$/', $password) ){
	echo "Invalid password";
	exit;
}
	$stmt = $mysqli->prepare("select password from users where username=?");
		if(!$stmt){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$stmt->bind_param("s", $username);
 
		$stmt->execute();
		 
		$stmt->bind_result($hashed);
		$stmt->fetch();

		if(password_verify($password, $hashed)){
			header("Location: home.php");
			$_SESSION['username'] = $username;
			exit;
		} else {
			$newHashed = password_hash($password, PASSWORD_DEFAULT);
			echo $newHashed.'\n';
			echo $hashed.'\n';
			echo 'didnt match';
			//header("Location: login.html");

		}
		?>