<?php
session_start();
include('db_connection.php');
$user_id = $_SESSION['id'];
$user_name = $_SESSION['user'];
$user_IDno = $_SESSION['IDno'];
$status = $_SESSION['status'];

?>

<!DOCTYPE html>
<html lang="en">
<style>
input[type=text], select {
  width: 30%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 10%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  display: inline-block;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

div {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 5px;
padding-bottom: 0px;
}
</style>
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<title>Gamepad</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">	
<!-- bootstrap css -->
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<!-- style css -->
<link rel="stylesheet" type="text/css" href="css/style.css">
<!-- Responsive-->
<link rel="stylesheet" href="css/responsive.css">
<!-- fevicon -->
<link rel="icon" href="images/fevicon.png" type="image/gif" />
<!-- Scrollbar Custom CSS -->
<link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
<!-- Tweaks for older IEs-->
<!-- owl stylesheets --> 
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body style="background-color:powderblue;">
	<!-- header section start -->
	<div class="header_section">
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">

                <button type="button" class="btn btn-danger" onclick="window.location.href='logout.php'">Logout</button>

              </ul>
            </div>
        </nav>
	</div>
	<!-- header section end -->
	<!-- product section start -->
</div>
<div class="body2" style="background-color:powderblue;">
        
<div class="container">
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the order details from the database
    $sql = "SELECT * FROM users WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $IDno = $user["IDno"];
        $user_name = $user["user"];
        $status = $user["status"];
?>
        <h2>Edit User</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <label for="IDno">IDno:</label>
            <input type="text" name="IDno" value="<?php echo $IDno; ?>"><br>

            <label for="user">Name:</label>
            <input type="text" name="user" value="<?php echo $user_name; ?>"><br>

            <label for="status">Status:</label>
            <select name="status">
                <option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>Teacher</option>
                <option value="2" <?php echo ($status == 2) ? 'selected' : ''; ?>>Student</option>
            </select><br>

            <!-- Add other fields as needed -->

            <input type="submit" value="Update">
        </form>
<?php
    } else {
        echo "User not found.";
    }
}
?>

</div>
</div>






</div>


   
	<!-- product section end -->


	<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>
</html>