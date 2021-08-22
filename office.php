<?php

session_start();
if(!isset($_SESSION['username']) ){
    header('location: logout.php');   
}
else{
    if(strpos($_SESSION['username'],"@office")==false && strpos($_SESSION['username'],"@admin")==false){
        header('location: home.php');  
    }
}
?>