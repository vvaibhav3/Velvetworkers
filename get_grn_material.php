<!DOCTYPE html>
<html>
<head>
	<title>Get Material</title>

	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="./bg-style.css">
<?php

require("crusher.php");
require("conn.php");

// echo $_SESSION['grn_no'];
if(isset($_POST['add'])){

if(isset($_SESSION['grn_no'])){

// echo $_SESSION['grn_no'];
$grn_no=$_SESSION['grn_no'];
$username=$_SESSION['username'];

$material=mysqli_real_escape_string($conn, $_POST['material']);

// $check_duplicate_material="SELECT material FROM grn_material WHERE grn_no=$grn_no AND material='$material' LIMIT 1";

// $check_result=mysqli_query($conn,$check_duplicate_material);

// if(mysqli_num_rows($check_result)){
//   mysqli_close($conn);
//   echo "<script>alert('Material Is Already Added Failed...');window.location:'grn.php';</script>";
// }

$quantity=mysqli_real_escape_string($conn, $_POST['quantity']);

$unit=mysqli_real_escape_string($conn, $_POST['unit']);

// $rate=mysqli_real_escape_string($conn, $_POST['rate']);

$insert2="INSERT INTO grn_material(grn_no,material,quantity,unit,total_qty,username) VALUES($grn_no,'$material',$quantity,'$unit',$quantity,'$username')";

if(mysqli_query($conn, $insert2)){

  echo "<div class='alert alert-success'>
  <div class='container'>Successfully Added You Can Add More...<br></div></div>";
// echo "<script> alert('";
// echo " Order Added You Can Add More";
// echo "')</script>";
}else{
  mysqli_close($conn);
echo "<script>alert('failed...');window.location:'sales_order.php';</script>";
}

}else{
echo "<script>alert('Sales Order Not Found..');
window.location='sales_order.php';</script>";
}
}

?>
</head>
<body style="background-color: #E8DAEF">

<!-- include navbar -->
<?php require("navbar.php"); ?>


<div class="container shadow p-5 mb-4 bg-light">
	<div class="h1 text-center">Add Material</div>
	<hr class="mt-0 mb-4">

	<form action="" method="post">
		<div class="form-row">

        <div class="form-group col-sm-4">
          <label for="inputMaterial">Material</label>
          <input type="text" name="material" class="form-control" id="inputMaterial" placeholder="material" required>
        </div>
	  	
	  	<div class="form-group col-sm-4">
	  		<label for="inputQuantity">Quantity</label>
            <input type="number" name="quantity" class="form-control"
            id="inputQuantity" placeholder="Number">
        </div>

	  	<div class="form-group col-sm-4">
	  		<label for="inputUnit">Unit</label>
	  		<input type="text" name="unit" class="form-control" id="inputUnit" placeholder="Brass">
        </div>

      <!-- <div class="form-group col-sm-4">
        <label for="inputRate">Rate</label>
            <input type="number" name="rate" class="form-control"
            id="inputRate" placeholder="Number">
        </div> -->
	    
        <!-- <div class="form-group col-sm-4">
            <label for="inputRate">Rate</label>
            <input type="text" name="rate" class="form-control" id="inputUnit" placeholder="Brass">
        </div> -->

        <div class="form-group col-sm-12 text-center">
	  		<button type="submit" class="btn btn-outline-primary col-sm-2" name="add">Add</button>
        
        </div>

	 </div>
    
	</form>

  <!-- For Finishing Order -->
  <center>
  <form action="" method="post" class="form-row col-sm-3">
    
  <button class="btn btn-outline-danger my-2 form-control" name="done" type="submit">Done</button>

  </form>
    </center>

  <?php

    if(isset($_POST['done'])){
      unset($_SESSION['grn_no']);      
      echo "<script>alert('Successfully Done...'); window.location='grn.php';</script>";

    }
    // mysqli_close($conn);

  ?>
</div>

<!-- include footer -->
<?php require("footer.php"); ?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>