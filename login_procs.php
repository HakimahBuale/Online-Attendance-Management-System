<?php
session_start(); // Start the session

require "db_connection.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $IDno = $_POST["IDno"];
    $pswd = $_POST["pswd"];

    try {
        // Assuming $conn is a valid database connection object

        // Check if the email and password match a user record in the database
        $checkQuery = "SELECT * FROM `users` WHERE `IDno` = ? AND `pswd` = ?";
        $stmt = mysqli_prepare($conn, $checkQuery);

        if (!$stmt) {
            // Query preparation failed
            throw new Exception(mysqli_error($conn));
        }

        mysqli_stmt_bind_param($stmt, "ss", $IDno, $pswd);
        mysqli_stmt_execute($stmt);
        $checkResult = mysqli_stmt_get_result($stmt);

        if ($checkResult) {
            // Check if any rows were returned
            if (mysqli_num_rows($checkResult) > 0) {
                // Login successful, store user ID and user type in session
                $userData = mysqli_fetch_assoc($checkResult);
                $_SESSION['id'] = $userData['id'];
                $_SESSION['status'] = $userData['status'];
                $_SESSION['IDno'] = $userData['IDno'];
                $_SESSION['user'] = $userData['user'];
                echo "<script>";
                echo "alert('Successfully inserted!');";
                echo "</script>";
                // Redirect to index.php or display a success message
                header("Location: home.php");
                exit();
            } else {
                // Login failed, display an error message
                echo "<script>";
                echo "alert('Invalid email or password. Please try again.');";
                echo "window.location.replace('index.html');";
                echo "</script>";
            }
        } else {
            // Query execution failed
            throw new Exception(mysqli_error($conn));
        }

        mysqli_close($conn);
    } catch (Exception $e) {
        // Handle the exception and display an error message
        echo "An error occurred: " . $e->getMessage();
    }
}
?>