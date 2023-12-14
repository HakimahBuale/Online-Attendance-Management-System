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

                <div>
                    <center>
                        <form action="insert_attendance.php" style="padding-top: 0px;" method="POST" style="background-color:powderblue;">
                            <div style="display: none;" style="background-color:powderblue;">
                            <!-- Hidden input for ID number -->
                                <label for="fname">Enter your ID number</label>
                                <input type="text" id="fname" name="IDno" value="<?php echo $user_IDno; ?>" placeholder="Your ID number..">
                                <input type="text" id="fname" name="id" value="<?php echo $user_id; ?>" placeholder="Your ID number..">
                                <!-- Hidden input for name -->
                                <label for="lname">Enter your name</label>
                                <input type="text" id="lname" name="name" value="<?php echo $user_name; ?>" placeholder="Your name..">
                                <input type="text" id="lname" name="status" value="<?php echo $status; ?>" placeholder="Your name..">
                            </div>
                            <label for="lname">Press Submit To Enter Attendance.</label><br>
                            <input type="submit" value="Submit">
                        </form>
                    </center>
                </div>
<div class="row">
     <?php if ($status == 1): ?>
    <?php
    $sql = "SELECT a.*, b.image_path, a.id_user FROM attendance a LEFT JOIN users b ON b.id = a.id_user WHERE b.status = 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $image_path = $row["image_path"];
            $IDno = $row["IDno"];
            $name = $row["name"];
            $status = $row["status"];
            $date = $row["date"];
            ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $image_path; ?>" class="card-img-top profile-img" alt="Profile Image" style="width: 100px; height: 100px;">
                    <div class="card-body">
                        <h1 class="card-title text-primary"><?php echo $name; ?></h1>
                        <h1 class="card-text">IDno: <?php echo $IDno; ?></h1>
                        <h4 class="card-text text-warning">Date: <?php echo $date; ?></h4>
                        <h2 class="card-text">
                            <span class="badge badge-secondary badge-pill badge-success">
                                <?php echo ($status == 2) ? 'Student' : 'Teacher'; ?>
                            </span>
                        </h1>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<div class='col-md-12'><p>No data found.</p></div>";
    }
    ?>

     <?php elseif ($status == 2): ?>
    <?php
    $sql = "SELECT a.*, b.image_path, a.id_user FROM attendance a LEFT JOIN users b ON b.id = a.id_user  WHERE b.status = 2";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $image_path = $row["image_path"];
            $IDno = $row["IDno"];
            $name = $row["name"];
            $status = $row["status"];
            $date = $row["date"];
            ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 18rem;">
                    <img src="<?php echo $image_path; ?>" class="card-img-top profile-img" alt="Profile Image" style="width: 100px; height: 100px;">
                    <div class="card-body">
                        <h1 class="card-title text-primary"><?php echo $name; ?></h1>
                        <h1 class="card-text">IDno: <?php echo $IDno; ?></h1>
                        <h4 class="card-text text-warning">Date: <?php echo $date; ?></h4>
                        <h2 class="card-text">
                            <span class="badge badge-secondary badge-pill badge-success">
                                <?php echo ($status == 2) ? 'Student' : 'Teacher'; ?>
                            </span>
                        </h1>
                    </div>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<div class='col-md-12'><p>No data found.</p></div>";
    }
    ?>

    <?php elseif ($status == 0): ?>
     <table class="table">
    <thead>
        <tr>
            <th>IDno</th>
            <th>Name</th>
            <th>Status</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Assuming you have a valid database connection object $conn
        $sql = "SELECT * FROM users";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $image_path = $row["image_path"];
                $IDno = $row["IDno"];
                $user = $row["user"];
                $status = $row["status"];
                ?>
                <tr>
                    <td><?php echo $IDno; ?></td>
                    <td><?php echo $user; ?></td>
                    <td><?php echo ($status == 2) ? 'Student' : 'Teacher'; ?></td>
                    <td><img src="<?php echo $image_path; ?>" class="profile-img" alt="Profile Image" style="width: 50px; height: 50px;"></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='6'>No data found.</td></tr>";
        }

        // Close the result set
        if ($result) {
            mysqli_free_result($result);
        }
        ?>
    </tbody>
</table>

    <?php endif; ?>
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