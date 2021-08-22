<?php

if(isset($_POST['submit'])){

    session_start();
    require("conn.php");

      $sales_order_no=mysqli_real_escape_string($conn, $_POST['sales_order_no']);

      $_SESSION['sales_order_no1']=$sales_order_no;

      $sql1="SELECT company,sales_order_no FROM material_orders WHERE sales_order_no=$sales_order_no LIMIT 1";
    
      $result1=mysqli_query($conn, $sql1);
    
        if(mysqli_num_rows($result1)){

          $data1=mysqli_fetch_all($result1);

          foreach ($data1 as $d) {
              $array=$d;
          }

           $_SESSION['company']=$array[0];
        
           header('location: proceed_material_challan.php');

          }else{

      	     echo "<script>";
            echo "alert('Please enter correct sales order no..');";
            echo "window.location='material_challan.php'";
            echo "</script>";
            
      }   


}



?>