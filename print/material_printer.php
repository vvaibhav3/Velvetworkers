<!DOCTYPE html>
<html>

<head>
  <?php

  require("crusher_print.php");
  ?>
  <title>Material Challan Prints</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="../bg-style.css">

</head>

<body>


  <!-- include navbar -->
  <?php require("pnavbar.php"); ?>

  <div class="container shadow py-5">

    <form class="form-group col-md-5" action="" method="post">
      <p class="h2 mb-0">Material Challan Printer</p>
      <hr class="mb-3 mt-0">
      <label for="inputChallanNo">Enter Challan No</label>
      <input type="number" name="challan_no" class="form-control" id="inputChallanNo" placeholder="Enter Challan No" required>
      <button type="submit" name="submit" class="btn btn-success my-3">Submit</button>
      <!-- <hr class="my-4"> -->
    </form>

  </div>

  <?php

  if (isset($_POST['submit'])) {
    require("../conn.php");

    $challan_no = $_POST['challan_no'];

    $sql = "SELECT * FROM material_challan1 WHERE challan_no=$challan_no";

    $results = mysqli_query($conn, $sql);

    if (mysqli_num_rows($results)) {

      $_SESSION['challan_no'] = $challan_no;

      mysqli_close($conn);
      echo "<script>window.location='material_challan_print.php';</script>";
      // header('location: material_challan_print.php');
    } else {
      echo "<script>alert('Not Found..');</script>";
    }
    mysqli_close($conn);
  }



  ?>

  <br><br>

  <!-- include footer -->
  <?php require("pfooter.php"); ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>