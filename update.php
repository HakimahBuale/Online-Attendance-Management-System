<?php
session_start();
include('db_connection.php');

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['id'];
    $IDno = $_POST['IDno'];
    $user = $_POST['user'];
    $status = $_POST['status'];

    // You may want to perform additional validation on the input data

    try {
        // Assuming $conn is a valid database connection object

        // Prepare the SQL statement to update the user
        $updateQuery = "UPDATE users SET IDno = ?, user = ?, status = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $updateQuery);

        if (!$stmt) {
            throw new Exception(mysqli_error($conn));
        }

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ssii", $IDno, $user, $status, $userId);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Update successful
            echo "User updated successfully!";
            // Redirect to home page
            header("Location: home.php");
            exit();
        } else {
            // Update failed
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
    // Redirect to the form if accessed directly without a POST request
    header("Location: edit_user.php?id=" . $userId);
    exit();
}
?>