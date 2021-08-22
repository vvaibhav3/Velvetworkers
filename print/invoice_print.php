<!DOCTYPE html>
<html>
<head>
<?php

require("office_print.php");
?>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<style type="text/css">

		address{
			text-transform: capitalize;
			font-size: 18px;
		}
		.details{
      		text-transform: capitalize;
      		font-size: 18px;
    	}
		table{
			text-align: center;
			font-size: 18px;
            text-transform: capitalize;
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

</head>
<body>


<?php

// $sales_order_no=$_SESSION['sales_order_no'];
// echo $sales_order_no;

if(isset($_SESSION['invoice_no'])){
$invoice_no=$_SESSION['invoice_no'];
$username=$_SESSION['username'];
require("../conn.php");

$sql="SELECT challan_no FROM material_challan1 WHERE status=$invoice_no";

			$result=mysqli_query($conn,$sql);
            $data=mysqli_fetch_all($result);
            $j=0;//for $challan_no
            $i=0;//for $d
            foreach ($data as $d) {
              //print_r($d);
			  $challan_no[$j]=$d[0];
              $j+=1;
			}

			if(!mysqli_num_rows($result)){
				unset($_SESSION['invoice_no']);
				mysqli_close($conn);
				echo "<script>alert('Challan No. Not Found Failed......'); window.location:'invoice_printer.php';</script>";
			}
				$ct=count($challan_no);
				for($i=0;$i<$ct;$i++){
					//echo $challan_no[$i]."<br>";
					$id[$i]=$challan_no[$i];
					//$insert="INSERT INTO invoice_each(invoice_no,challan_no) VALUES($invoice_no,$challan_no[$i])";
					//mysqli_query($conn,$insert);
					$sql="SELECT challan_no,material,quantity,unit,rate,company FROM material_challan1 WHERE challan_no=$challan_no[$i]";
					$result=mysqli_query($conn,$sql);
			 		$data=mysqli_fetch_all($result);
		
					foreach ($data as $d3) {
						 //print_r($d3);
						  $challan_no[$i]=$d3[0];
						  $material[$i]=$d3[1];
						  $qty[$i]=$d3[2];
						  $unit[$i]=$d3[3];
						  $rate[$i]=$d3[4];
						  $company=$d3[5];
						  // echo $d3[0]."<br>";
					  }
				}
		
	if(mysqli_num_rows($result))
	{
		$m=count($material);
		//amount=Quantity * Rate calculating for Sub total material
		for($j=0;$j<$m;$j++){
			$amount[$j]=$qty[$j]*$rate[$j];
		}
		$n=count($amount);
		//print_r($amount);
		$networth=0;
		for($k=0;$k<$n;$k++){
			$networth=$networth+$amount[$k];
		}
		$chcek_gst = "SELECT cgst FROM invoice_amounts WHERE invoice_no=$invoice_no AND cgst=0 AND sgst=0";

			$result_check = mysqli_query($conn, $chcek_gst);

			if (mysqli_num_rows($result_check)) {
				$SGST = 0;
				$CGST = 0;
				$total = $networth;
			} else {
				$SGST = ($networth * 2.5) / 100;
				//echo "<br>SGST : ".$SGST;
				$CGST = ($networth * 2.5) / 100;
				//echo "<br>CGST : ".$CGST;
				$total = ($networth + $SGST + $CGST);
				//echo "<br> Total With GST: ".$total;	
			}

				// Printing Data
		echo "<div class='print_data'>";

		echo "<div class='container p-4' style='border:1px solid black;'>";

		echo "<header><center><h3>SAMARTH CONSTRUCTION COMPANY</h3></center></header><hr style='border: 1px solid black;'>";

			// your company address
		echo "<address class='ml-3'>office-address- office no 4- first floor , jamadar tower , opp. killa baag 138 , murarji peth , solapur .<br>
			tel no. 0217-27455555 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  mobile no. 9921555533<br>
			email abhaystoneindustries@gmail.com</address><hr>";

			// crusher address
		echo "<address  class='ml-3'>site Address - survey no 450 , kashegaon , near manchikonda pole factory , solapur - tuljapur road , kashegaon , tal. - solapur , dist. - solapur (maharashtra) .</address><hr>";

		//getting gst_no
		$sql4="SELECT address,city,mobile_no,gst_no FROM party_details WHERE company='$company'";

		$result4=mysqli_query($conn,$sql4);
			$data4=mysqli_fetch_all($result4);


		foreach ($data4 as $d4) {
			$address=$d4[0];
			$city=$d4[1];
			$mobile=$d4[2];
			$gst_no=$d4[3];
		}

		echo "<center><h3>Tax-Invoice</h3></center> <hr style='border: 1px solid black;'>";

		echo "<div class='details'>";

		//getting date of invoice when it was created
		$get_invoice_date="SELECT date FROM invoice_amounts WHERE invoice_no=$invoice_no";
		$result=mysqli_query($conn,$get_invoice_date);
		$data=mysqli_fetch_all($result);

		foreach($data as $d){
			$date=$d[0];
		}
		
		echo "<address class='ml-4 mb-1'>invoice no - $invoice_no &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; date - $date</address>
		<address class='ml-4 mb-1'>company- $company</address>
		<address class='ml-4 mb-1'>site address - $address , $city .</address>
		<address class='ml-4 mb-1'>Mobile No - $mobile</address>
		<address class='ml-4 mb-3'>gst no.- $gst_no</address>";

		echo "<div class='setborder'><table class='table text-center'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Sr No.</th><th>Material</th><th>Quantity</th><th>Unit</th>
        <th>Rate</th><th>Amount</th>";
        echo "</tr></thead><tbody>";

				$k=1;
				$index=0;
				for($j=0;$j<$m;$j++){
                
                if($j==0){
                  $print_array[0][0]=$material[$j];
                  $print_array[0][1]=$qty[$j];
                  $print_array[0][2]=$unit[$j];
                  $print_array[0][3]=$rate[$j];
                  $print_array[0][4]=$amount[$j];
                  $index+=1;
                  //echo $print_array[0][0];
                }
                else{
                  $flag=0;
                  for($w=0;$w<$j;$w++){
                    //for($w=0;$w<5;$w++){
                    if($print_array[$w][0]==$material[$j]){
                      $print_array[$w][1]+=$qty[$j];                      
                      $print_array[$w][4]+=$amount[$j];
                      //echo $print_array[$w][0]."<br> org=".$material[$j];
                      $flag=1;
                      break;
                    }
                  }
                    if($flag==0){
                      $print_array[$index][0]=$material[$j];
                      $print_array[$index][1]=$qty[$j];
                      $print_array[$index][2]=$unit[$j];
                      $print_array[$index][3]=$rate[$j];
                      $print_array[$index][4]=$amount[$j];
                      //echo $print_array[$index][0]."<br> org=".$material[$j];
                      $index+=1;
                    }
                  }
				}
	
				
		for($jv=0;$jv<$index;$jv++){
			echo "<tr>";
			$temp=$jv+1;
			echo "<td>$temp</td><td>".$print_array[$jv][0]."</td><td>".$print_array[$jv][1]."</td><td>".$print_array[$jv][2]."</td><td>".$print_array[$jv][3]."</td><td>".$print_array[$jv][4]."</td>";
			echo "</tr>";
		}
	$number=$total;
		   $no = floor($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'One', '2' => 'Two',
    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
    '13' => 'Thirteen', '14' => 'Fourteen',
    '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
    '60' => 'Sixty', '70' => 'Seventy',
    '80' => 'Eighty', '90' => 'Ninety');
   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
//   echo $result . "Rupees  " . $points . "Paise";
		echo "</tbody>";
		echo "</table></div><hr>";
	
			// echo "<center><h3>Total Amount</h3></center><hr style='border: 0.5px solid black;'>";
  		echo "<div align='left'>";
		echo "SGST Amount (2.5%) - rs.$SGST <br>";
	
		echo "CGST Amount (2.5%) - rs.$CGST <br>";
	
		echo "Total - rs.$total <br></div>";
  
		echo "In Words - $result Rupees Only. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<hr style='border: 0.5px solid black;'>";

	
		echo "<p class='lead ' style='font-size:16px;'> I/We hereby certify that our registration certificate under the GST act is in force on the date on which the goods specified in this tax invoice is made by us and that the transaction of sale covered by tax invoice has been effected by us and it shall be accounted for in the turnover of sale while filling of return and the due tax , if any , payable on the sale has been paid or shall be paid.</p><hr style='border: 0.5px solid black;'>";
	
		echo "<div class='bottom'><b>NEFT / RTGS Details  :- <b><br>
		bank name - the karad urban co-op. bank ltd.<br>
		A/C no - 1027103000047 <br>
		branch - chatti  galli , solapur <br>
		Account type - CC<br>
		IFSC - KUCB0488027<br>
		</div>";     
	
		echo "<div class='bottom text-right'><br><br>
		authorised signature</div>";   
	
	echo "</div></div></div>";
	
	}
	else{
		unset($_SESSION['invoice_no']);
		mysqli_close($conn);
		echo "<script>alert('Challan No. Not Found Failed......'); window.location:'invoice_printer.php';</script>";
	}

mysqli_close($conn);
}//isset end
?>
 <center>
      <button class=" btn btn-outline-primary d-print-none my-3" onclick="print_page()"> Print </button>
</center>
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