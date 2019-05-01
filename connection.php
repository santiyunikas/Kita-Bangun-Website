<?php
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "kitabangun";
	$conn = mysqli_connect($dbhost,$dbuser,$dbpass) or die("Failed");
	mysqli_select_db($conn, $dbname) or die("Database not exist");