<!DOCTYPE html>
<html>
<head>
    <?php
           session_start();
           if (!isset($_SESSION['username'])) {
               header('location: logout.php');
           }
           else{
            if(strpos($_SESSION['username'],"@admin")==false){
                header('location: logout.php');  
            }
           }
    ?>
	<title>New Account</title>

	<style type="text/css">

	</style>
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

                    <a class="nav-link" href="home.php">Home</a>
                </h3>
            </li>
        </ul>
    </div>
    </div>
</nav>

<div class="container shadow bg-light p-5">

	<div class="row">
<form class="form-group col-md-6" action="" method="post">
		
    <p class="h3 px-2 mb-0">@Create New Account </p>
	<hr class="mb-3 mt-0">	

	<label for="first_name"> First Name </label>
	<input type="text" name="first_name" class="form-control" id="first_name" placeholder="enter first_name" required>
	
	<label for="last_name"> Last Name </label>
	<input type="text" name="last_name" class="form-control" id="last_name" placeholder="enter last_name" required>

	<label for="username"> Username </label>
	<input type="text" name="username" class="form-control" id="username"  placeholder="enter username" required>

	<label for="password"> Password </label>
	<input type="password" name="password" class="form-control" id="password" placeholder="enter 8 digit password" maxlength="8" required>

	<label for="confirm_password"> Confirm Password </label>
	<input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="confirm password" maxlength="8" required>

	<center>
	<button type="submit" name="create_account" class="btn btn-primary my-3 col-sm-4 " >Submit</button>
    			
    </center>	

</form>
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
require("conn.php");
if(isset($_POST['create_account']))
{
$first_name=mysqli_real_escape_string($conn, $_POST["first_name"]);
$last_name=mysqli_real_escape_string($conn, $_POST["last_name"]);
$mobile_no=$_SESSION['mobile_no'];
$username=mysqli_real_escape_string($conn, $_POST["username"]);
$password=mysqli_real_escape_string($conn, $_POST["password"]);
$confirm_password=mysqli_real_escape_string($conn, $_POST["confirm_password"]);


//account validation

$sql= "select * from accounts where (mobile_no = $mobile_no) OR (username = '$username') LIMIT 1";

$result1= mysqli_query($conn, $sql); 
$acc_data= mysqli_fetch_all($result1);

// getting mobile number and username;

$acc= "";
$check_account= "";
$check_username= "";
foreach($acc_data as $acc)
{
    $check_account= $acc[3]; //getting mobile number
    // echo $check_account;
    $check_username= $acc[4]; //getting username
   // echo $check_username;    
}
//$check_username= "select * from accounts where username = $username LIMIT 1";

//$result2= mysqli_query($conn, $check_username);
//$user_data= mysqli_fetch_all($result2);

$errors = array();
if($check_account == $mobile_no){
    array_push($errors, "user account aleardy exist");
}
if($check_username == $username){
    array_push($errors, "username is exist");
}
if($password != $confirm_password){
    array_push($errors, "password does not match whith confirm password");
}
if(count($errors)){
    foreach($errors as $mesg){
        echo "<script> alert('";
            echo "$mesg";
            echo "')</script>";
        // echo "$mesg <br>";
    }
}else{
    // *** REgister User 
    $password = md5($password);
    $insert= "INSERT INTO accounts(first_name,last_name,mobile_no,username,password) VALUES('$first_name','$last_name',$mobile_no,'$username','$password')";

    if(mysqli_query($conn, $insert)){
    
            
             echo "<script> alert('Successfully Done.....');";
            echo "window.location='user.php'";
            echo "</script>";
            // session_destroy();
        }
    
}
}

?>