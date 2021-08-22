<!DOCTYPE html>
<html>
<head>
<title> Master</title>
    <?php
    require("crusher.php");
    ?>
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="./bg-style.css">
</head>
<body>   
  
<?php 
      //include navbar  -->
      require("navbar.php");
?>

<div class="container shadow p-5 mb-4 bg-light">

  <div class="row">
<form class="form-group col-md-4" action="" method="post">
    
    <p class="h3 px-2 mb-0">Add Party </p>
  <hr class="mb-3 mt-0">

  <label for="inputCompany">Company Name</label>
  <input type="text" name="company_name" class="form-control" id="Company"  placeholder="Company Name" required>

  <label for="inputAddress">Address</label>
  <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main Biulding " required>

  <label for="inputCity">City</label>
  <input type="text" name="city" class="form-control" id="inputCity" placeholder="city" required>

  <label for="inputMobile_no">Mobile No</label>
  <input type="tel" name="mobile_no" class="form-control" id="mob_no" placeholder="8088****90" pattern="[1-9]{1}[0-9]{9}" required>

  <label for="inputGST">GST No</label>
  <input type="text" name="gst_no" class="form-control" id="inputGST" placeholder="1234C65C">

  <center>
  <button type="submit" name="add_party" class="btn btn-primary my-3 col-sm-4 "> Add </button>
          
    </center> 

</form>

  <form class="form-group col-md-4" action="" method="post">

        <p class="h3 px-2 mb-0">Add Material</p>
        <hr class="mb-3 mt-0">
        <!-- <div class="form-group"> -->
          <label for="inputMaterial">Material </label> 
          <input type="text" name="material" class="form-control" id="inputMaterial" placeholder="Material" required>

          <label for="inputUnit">Unit</label> 
          <input type="text" name="unit" class="form-control" id="inputUnit" placeholder="Unit" required>

          <center>
          <button type="submit" name="add_material" class="btn btn-primary my-3 col-sm-4">Add</button>
          </center>

        <!-- </div> -->
      </form>
    </div>
</div>

<?php

require("conn.php");

if(isset($_POST['add_party']))
{
    $company_name=mysqli_real_escape_string($conn, $_POST['company_name']);
    
    $address=mysqli_real_escape_string($conn, $_POST['address']);

    $city=mysqli_real_escape_string($conn, $_POST['city']);
    
    $mobile_no=mysqli_real_escape_string($conn, $_POST['mobile_no']);

    $gst_no=mysqli_real_escape_string($conn, $_POST['gst_no']);
    
    $sql="SELECT company FROM party_details WHERE company= '$company_name' LIMIT 1";
    
    $result= mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result)){
        
            echo "<script> alert('";
            echo " Already Available";
            echo "')</script>";
            mysqli_close($conn);
    }else{
        $company_name=strtoupper($company_name);
        $data= "INSERT INTO party_details(company,address,city,mobile_no,gst_no) VALUES('$company_name','$address', '$city',$mobile_no, '$gst_no')";
        
        if(mysqli_query($conn, $data)){                 
          echo "<script> alert('";
          echo " Company Added";
          echo "')</script>";
          mysqli_close($conn);          
        }
        else{
                  
          echo "<script> alert('";
          echo " Connection failed..";
          echo "')</script>";
          mysqli_close($conn);
        }

    }
    
}
    
    
?>
<?php

if(isset($_POST['add_material']))
{
    $material=mysqli_real_escape_string($conn, $_POST['material']);
    
    $unit=mysqli_real_escape_string($conn, $_POST['unit']);
    
    $sql="SELECT material FROM material_details WHERE material= '$material' LIMIT 1";
    
    $result= mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result)){ 
            echo "<script> alert('";
            echo " Already Available";
            echo "')</script>";
            mysqli_close($conn);
    }else{
        
        $data= "INSERT INTO material_details(material,unit) VALUES('$material','$unit')";
        
        mysqli_query($conn, $data);
        
            echo "<script> alert('";
            echo " material Added";
            echo "')</script>";
            mysqli_close($conn);
    }
    
}
?>


<center>

<iframe src="display_master_company.php" class="shadow" width="75%" height="300" frameBorder="0"></iframe>


<iframe src="display_master_material.php" class="shadow" width="75%" height="300" frameBorder="0"></iframe>
</center>
<!-- include footer -->
<?php require("footer.php"); ?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>