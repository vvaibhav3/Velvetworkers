<?php

require("conn.php");

$username=mysqli_real_escape_string($conn, $_POST["username"]);
$password=mysqli_real_escape_string($conn, $_POST["password"]);

$password= md5($password);

$sql= "SELECT username,password FROM accounts WHERE username= '$username' AND password= '$password' LIMIT 1";

//echo "username is $username and password is $password";

$result= mysqli_query($conn, $sql);

if(mysqli_num_rows($result)){
    session_start();
    $_SESSION['username']= $username;

    mysqli_close($conn);
    header('location: home.php');
}else{
		mysqli_close($conn);
	echo "<script>alert('Log In Failed...Please Enter Correct Data');
	window.location='index.html';</script>";
}

//$data= mysqli_fetch_all($result);
//
//foreach($data as $check_data){
//    $check_user= $check_data[0];
//    $check_pwd= $check_data[1];
//}


?>