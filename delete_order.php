<!DOCTYPE html>
<html>
<head>
    <?php

require("highLevel.php");
    ?>
  <title>Delete Order</title>
  <style type="text/css">
    
  </style>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

     <link rel="stylesheet" href="./bg-style.css">
</head>
<body> 


<!-- include navbar -->
<?php require("navbar.php"); ?>

<div class="container shadow p-5 mb-4 bg-light">

  <form class="form-group col-md-6" action="" method="post">
      <p class="h2 mb-0">Delete Order</p>
        <hr class="mb-3 mt-0">
      <label for="inputSales_order_no">Enter Sales Order No</label>
      <input type="number" name="sales_order_no" class="form-control" id="inputSales_order_no" placeholder="Enter Sales Order No" required>
      <button type="submit" name="delete" class="btn btn-danger my-3">Delete Order</button>
        <!-- <hr class="my-4"> -->
  </form>

</div>
  
   <!-- FOR DELETING ORDER -->
<?php
require("conn.php");

    if(isset($_POST['delete']))
    {
      $username=$_SESSION['username'];

      $sales_order_no=mysqli_real_escape_string($conn, $_POST['sales_order_no']);

      $material_challan_check="SELECT sales_order_no FROM material_challan1 WHERE sales_order_no=$sales_order_no LIMIT 1";

      $challan_result=mysqli_query($conn,$material_challan_check);

      if(mysqli_num_rows($challan_result)){
        echo "<script>alert('Material Challan Is  Available With This Sales Order No.');</script>";
      }
      else{
      $sql1="SELECT sales_order_no,username FROM sales_order1 WHERE sales_order_no=$sales_order_no LIMIT 1";
    
      $result1=mysqli_query($conn, $sql1);
    
        if(mysqli_num_rows($result1))
        { 
          date_default_timezone_set('Asia/Kolkata');
          $date=date("Y-m-d");
          $time=date("H:i:s");

          $sql3="SELECT * FROM sales_order1 WHERE sales_order_no=$sales_order_no";
           $result3=mysqli_query($conn,$sql3);
          $data3=mysqli_fetch_all($result3);

          foreach($data3 as $d)
                {
                    $array=$d;
                }
         
                //for sales order
          $insert1="INSERT INTO deleted_sales_order(company,sales_order_no,address,city,site_name,date,payment_terms,username,deleted_time,deleted_date) VALUES('$array[0]',$array[1],'$array[2]','$array[3]','$array[4]','$array[5]','$array[6]','$array[7]','$time','$date')";

          if(mysqli_query($conn, $insert1)){
          $insert2="INSERT INTO deleted_material_order(sales_order_no,material,quantity,unit,username) SELECT sales_order_no,material,quantity,unit,username FROM material_orders WHERE sales_order_no=$sales_order_no";

          if(mysqli_query($conn, $insert2)){

          $delete_query="DELETE FROM sales_order1 WHERE sales_order_no=$sales_order_no";
          
           if(mysqli_query($conn, $delete_query)){
             $delete_query="DELETE FROM material_orders WHERE sales_order_no=$sales_order_no";
              mysqli_query($conn,$delete_query);
            echo "<script> alert('";
            echo " Order Deleted...";
            echo "')</script>";
           }
           else{
            echo "<script> alert('";
            echo " Failed...";
            echo "');</script>";
           }
          }
        }
      }
          else{
            echo "<script> alert('";
            echo "Sales Order Not Found .......";
            echo "Please Enter Correct Sales Order No...";
            echo "')</script>";
          }
        }

    }

    mysqli_close($conn);

?>
<center>
<div class="alert alert-danger shadow col-sm-9" >
    <div class="container">
      (Don't Try To Delete Sales Orders If You Have Created Material Challan On that Sales Order).<br>
    Warning! Enter Correct Sales Order No.
    </div>
</div>
</center>
<!-- include footer -->
<?php require("footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>