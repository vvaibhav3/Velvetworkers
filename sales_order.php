<!DOCTYPE html>
<html>
<head>
<title> Sales Order</title>
    <?php
require("crusher.php");
	  
require("conn.php");

			$sql_get_no="SELECT sales_order_no FROM sr_no"; 
			$get_result=mysqli_query($conn,$sql_get_no);

			$s_no=mysqli_fetch_all($get_result);

			foreach($s_no as $sn){
				$sdata=$sn[0];
			}
			//echo "<script>alert('$sdata');</script>";
			//mysqli_close($conn);
		?>
 	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	 <link rel="stylesheet" href="./bg-style.css">
	   
</head>
<body >   
  
<?php 
      //include navbar  -->
      require("navbar.php");
?>
<!-- <div class="alert alert-danger"> 
    <div class="container">
   Note - Terms And Conditions By Defualt Accepted.<br>

    </div>
</div> -->



<div class="container shadow p-5 mb-4 bg-light">
	<!-- <div class="h1 text-left ml-2">Sales Order</div> -->
	<!-- <hr class=""> -->

	<form action="check_sales_order.php" method="post">
	<p class="h2 mb-0 ml-3">Sales Order</p>
        <hr class="mb-3 mt-0">
		<div class="form-row">

    	<div class="form-group col-sm-4">
		<label for="selectCompany">Company Name </label>
            <select name="company" class="form-control" id="selectCompany" required>
          
		    <?php
		        
		    
		        $query="SELECT company FROM party_details";
		        
		        $result= mysqli_query($conn, $query);
		        $options= mysqli_fetch_all($result);

		          // $ct=count($options);
                $ct=1;
		            for($i=0;$i<$ct;$i++)
		            {   
		                foreach($options as $ops)
		                {
		                    $d=$ops;
                            $ct=count($ops);
		                    echo "<option> $d[$i]</option>";
		                }
		            }   
					mysqli_close($conn);
				?>  
				
    		</select>
    	</div>
    	<!-- <div class="form-group col-sm-4">
    		<label for="inputCustomer">customer name </label>
            <input type="text" name="customer" class="form-control"
            id="inputCustomer" placeholder="Name" required>
	  </div> -->
	  
<!-- 	  
			<div class="form-group col-sm-4">
				<label for="inputSales_order_no">Sales Order No </label>
				<input type="number" name="sales_order_no" class="form-control" id="inputSales_order_no" 
				value='<?php //echo"$sdata";?>' disabled>
			</div> -->
      
		<div class="form-group col-sm-4">
	    <label for="inputSiteName">Site Name</label>
	    <input type="text" name="site_name" class="form-control" id="inputSiteName" placeholder="Solapur,Mohol,..etc" required>
	  	</div>

	  	<div class="form-group col-sm-3">
	    <label for="inputDate">Date</label>
	    <input type="date" name="date" class="form-control" id="inputDate" required>
	  	</div>




    	<div class="form-group col-sm-8">
	    <label for="inputAddress">Address</label>
	    <input type="text" name="address" class="form-control" id="inputAddress" placeholder="1234 Main Biulding " required>
	  	</div>

	  	<div class="form-group col-sm-3">
	    <label for="inputCity">City</label>
	    <input type="text" name="city" class="form-control" id="inputCity" placeholder="city" required>
	  	</div>

	    <div class="form-group col-sm-8">
	  		<label for="inputPayment_terms">Payment Terms</label>
	  		<input type="text" name="payment_terms" class="form-control" id="inputPayment_terms" placeholder="Your Payment Terms">
        </div>

        <div class="form-group col-sm-3">
        <label for="inputT&C">&nbsp;</label>
        	<a class="btn btn-outline-danger form-control mmx-2" href='terms.php' id="inputT&C" role='button'>View T&C</a>
        </div>

        <div class="form-group col-sm-12 text-center">
	  		<button type="submit" class="btn btn-outline-primary col-sm-2 my-3" name="submit">Submit</button>
        </div>

	 </div>
    
	</form>
</div>

<center>
<iframe src="display_sales_orders.php" class="shadow" width="100%" height="400" frameBorder="0"></iframe>
</center>

<!-- include footer -->
<?php require("footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>