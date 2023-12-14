<?php
  $servername = "sql207.infinityfree.com";
  $username = "if0_35560999";
  $password = "gmXKrVg0AZlrz";
  $dbname = "if0_35560999_project";

// Create connection

$conn = mysqli_connect($servername, $username, $password, $dbname);
	// Check connection
	if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
	}else {
	 echo "";
	}

?>