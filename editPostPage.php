<?php
$fID = $_POST['formID'];

?>
<html>
<head>
	<title>Change Story</title>
<link href="bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="custom.css">
</head>
<body class="upload">
<a href="home.php"><h1> Super Swell Story Sharing Site!</h1></a>
<h2> Change Story!</h2>
<form action="editPost.php" method="post">
<h4>What is the title of your story?</h4>
<input type="text" name="title" required>
<h4>What are your thoughts on the article?</h4>
<input type="text" name="commentary">
<h4>What is the exact link?</h4>
<p>Note: your link must be in the format: http://linkgoeshere.something</p>
<input type="text" name="link">
<h4>What category does your story fall under?</h4> 
<input type="radio" name="category" value="Technology">Technology
<input type="radio" name="category" value="Entertainment">Entertainment
<input type="radio" name="category" value="News">News
<input type="radio" name="category" value="Food">Food
<input type="radio" name="category" value="Sports">Sports
<input type="radio" name="category" value="Other" checked>Other
<input class="submit" type = "submit" value="Submit"/>
<input type ="hidden" name="formID" value="<?php echo $fID ?>"/>
</form>
</body>
</html>
<?php
?>