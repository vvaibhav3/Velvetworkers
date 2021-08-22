<!DOCTYPE html>
<html>

<head>
  <?php

  session_start();
  if (!isset($_SESSION['username'])) {
    header('location: index.html');
  }

  if (!isset($_SESSION['company'])) {
    header('location: material_challan.php');
  }
  require("conn.php");

  $username = $_SESSION['username'];
  $sales_order_no = $_SESSION['sales_order_no1'];
  $company_name = $_SESSION['company'];

  $query = "SELECT material FROM material_orders WHERE sales_order_no=$sales_order_no";
  $result = mysqli_query($conn, $query);
  $options = mysqli_fetch_all($result);

  if (isset($_POST['genrate'])) {

    // $challan_no=mysqli_real_escape_string($conn, $_POST['challan_no']);

    //$_SESSION['challan_no']=$challan_no;

    $date = mysqli_real_escape_string($conn, $_POST['date']);

    $material = mysqli_real_escape_string($conn, $_POST['material']);

    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

    $unit = mysqli_real_escape_string($conn, $_POST['unit']);

    $vehicle_no = mysqli_real_escape_string($conn, $_POST['vehicle_no']);

    $driver_name = mysqli_real_escape_string($conn, $_POST['driver_name']);

    $truck_reading = mysqli_real_escape_string($conn, $_POST['truck_reading']);

    $mobile_no = mysqli_real_escape_string($conn, $_POST["mobile_no"]);

    $payment_type = mysqli_real_escape_string($conn, $_POST["payment_type"]);

    /*$sql1="SELECT challan_no FROM material_challan1 WHERE challan_no=$challan_no LIMIT 1";
    
    $result1=mysqli_query($conn, $sql1);
    
    if(mysqli_num_rows($result1))
    {
            echo "<script> alert('";
            echo " Challan No Is Duplicate";
            echo "')</script>";
    }*/
    //   else{

    $query2 = "SELECT quantity,rate FROM material_orders WHERE sales_order_no=$sales_order_no AND material='$material' ";

    $result2 = mysqli_query($conn, $query2);
    $rate1 = mysqli_fetch_all($result2);

    $rate = 0;
    foreach ($rate1 as $r) {
      $rate = $r;
    }

    if ($rate == 0) {
      echo "<script> alert('Invalid Sales Order No. Failed Try Again.....');";
      echo "window.location='material_challan.php';";
      echo "</script>";
    }
    $material_order_qty = $rate[0];
    //substrating Quantity

    if ($material_order_qty > 0 && $material_order_qty >= $quantity) {

      $new_material_order_qty = $material_order_qty - $quantity;

      $update_material_quantity = "UPDATE material_orders SET quantity=$new_material_order_qty WHERE sales_order_no=$sales_order_no AND material='$material'";

      if (mysqli_query($conn, $update_material_quantity)) {

        $insert = "INSERT INTO material_challan1(company,cash_or_credit,sales_order_no,date,material,quantity,unit,rate,vehicle_no,driver_name,truck_reading,mobile_no,username) VALUES('$company_name','$payment_type',$sales_order_no,'$date','$material',$quantity,'$unit',$rate[1],'$vehicle_no','$driver_name',$truck_reading,$mobile_no,'$username')";

        if (mysqli_query($conn, $insert)) {
          unset($_SESSION['sales_order_no1']);
          unset($_SESSION['company']);
          mysqli_close($conn);
          echo "<script> alert('Successfully Done.....');";
          echo "window.location='material_challan.php'";
          echo "</script>";
        } else {
          $update_material_quantity = "UPDATE material_orders SET quantity=$material_order_qty WHERE sales_order_no=$sales_order_no AND material='$material'";
          mysqli_query($conn, $update_material_quantity);
          mysqli_close($conn);
          echo "<script> alert('Failed Try later.....');";
          echo "window.location='material_challan.php';";
          echo "</script>";
        }
      } else {
        echo "<script> alert('Failed....');";
        echo "window.location='material_challan.php';";
        echo "</script>";
      }
    } else {
      echo "<script> alert('Quantity is Less Failed....');";
      echo "window.location='material_challan.php';";
      echo "</script>";
    }
  }
  //   }
  // }else{
  //   header('location: material_challan.php');
  // }


  ?>

  <title>Proceed Material Challan</title>
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

    <p class="mb-0 text-right">
      <h2>Proceed Details</h2> Company - <?php echo $_SESSION['company']; ?>
    </p>
    <hr class="mb-3 mt-0">

    <form action="" method="post">
      <div class="form-row">

        <div class="form-group col-sm-4">
          <label for="selectMaterial">Material </label>
          <select name="material" class="form-control" id="selectMaterial">
            <?php
            $ct = 1;
            for ($i = 0; $i < $ct; $i++) {
              foreach ($options as $ops) {
                $d = $ops;
                $ct = count($ops);
                echo "<option> $d[$i]</option>";
              }
            }
            ?>

          </select>
        </div>

        <div class="form-group col-sm-4">
          <label for="inputQuantity">Quantity</label>
          <input type="number" step="any" name="quantity" class="form-control" id="inputQuantity" placeholder="Number">
        </div>

        <div class="form-group col-sm-4">
          <label for="inputUnit">Unit</label>
          <input type="text" name="unit" class="form-control" id="inputUnit" placeholder="Brass">
        </div>

        <div class="form-group col-sm-4">
          <label for="inputVehicleNo">Vehicle No</label>
          <input type="text" name="vehicle_no" class="form-control" id="inputVehicleNo" placeholder="MH 13 A7688" required>
        </div>

        <div class="form-group col-sm-4">
          <label for="inputDriverName">Driver Name</label>
          <input type="text" name="driver_name" class="form-control" id="inputDriverName" placeholder="Name" required>
        </div>
        <div class="form-group col-sm-4">
          <label for="inputTruckReading">Truck Reading</label>
          <input type="number" step="any" name="truck_reading" class="form-control" id="inputTruckReading" placeholder="Truck Reading">
        </div>

        <div class="form-group col-sm-4">
          <label for="inputDate">Date</label>
          <input type="date" name="date" class="form-control" id="inputDate">
        </div>

        <div class="form-group col-sm-4">
          <label for="inputMobileNo">Mobile No </label>
          <input type="tel" name="mobile_no" class="form-control" id="inputMobileNo" placeholder="8088****90" pattern="[1-9]{1}[0-9]{9}" required>
        </div>


        <div class="form-group col-sm-4">
          <label for="selectPaymentType">Payment type </label>
          <select name="payment_type" class="form-control" id="selectPaymentType">
              <option>Cash</option>
              <option>Credit</option>
          </select>
        </div>

        <div class="form-group col-sm-12 text-center">
          <button type="submit" class="btn btn-outline-primary col-sm-2" name="genrate"> Submit </button>
        </div>

      </div>
    </form>
  </div>


  <!-- include navbar -->
  <?php require("footer.php"); ?>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>