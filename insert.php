<?php
include('db_connection.php');
	$pr_name = $_POST["pr_name"];
	$pr_price = $_POST["pr_price"];
	$pr_info = $_POST["pr_info"];
	// File upload handling
	$image = $_FILES["image"];
	$imageName = $image["name"];
	$imageTmpName = $image["tmp_name"];

	// Move uploaded image to a desired location
	$targetDirectory = "img/";  // Directory where you want to store the uploaded images
	$targetPath = $targetDirectory . $imageName;
	move_uploaded_file($imageTmpName, $targetPath);

	$sql = "INSERT INTO tbl_products (pr_name, pr_price, pr_info, img) 
	        VALUES ('$pr_name','$pr_price', '$pr_info', '$targetPath')";

	if (mysqli_query($conn, $sql)) {
	  echo "<script type='text/javascript'>alert('Successfully Saved!'); window.location.replace('insert_product.php'); </script>";

	} else {
	  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);
?>