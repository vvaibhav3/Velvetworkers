<!DOCTYPE html>
<html>
<head>

	<style type="text/css">
		address{
      font-size: 19px;
			text-transform: capitalize;
		}

		.details{
			text-transform: capitalize;
			font-size: 18px;
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
     
	<title class="d-print-none">Issue Note Print</title>
</head>
<body>

<?php
require("crusher_print.php");
// $sales_order_no=$_SESSION['sales_order_no'];
// echo $sales_order_no;

if(isset($_SESSION['issue_no'])){
$issue_no=$_SESSION['issue_no'];
require("../conn.php");

$sql="SELECT issue_no,issue_date,grn_no,issued_to,remark FROM issue_note WHERE issue_no=$issue_no";

			$result=mysqli_query($conn,$sql);
            $data=mysqli_fetch_all($result);

            $issue_no=0;

            foreach ($data as $d) {
                // print_r($d);
                  $issue_no=$d[0];
                  $issue_date=$d[1];
                  $grn_no=$d[2];
                  $issued_to=$d[3];
                  $remark=$d[4];
                // echo $company;
              }

              if($issue_no==0){
                echo "<script> alert('Invalid Issue No. Failed Try Again.....');";
                echo "window.location='issue_note_printer.php';";
                echo "</script>";
              }

	echo "<div class='container my-4 p-5' style='border:1px solid black;'>";
	// 	//Issue details
	echo "<center><h3>Issue Note</h3></center><hr style='border: 0.3px solid black;'>";

	echo "<div class='details'>";

  echo "<table class='table overflow-auto'>
        <tbody>
		<tr>	<td scope='col'>Issued to - $issued_to
				<td scope='col'>Issue No. - $issue_no</td>
        <td scope='col'>date - $issue_date</td>
        <td scope='col'>GRN No - $grn_no  </td>
			</td>
		</tr>
		</tr>

		
		</tbody></table><hr>";
    echo "<address class='ml-3'>Remarks - $remark</address><hr>";
    
/*	echo "Issue No. - $issue_no&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    date - $issue_date<br><br>";

	echo "GRN No - $grn_no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    Issued to - $issued_to<br><br>";

    echo "Remarks - $remark<br><hr>";

	echo "material - $material &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
	qauntity - $quantity &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    unit - $unit<hr><br><br>";
*/    

echo"<br>";
$sql3="SELECT material,quantity,unit FROM issue_note_material WHERE issue_no=$issue_no";

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

	echo "<div class='signs text-left ml-3'>";
	echo "reciever signature";
	echo "</div>";

	echo "<div class='signs text-right '>";
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