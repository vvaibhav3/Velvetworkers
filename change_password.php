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
    <title>Change Password</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="./bg-style.css">
</head>

<body>

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

                    <a class="nav-link" href="home.php">Home <?php echo $_SESSION['newusername']; ?></a>
                </h3>
            </li>
        </ul>
    </div>
    </div>
</nav>
    <div class="container p-5">
        <form class="form-group col-md-4" action="" method="post">

            <p class="h2 mb-0">#New Password</p>
            <hr class="mb-3 mt-0">

            <label for="password">Password </label>
            <input type="password" name="password" class="form-control" id="password" placeholder="enter 8 digit password" maxlength="8" required>

            <label for="confirm_password">Confirm Password </label>
            <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="confirm password" maxlength="8" required>

            <center>
                <button type="Submit" name="submit" class="btn btn-danger col-sm-6 my-3">Submit</button>
            </center>
            <hr class="my-4">
        </form>

        <a href="logout.php" class="btn btn-outline-success col-sm-4" role="button">Goto LogIn</a>

    </div>


    <div class="alert alert-danger mb-0">
        <div class="container">
            !Please Enter Both Password Correct And Same
        </div>
    </div>


    <!-- include footer -->
    <?php require("footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>

<?php

if (isset($_SESSION['newusername'])) {

    if (isset($_POST['submit'])) {
        require("conn.php");
        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        if ($password == $_POST['confirm_password']) {
            $password = md5($password);
            
            $username = $_SESSION['newusername'];

            $sql = "UPDATE accounts SET password='$password' WHERE username='$username'";

            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Password updated {$username}');
	            window.location='user.php';</script>";
            } else {
                echo "<script>alert('failed');
	            window.location='user.php';</script>";
            }
        } else {
            
            echo "<script>alert('password does not match with confirm password.. Try Again..')</script>";
        }
    }
} else {
    echo "<script>alert('Failed please try again');
    window.location='user.php';</script>";
}



?>