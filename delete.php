<?php
session_start();
include('db_connection.php');

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // You may want to perform additional validation on the input data

    try {
        // Assuming $conn is a valid database connection object

        // Prepare the SQL statement to delete the user
        $deleteQuery = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($conn, $deleteQuery);

        if (!$stmt) {
            throw new Exception(mysqli_error($conn));
        }

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "i", $userId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Deletion successful
            echo "User deleted successfully!";
            // Redirect to home page or any other page after deletion
            header("Location: home.php");
            exit();
        } else {
            // Deletion failed
            echo "Error: " . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } catch (Exception $e) {
        // Handle the exception
        echo "An error occurred: " . $e->getMessage();
    }
} else {
    // Redirect to the form if accessed directly without an ID
    header("Location: home.php");
    exit();
}
?>