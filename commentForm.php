<?php
?>
<html>
<head>
	<title>Add Comment</title>
<link href="bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="custom.css">
</head>
<?php
$formID=$_POST['formID'];
?>
<body class="upload">
<a href="home.php"><h1> Super Swell Story Sharing Site!</h1></a>
<h4>What are your thoughts on this post?</h4>
<form action="addComment.php" method="POST">
<input type="text" name="commentary">
<input class="submit" type = "submit" value="Post Comment"/>
<input type ="hidden" name="formID" value="<?php echo $formID ?>"/>
</form>
</body>
</html>
<?php
?>