
<?php
	if(isset($_POST['myoption'])) {
	    $type= $_POST['myoption'];
	    echo $type;
	}
	if(isset($_POST['studentid'])) {
	    $name = $_POST['studentid'];
	    echo $name;
	}
	if(isset($_POST['password'])) {
	    $pass = $_POST['password'];
	    echo $pass;
	}
?>
