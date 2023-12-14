<?php
session_start();
include('db_connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_POST['id'];
    $IDno = $_POST['IDno'];
    $name = $_POST['name'];
    $status = $_POST['status'];

    // You may want to perform additional validation on the input data

    try {
        // Assuming $conn is a valid database connection object

        // Prepare the SQL statement
        $insertQuery = "INSERT INTO attendance (id_user, IDno, name, status) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertQuery);

        if (!$stmt) {
            throw new Exception(mysqli_error($conn));
        }

        // Bind the parameters
        mysqli_stmt_bind_param($stmt, "ssss",$id_user, $IDno, $name, $status);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Insert successful
            echo "<script>";
            echo "alert('Attendance recorded successfully!');";
            echo "window.location.replace('home.php');";
            echo "</script>";
        } else {
            // Insert failed
            echo "<script>";
            echo "alert('Error: " . mysqli_error($conn) . "');";
            echo "window.location.replace('home.php');";
            echo "</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } catch (Exception $e) {
        // Handle the exception
        echo "<script>";
        echo "alert('An error occurred: " . $e->getMessage() . "');";
        echo "window.location.replace('home.php');";
        echo "</script>";
    }
} else {
    // Redirect to the form if accessed directly without a POST request
    header("Location: your_form_page.php");
    exit();
}
?>