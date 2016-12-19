<?php
require 'database.php';
?>
<html>
<head>
	<title>Comments</title>
<link href="bootstrap.min.css" rel="stylesheet">
<link href="custom.css" rel="stylesheet">
</head>
<body>
<a href="home.php"><h1> Super Swell Story Sharing Site!</h1></a>
<?php
session_start();
$formID=$_GET['formID'];
if(!isset($_SESSION['username'])){
?>
			<form action = "login.html" >
			<input type = "submit" value="Login"/>
			</form>
			<form action = "create_account.html"> 
			<input  type = "submit" value="Join"/>
			</form>
			<?php
		} 
	else {
		?>
			<form action = "commentForm.php" method="POST">
			<input class="comments-btn" type = "submit" value="Add Comment"/>
			<input type ="hidden" name="formID" value="<?php echo $formID ?>"/>
			</form>
			<?php
	}

$stmt = $mysqli->prepare("select comment, username from comments where post_number=?");
if(!$stmt){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
			$stmt->bind_param("s", $formID);

			$stmt->execute();
			 
			$stmt->bind_result($c, $u);

			while($stmt->fetch()){
				printf("\t<div class='row comments'><div class='col-sm-8 col-sm-offset-2'> <p>%s</p> <p>Comment by: %s</p></div></div>\n",
					htmlspecialchars($c),
					htmlspecialchars($u)
				);
			}
?>
</body>
</html>
