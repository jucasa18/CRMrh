<?php
	$dbHost = "127.0.0.1";
	$dbDatabase = "rh";
	$dbPasswrod = "";
	$dbUser = "root";
	$conexion = mysqli_connect($dbHost, $dbUser, $dbPasswrod, $dbDatabase);

	if (!$conexion) {
		die ( "Connection Failed: " . mysqli_connect_error($con) );
	}
?>
