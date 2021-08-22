<!DOCTYPE html>
<html>

<head>
  <?php


  require("highLevel.php");
  ?>
  <title>Delete Challan</title>
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
      <p class="h2 mb-0">Delete Challan</p>
      <hr class="mb-3 mt-0">
      <label for="inputChallan_no">Enter Challan No</label>
      <input type="number" name="challan_no" class="form-control" id="inputChallan_no" placeholder="Enter Challan No" required>
      <button type="submit" name="delete" class="btn btn-danger my-3" onclick="return show_confirm()">Delete Challan</button>
      <!-- <hr class="my-4"> -->
    </form>

  </div>

  <script type="text/javascript">
    function show_confirm() {
      return confirm("Are You Challan No Is Correct..? \n" + document.getElementById("inputChallan_no").value);
    }
  </script>
  <!-- FOR DELETING ORDER -->
  <?php
  require("conn.php");
  if (isset($_POST['delete'])) {
    $username = $_SESSION['username'];

    $challan_no = mysqli_real_escape_string($conn, $_POST['challan_no']);

    $sql1 = "SELECT * FROM material_challan1 WHERE challan_no=$challan_no LIMIT 1";

    $result1 = mysqli_query($conn, $sql1);

    if (mysqli_num_rows($result1)) {

      date_default_timezone_set('Asia/Kolkata');
      $date = date("Y-m-d");
      $time = date("H:i:s");

      $data3 = mysqli_fetch_all($result1);

      foreach ($data3 as $d) {
        $array = $d;
      }

      $insert = "INSERT INTO user_deleted_challans(company,challan_no,cash_or_credit,sales_order_no,date,material,quantity,unit,rate,vehicle_no,driver_name,truck_reading,mobile_no,username,deleted_time,deleted_date) VALUES('$array[0]',$array[1],'$array[2]',$array[3],'$array[4]','$array[5]',$array[6],'$array[7]',$array[8],'$array[9]','$array[10]',$array[11],$array[12],'$username','$time','$date')";

      if (mysqli_query($conn, $insert)) {

        $delete_query = "DELETE FROM material_challan1 WHERE challan_no=$challan_no";

        if (mysqli_query($conn, $delete_query)) {

          echo "<script> alert('";
          echo " challan Deleted...";
          echo "')</script>";
        } else {
          echo "<script> alert('";
          echo " Failed...";
          echo "');</script>";
        }
      }
    } else {
      echo "<script> alert('";
      echo "Challan Not Found .......";
      echo "Please Enter Correct Challan No...";
      echo "')</script>";
    }
  }

  mysqli_close($conn);

  ?>

  <center>
    <div class="alert alert-danger shadow col-sm-9">
      <div class="container">
        Warning! Enter Correct Challan No.
      </div>
    </div>
  </center>
  <br><br>
  <!-- include footer -->
  <?php require("footer.php"); ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>