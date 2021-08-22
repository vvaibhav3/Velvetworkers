<!DOCTYPE html>
<html>
<head>
    <?php

     require("office.php");
    ?>
  <title>Invoice</title>
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

  <form class="form-group" action="" method="post">
      <p class="h2 mb-0 ml-3">Invoice</p>
        <hr class="mb-3 mt-0">
        <div class='form-row'>
          <div class="form-group col-sm-4">
            <label for="inputSales_order_no">Enter Sales Order No</label>
            <input type="number" name="sales_order_no" class="form-control" id="inputSales_order_no" placeholder="Enter Sales Order No" required>
        </div>
<!-- 
        <div class="form-group col-sm-4">
            <label for="inputInvoiceNo">Invoice No</label>
            <input type="number" name="invoice_no" class="form-control" id="inputInvoiceNo" placeholder="Enter Invoice No" required>
        </div> -->

       </div>
      <button type="submit" name="submit1" class="btn btn-success my-1" onclick="return show_confirm()">Submit</button>
      
  </form>

</div>

<script type="text/javascript">
  
  function show_confirm(){
    return confirm("Are You Sure Sales Order No Is Correct..?");
  }
</script>

<?php


require("conn.php");


if(isset($_POST['submit1'])){

  $sales_order_no=mysqli_real_escape_string($conn, $_POST['sales_order_no']);

  //$invoice_no=mysqli_real_escape_string($conn, $_POST['invoice_no']);

  $_SESSION['sales_order_no2']=$sales_order_no;

 // $_SESSION['invoice_no']=$invoice_no;

  $sql="SELECT challan_no FROM material_challan1 WHERE sales_order_no=$sales_order_no AND status=0";

  $result=mysqli_query($conn, $sql);

  $data=mysqli_fetch_all($result);

  if(mysqli_num_rows($result)){

    // $sql3="SELECT * FROM material_challan1 WHERE sales_order_no=$sales_order_no";
    // $result3=mysqli_query($conn,$sql3);
    // $data3=mysqli_fetch_all($result3);
echo "<hr><form action='process_invoice.php' method='post' >";
echo "<table class='table table-bordered m-2 p-2 overflow-auto shadow bg-light'>
        <thead class='thead-dark'>
        <tr>
            <th scope='col'>Select</th>
            <th scope='col'>Company</th>
            <th scope='col'>Challan No</th>
            <th scope='col'>Sales_Order_No</th>
            <th scope='col'>Date</th>
            <th scope='col'>Material</th>
            <th scope='col'>Quantity</th>
            <th scope='col'>Unit</th>
            <th scope='col'>Rate</th>
            <th scope='col'>Vehicle No</th>
            <th scope='col'>Driver Name</th>
            <th scope='col'>Truck Reading</th>
            <th scope='col'>Mobile No</th>
        </tr>
        </thead>
        <tbody class='overflow-auto'>";
      $ct=1;
        for($i=0;$i<$ct;$i++)
        {   
            foreach($data as $d1)
             {
                $d=$d1;//id
                $ct=count($d);
                echo "<tr>";
                echo "<td>";
                echo "<input type='checkbox' name='challan_list[]' value='$d[$i]'>";
                echo "</td>";
                 $sql3="SELECT company,challan_no,sales_order_no,date,material,quantity,unit,rate,vehicle_no,driver_name,truck_reading,mobile_no FROM material_challan1 WHERE challan_no=$d[$i]";
                $result3=mysqli_query($conn,$sql3);
                $data3=mysqli_fetch_all($result3);
                // print_r($data3);
                foreach ($data3 as $d3) {
                  $array=$d3;
                    foreach($array as $p){
                        $print_data=$p;
                        
                        echo "<td>";
                        echo "$print_data";
                        echo "</td>";
                    }
                    echo "<br></tr>";
                }
               
            }
            

        } 
        echo "</table>";
        echo "<center><button type='submit' name='get_challan_list' class='btn btn-warning my-3'>Confirm</button></center></form>";
        // print_r($data3);

  }else{
    echo "<script>alert('No Data Found')</script>";
  }


}

mysqli_close($conn);

?>
<br>
<center>
<iframe src="display_invoice.php" class="shadow" width="100%" height="400" frameBorder="0"></iframe>
</center>

<!-- include footer -->
<?php require("footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
