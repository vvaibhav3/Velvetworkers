<!DOCTYPE html>
<html>

<head>

    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: logout.php');
    } else {
        if (strpos($_SESSION['username'], "@admin") == false) {
            header('location: logout.php');
        }
    }
    ?>
    <title>Forgotten Password</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="./bg-style.css">
</head>

<body style="background-color: #E8DAEF">
    
<nav class="navbar navbar-expand-lg navbar-dark" style="background-image:linear-gradient(to right,#72efdd,#6a00f4);">

<div class="container">

    <a class="navbar-brand" href="#" style="color:#EEEEEE;">
        <h1><img src="./images/tire.svg" width="50" height="50" class="d-inline-block align-top" alt="menubar">
            SCC</h1>
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto mt-2 ">
            <li class="nav-item">
                <h3>

                    <a class="nav-link" href="home.php">Home</a>
                </h3>
            </li>
        </ul>
    </div>
    </div>
</nav>
    <div class="container shadow p-5">
        <form class="form-group col-md-4" action="" method="post">

            <p class="h2 mb-0">#Enter Data</p>
            <hr class="mb-3 mt-0">

            <label for="username">Username </label>
            <input type="text" name="new_username" class="form-control" id="username" placeholder="Enter Username" required>

            <label for="mobile_no">Mobile No </label>
            <input type="tel" name="mobile_no" class="form-control" id="password" pattern="[1-9]{1}[0-9]{9}" placeholder="8088****90" required>

            <center>
                <button type="Submit" name="submit" class="btn btn-danger col-sm-4 my-3">Submit</button>
            </center>
        </form>
    </div>

    <!-- 
<div class="alert alert-danger mb-0">
		<div class="container">
		OTP will be send on your mobile no...
		</div>
</div> -->

    <!-- include footer -->
    <?php require("footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>

<?php

if (isset($_POST['submit'])) {
    require("conn.php");
    $username = mysqli_real_escape_string($conn, $_POST["new_username"]);
    $mobile_no = mysqli_real_escape_string($conn, $_POST["mobile_no"]);

    $sql = "SELECT username,password FROM accounts WHERE username= '$username' AND mobile_no= '$mobile_no' LIMIT 1";

    //echo "username is $username and password is $password";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result)) {
        $_SESSION['newusername'] = $_POST['new_username'];
        $_SESSION['mobile_no'] = $_POST['mobile_no'];
        //Multiple mobiles numbers separated by comma
        $mobileNumber = $_SESSION['mobile_no']; 
        header('location: change_password.php');

    } else {
        
	echo "<script>alert('Username and Mobile Number not Matched OR Not Found');
	window.location='forgotten_password.php';</script>";
    }
}
?>