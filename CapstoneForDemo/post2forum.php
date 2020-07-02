<html>
<head>
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Post2Forum Page</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
	<script src="javascript/javascript.js" type="text/javascript"></script>
</head>
<body>
	<!-- PHP - post.php -->
	<?php	
		//posting content to forum.html
	session_start();
	    $text = $_POST['text'];		     
	    $fp = fopen("forum.html", 'a');
	    fwrite($fp, "<div class='msgln'>(".date("g:i A") . ") <b>" . $_SESSION['username'] . "</b>: " . stripslashes(htmlspecialchars($text))."<br></div>");
	    fclose($fp);		
	?>
</body>
</html>