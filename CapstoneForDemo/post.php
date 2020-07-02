<html>
<head>

	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<title>Post Page</title>
	<link type="text/css" rel="stylesheet" href="css/style.css">
	<script src="javascript/javascript.js" type="text/javascript"></script>

</head>
<body>
	<!-- PHP - post.php -->
	<?php	
		session_start();
		//posting content to log.html
	    $text = $_POST['text'];		     
	    $fp = fopen("log.html", 'a+');
	    fwrite($fp, "<div class='msgln'>(".date("g:i A") . ") <b>" . $_SESSION['username'] . "</b>: " . stripslashes(htmlspecialchars($text))."<br></div>");
	    fclose($fp);		
	?>
</body>
</html>