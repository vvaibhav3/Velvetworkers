<!DOCTYPE html>
<html>
<head>

	<style type="text/css">
		address{
			text-transform: capitalize;
			font-size: 18px;
		}

		.details{
			text-transform: capitalize;
			font-size: 18px;
		}

		.setborder table tbody tr td{
			border:2px solid black;
		}
		
		.setborder table thead th{
			border: 2px solid black;
		}

		@page {
                size: 7in 9.25in;
                margin: 5mm 1mm 5mm;
        }
	</style>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 
<title>Matrial Challan Print</title>
</head>
<body>

<?php
require("crusher_print.php");
// $sales_order_no=$_SESSION['sales_order_no'];
// echo $sales_order_no;

if(isset($_SESSION['challan_no'])){
$challan_no=$_SESSION['challan_no'];
require("../conn.php");

$sql="SELECT company,challan_no,sales_order_no,date,material,quantity,unit,vehicle_no,driver_name,truck_reading,mobile_no FROM material_challan1 WHERE challan_no=$challan_no";

			$result=mysqli_query($conn,$sql);
            $data=mysqli_fetch_all($result);

            foreach ($data as $d) {
            	// print_r($d);
                  $company=$d[0];
                  $challan_no=$d[1];
                  $sales_order_no=$d[2];
                  $date=$d[3];
                  $material=$d[4];
                $quantity=$d[5];
                $unit=$d[6];
                $vehicle_no=$d[7];
                $driver_name=$d[8];
                $truck_reading=$d[9];
                $mobile_no=$d[10];
                // echo $company;
              }

$sql2="SELECT address,city FROM sales_order1 WHERE sales_order_no=$sales_order_no";

			$result2=mysqli_query($conn,$sql2);
            $data2=mysqli_fetch_all($result2);

            foreach ($data2 as $d2) {
            	$address=$d2[0];
            	$city=$d2[1];
            }

$sql3="SELECT material,quantity,unit FROM material_challan1 WHERE challan_no=$challan_no";

$result3=mysqli_query($conn,$sql3);
$data3=mysqli_fetch_all($result3);

foreach ($data3 as $d3) {
            	$material=$d3[0];
            	$quantity=$d3[1];
            	$unit=$d3[2];
            }

        //your company name
	echo "<div class='container my-4 p-5' style='border:1px solid black;'>";
	echo "<header><center><h3>SAMARTH CONSTRUCTION COMPANY</h3></center></header><hr style='border: 0.5px solid black;'>";

		// your company address
	echo "<address class='ml-2'>office-address- office no 4- first floor , jamadar tower , opp. killa baag 138 , murarji peth , solapur .<br>
		tel no. 0217-27455555 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  mobile no. 9921555533<br>
		email abhaystoneindustries@gmail.com</address><hr>";

		// crusher address
	echo "<address class='ml-2'>Site Address - survey no 450 , kashegaon , near manchikonda pole factory , solapur -tuljapur road , kashegaon, tal. - solapur , dist. - solapur (maharashtra) .</address><hr>";

		//sales order details
	echo "<center><h3>Delivery Challan</h3></center><hr style='border: 0.5px solid black;'>";

	echo "<div class='details'>";

	
	echo "<address class='ml-4 mb-1'>challan no - $challan_no &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; date - $date</address>
	<address class='ml-4 mb-1'>company- $company</address>
	<address class='ml-4 mb-1'>site address - $address , $city .</address>
	<address class='ml-4'>Mobile No - $mobile_no</address>";
    // echo "<table class='table overflow-auto text-left mb-0 mt-0' style='border-top:2px solid black;'>
    //     <tbody>
        
    //     <tr>	
	// 			<td scope='col'>challan no. - $challan_no</td>
	// 			<td scope='col'>date - $date</td>
    //             <td></td>
    //             <td></td>
    //     </tr>
        
    //     </tbody></table>";

    //     echo "<table class='table overflow-auto text-left mt-0' >
    //     <tbody>
        
    //     <tr>	<td scope='col'>company- $company</td></tr>
    //     <tr>	<td scope='col'>site address - $address , $city .</td></tr><tbody></table>
	// 	";
		

	//echo "<address class='ml-3'><h6>site address - $address , $city </h6></address><br>";
	/*echo "challan no. - $challan_no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	date - $date<br>";

	echo "company - $company<br> site address - $address , $city<hr>";

	echo "vehicle no. - $vehicle_no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	driver name -  $driver_name &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	truck reading - $truck_reading<br><hr>";

	echo "material - $material &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	qauntity - $quantity &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	unit - $unit<hr><br><br>";*/


echo"<div class='setborder'><table class='table m-2 p-2 overflow-auto text-center'>
<thead>
<tr>
    <th scope='col'>Material</th>
    <th scope='col'>Quantity</th>
    <th scope='col'>Unit</th>
</tr>
</thead>
<tbody>";

echo "<tr>	
      <td scope='col'>$material</td>
      <td scope='col'>$quantity</td>
      <td scope='col'>$unit</td>";

echo "</tbody></table></div><br>";  

echo "<div class='details mt-0'>";

	echo "<table class='table overflow-auto text-left mt-0' style='border-top:2px solid black;'>
	<tbody>
	<tr>					
			<td scope='col'>vehicle no. - $vehicle_no</td>
			<td scope='col'>mobile no - $mobile_no</td>
			<td scope='col'>truck reading - $truck_reading</td>
	</tr></tbody></table><br><br><br>";

	echo "<div class='signs text-left'>";
	echo "reciever signature";
	echo "</div>";

	echo "<div class='signs text-right'>";
	echo "authorised signature";
	echo "</div>";

	echo "</div>";

	 echo "<center><button class='btn btn-outline-primary my-4 d-print-none' onclick='print_page()'> Print </buttton></center>";

	echo "</div>";

}else{
    echo "<script>alert('Data Not Found..');
    window.location='../home.php';</script>";
}
?>



<script type="text/javascript">
function print_page(){
window.print();
}
</script>

</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>