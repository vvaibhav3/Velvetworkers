<!DOCTYPE html>
<html>
<head>
	<style type="text/css">
		address{
			text-transform: capitalize;
		}

		.details{
			text-transform: capitalize;
			font-size: 18px;
		}

		.details table{
			text-align: left;
		}

		table{
			font-size: 19px;
		}

		.setborder table tbody tr td{
			border:2px solid black;
		}
		
		.setborder table thead th{
			border: 2px solid black;
		}
		@page {
                size: 5.8in 8.3in;
                margin: 5mm 1mm 5mm;
        }
		
	</style>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 

	<title class="d-print-none">GRN Print</title>
</head>
<body>

<?php

require("crusher_print.php");
// $sales_order_no=$_SESSION['sales_order_no'];
// echo $sales_order_no;

if(isset($_SESSION['grn_no'])){
$grn_no=$_SESSION['grn_no'];
require("../conn.php");

$sql="SELECT grn_no,grn_date,supplier_challan_no,sch_date,supplier_bill_no,sb_date,supplier_name,supplier_address FROM good_reciept_note WHERE grn_no=$grn_no";

			$result=mysqli_query($conn,$sql);
            $data=mysqli_fetch_all($result);

            $grn_no=0;

            foreach ($data as $d) {
            	// print_r($d);
                  $grn_no=$d[0];
                  $grn_date=$d[1];
                  $supplier_challan_no=$d[2];
                  $sch_date=$d[3];
                  $supplier_bill_no=$d[4];
                  $sb_date=$d[5];
                  $supplier_name=$d[6];
                  $supplier_address=$d[7];
                // echo $company;
              }

              if($grn_no==0){
                echo "<script> alert('Invalid GRN No. Failed Try Again.....');";
                echo "window.location='grn_printer.php';";
                echo "</script>";
              }

	echo "<div class='container my-4 p-5' style='border:1px solid black;'>";
	// 	//GRN details
	echo "<center><h3>Good Reciept Note</h3></center><hr style='border: 0.3px solid black;'>";

	echo "<div class='details'>";

	echo "<table class='table overflow-auto' border='0'>
        <tbody>
		<tr>	<td scope='col'>Supplier Name - $supplier_name</td>
		</tr>
		<tr>
				<td scope='col'>Site Address - $supplier_address </td>
		</tr>

		</tbody></table>";
		
		echo "<table class='table overflow-auto col-md-8'>
		<tbody>
		<tr>
				<td scope='col'>GRN No. - $grn_no</td>
				<td scope='col'>date - $grn_date</td>
		</tr>
		<tr>
				<td scope='col'>Supplier Challan No - $supplier_challan_no </td>
				<td scope='col'>date - $sch_date</td>
		</tr>
		<tr>
			<td scope='col'>Supplier Bill No - $supplier_bill_no </td>
			<td scope='col'>date - $sb_date</td>
		</td>
		</tr></tbody></table><hr>";

		
	/*echo "Supplier Name. - $supplier_name <br>";

	echo "Supplier Address - $supplier_address<br><hr>";

	echo "<div class='ml-2'>";
	echo "GRN No. - $grn_no <br>
	date - $grn_date<br><br>";

	echo "Supplier Challan No - $supplier_challan_no <br>
	date - $sch_date<br><br>";

    echo "Supplier Bill No - $supplier_bill_no<br>
    date - $sb_date<br><br>";
	
*/
echo "</div>";

	$sql3="SELECT material,total_qty,unit FROM grn_material WHERE grn_no=$grn_no";

	$result3=mysqli_query($conn,$sql3);
    $data3=mysqli_fetch_all($result3);


     //echo "<hr>";
	echo"<div class='setborder'><table class='table m-2 p-2 overflow-auto text-center'>
        <thead>
        <tr >
            <th scope='col' >Material</th>
            <th scope='col'>Quantity</th>
            <th scope='col'>Unit</th>
        </tr>
        </thead>
        <tbody>";
                foreach($data3 as $d3)
                {
                    $array=$d3;
//                    print_r($print_data);
                    
                    echo "<tr>";
                    foreach($array as $p){
                        $print_data=$p;
                        
                        echo "<td>";
                        echo "$print_data";
                        echo "</td>";
                    }
                    echo "</tr>";
                } 
         echo "</tbody></table></div><br><br><br>";  
		//  echo "<address class='ml-3'><h6>Supplier Address - $supplier_address</h6></address><br><br><br>";
	
		echo "<div class='signs text-left ml-3' style='font-size:19px;'>";
		echo "reciever signature";
		echo "</div>";
	
		echo "<div class='signs text-right' style='font-size:19px;'>";
		echo "checkedBy";
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