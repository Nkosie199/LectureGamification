<?php
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$database_name = "Gamification";

	$con = mysql_connect($hostname, $usename, $password);
	if (!$con){
		die("Can not connect: " . mysql_error());
	}

	if (mysql_query("CREATE DATABASE " . $database_name, $con)){
		echo "Your ". $database_name ." Database was created successfully!";
	} else echo "Error!" . mysql_error();

	mysql_close($con);
?>