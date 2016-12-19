<?php
session_start();
require 'database.php';
?>
<html>
<head>
	<title>History</title>
<link href="bootstrap.min.css" rel="stylesheet">
<link href="custom.css" rel="stylesheet">
</head>
<body>
<a href="home.php"><h1> Super Swell Story Sharing Site!</h1></a>
<form method = "GET">
		<br> <input type = "submit" name = "method" value="posts" checked/> Posts <br>
		<input type = "submit" name = "method" value="comments"/> Comments <br>
	</form>
	<?php
		$user = $_SESSION['username'];
		$view = $_GET['method'];
		if($view == 'posts'){
						$stmt = $mysqli->prepare("select * from stories where username=?");
			if(!$stmt){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
	 		$stmt->bind_param("s", $user);

			$stmt->execute();
			 
			$stmt->bind_result($t, $l, $com, $u, $cat, $fID, $date);
			 
			while($stmt->fetch()){
				printf("\t<div class='row stories'><h2><a href='%s'> %s</a></h2><div class='col-sm-8 col-sm-offset-2'> <p>%s</p> <p>Created by: %s Category: %s</p></div></div>\n",
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
			<form action="deletePost.php" method="POST">
			<input class="submit comments-btn" type = "submit" value="Delete this post"/>
			<input type ="hidden" name="formID" value="<?php echo $fID ?>"/>
			</form>
			</form>	
			<form action="editPostPage.php" method="POST">
			<input class="submit comments-btn" type = "submit" value="Edit this post"/>
			<input type ="hidden" name="formID" value="<?php echo $fID ?>"/>
			</form>
			<?php
			}
			 
			$stmt->close();
	} else {
			$stmt = $mysqli->prepare("select comment, title, link, comment_FalseID from comments join stories on (comments.post_number=stories.false_id) where comments.username=?");
			if(!$stmt){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
	 		$stmt->bind_param("s", $user);
	 		
			$stmt->execute();
			 
			$stmt->bind_result($c, $t, $l, $cfid);
			 
			while($stmt->fetch()){
				printf("\t<div class='row comments'><h2><a href='%s'> %s</a></h2><div class='col-sm-8 col-sm-offset-2'> <p>%s</p></div></div>\n",
					htmlspecialchars($l),
					htmlspecialchars($t),
					htmlspecialchars($c)
				);?>
			<form action="deleteComment.php" method="POST">
			<input class="submit comments-btn" type = "submit" value="Delete this comment"/>
			<input type ="hidden" name="formID" value="<?php echo $cfid ?>"/>
			</form>
			<form action="editCommentPage.php" method="POST">
			<input class="submit comments-btn" type = "submit" value="Edit this comment"/>
			<input type ="hidden" name="formID" value="<?php echo $cfid ?>"/>
			</form>
			<?php
			}
			 
			$stmt->close();
	}
	?>
</body>
</html>