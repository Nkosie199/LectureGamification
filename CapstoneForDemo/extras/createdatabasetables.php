<?php
	$hostname = "localhost";
	$username = "root";
	$password = "";
	$table_name = "Students"

	$con = mysql_connect($hostname, $usename, $password);
	if (!$con){
		die("Can not connect: " . mysql_error());
	}

	mysql_select_db($database_name, $con);
	$sql = "CREATE TABLE " . $table_name . "( 
	StudentNumber varchar(20), 
	Password varchar(20), 
	Courses varchar ARRAY[10], 
	Groups varchar ARRAY[10], 
	Points int, 
	ProfilePicture nvarchar(max)
	)";

	if ((mysql_query($sql, $con)){
		echo ""
	}

	mysql_close($con);
?>