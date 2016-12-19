<?php
require 'database.php';
?>
<html>
<head>
	<title>Home</title>
<link href="bootstrap.min.css" rel="stylesheet">
<link href="custom.css" rel="stylesheet">
</head>
<body>
<a href="home.php"><h1> Super Swell Story Sharing Site!</h1></a>
	
	<?php
		session_start();
		if(!isset($_SESSION['username'])){
			?>
			<h4>Login or Create an account to upload or comment</h4>
			<div class="right-btn">
			<form action = "login.html" >
			<input type = "submit" value="Login"/>
			</form>
			<form action = "create_account.html"> 
			<input type = "submit" value="Join"/>
			</form>
			</div>
			<?php
		} else {
			?>
			<div class="right-btn">
			<form action = "user_history.php" method = "GET">
			<input type ="hidden" name="method" value="posts">
			<input type = "submit" value="User History"/>
			</form>
			<form action = "upload.html">
			<input type = "submit" value="Upload Story"/>
			</form>
			<form action = "logout.php">
			<input type = "submit" value="Logout"/>
			</form>
			</div>
			<?php
		}
		?>
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2">
		<form method="GET">
		<input type = "submit" name = "sort" value="Newest"/>
		<input type = "submit" name = "sort" value="Oldest"/> 
		<input type = "submit" name = "sort" value="Technology"/> 
		<input type = "submit" name = "sort" value="Entertainment"/> 
		<input type = "submit" name = "sort" value="News"/> 
		<input type = "submit" name = "sort" value="Food"/> 
		<input type = "submit" name = "sort" value="Sports"/> 
		<input type = "submit" name = "sort" value="Other"/> 
		</form>
			</div>
		</div>
		<?php
		$sort = "";
		if(isset($_GET['sort'])){
			$sort = $_GET['sort'];
		}
 		$inupt = "";	
 		if($sort=='Oldest'){
 			$input = "select * from stories";
 		} else if($sort=='Technology') {
			$input = "select * from stories where categories = 'Technology'";
 		} else if($sort=='Entertainment') {
			$input ="select * from stories where categories = 'Entertainment'";
 		} else if($sort=='News') {
 			$input = "select * from stories where categories = 'News'";
 		} else if($sort=='Food') {
 			$input ="select * from stories where categories = 'Food'";
 		} else if($sort=='Sports') {
 			$input = "select * from stories where categories = 'Sports'";
 			
 		} else if($sort=='Other') {
 			$input = "select * from stories where categories = 'Other'";
 			
 		} else {
 			$input = "select * from stories order by created desc";
 			
 		}
 		 	$stmt = $mysqli->prepare($input);

 			if(!$stmt){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
		$stmt->execute();
		 
		$stmt->bind_result($t, $l, $com, $u, $cat, $fID, $date);
		 
		
		while($stmt->fetch()){
			printf("\t<hr><div class='row stories'><h2><a href='%s'> %s</a></h2><div class='col-sm-8 col-sm-offset-2'> <p>%s</p> <p>Created by: %s Category: %s</p></div></div>\n",
				htmlspecialchars($l),
				htmlspecialchars($t),
				htmlspecialchars($com),
				htmlspecialchars($u),
				htmlspecialchars($cat)
			);?>
			<form action="comments.php" method="GET">
			<input class="submit comments-btn" type = "submit" value="View Comments"/>
			<input type ="hidden" name="formID" value="<?php echo $fID ?>"/>
			</form>
			<hr>
			<?php
		}
		#echo "</ul>\n";
		 
		$stmt->close();
	?>
</body>
</html>

