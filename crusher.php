<?php

session_start();
if(!isset($_SESSION['username']) ){
    header('location: logout.php');   
}
else{
    if(strpos($_SESSION['username'],"@crusher")==false && strpos($_SESSION['username'],"@admin")==false && strpos($_SESSION['username'],"@office")==false){
        header('location: home.php');  
    }
}
?>