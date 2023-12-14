<?php

require "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $IDno = $_POST["IDno"];
    $user = $_POST["user"];
    $pswd = $_POST["pswd"];

    // File upload handling
    $targetDirectory = "img/"; // Directory where you want to store the uploaded images
    $imageName = $_FILES["image"]["name"];

    // Rename the file if needed (you can customize the new name as per your requirements)
    $newImageName = "new_image_" . time() . "." . pathinfo($imageName, PATHINFO_EXTENSION);
    $targetPath = $targetDirectory . $newImageName;

    // Move uploaded image to the desired location with the new name
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
        echo "The file " . htmlspecialchars($newImageName) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Insert user data into the database
    $sql = "INSERT INTO `users`(`IDno`, `user`, `pswd`, `image_path`, `status`) 
            VALUES ('$IDno','$user','$pswd','$targetPath',2)";

    if (mysqli_query($conn, $sql)) {
        echo "<script>";
        echo "alert('Successfully Created!');";
        echo "window.location.replace('index.html');";
        echo "</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>