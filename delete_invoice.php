<!DOCTYPE html>
<html>

<head>
  <?php


  require("highLevel.php");
  ?>
  <title>Delete Invoice</title>
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
      <p class="h2 mb-0">Delete Invoice</p>
      <hr class="mb-3 mt-0">
      <label for="inputSales_order_no">Enter Invoice No</label>
      <input type="number" name="invoice_no" class="form-control" id="inputSales_order_no" placeholder="Enter Invoice No" required>
      <button type="submit" name="delete" class="btn btn-danger my-3">Delete Order</button>
      <!-- <hr class="my-4"> -->
    </form>

  </div>

  <!-- FOR DELETING ORDER -->
  <?php
  require("conn.php");
  if (isset($_POST['delete'])) {
    $username = $_SESSION['username'];

    $invoice_no = mysqli_real_escape_string($conn, $_POST['invoice_no']);

    $sql1 = "SELECT invoice_no,sales_order_no,networth,sgst,cgst,total FROM invoice_amounts WHERE invoice_no=$invoice_no LIMIT 1";

    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1)) {
      date_default_timezone_set('Asia/Kolkata');
      $date = date("Y-m-d");
      $time = date("H:i:s");

      $data3 = mysqli_fetch_all($result1);

      foreach ($data3 as $d) {
        $array = $d;
      }

      //for sales order
      $insert1 = "INSERT INTO deleted_invoice(invoice_no,sales_order_no,networth,sgst,cgst,total,deleted_time,deleted_date,username) VALUES($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],'$time','$date','$username')";

      if (mysqli_query($conn, $insert1)) {
        $delete_query = "DELETE FROM invoice_amounts WHERE invoice_no=$invoice_no";

        if (mysqli_query($conn, $delete_query)) {
          $change_challan_status = "UPDATE material_challan1 SET status=0 WHERE status=$invoice_no";
          mysqli_query($conn, $change_challan_status);

          $delete_invoice_each="DELETE FROM invoice_each WHERE invoice_no=$invoice_no";
          mysqli_query($conn, $delete_invoice_each);

          mysqli_close($conn);
          echo "<script> alert('";
          echo " Invoice Deleted...";
          echo "')</script>";
        } else {
          mysqli_close($conn);
          echo "<script> alert('";
          echo " Failed...";
          echo "');window.location:'delete_invoice.php';</script>";
        }
      } else {
        mysqli_close($conn);
        echo "<script> alert('";
        echo "Invoice No. Not Found .......";
        echo "Please Enter Correct Sales Order No...";
        echo "')window.location:'delete_invoice.php';</script>";
      }
    }
  }

  ?>
  <center>
    <div class="alert alert-danger shadow col-sm-9">
      <div class="container">
        Warning! Enter Correct Invoice No.
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