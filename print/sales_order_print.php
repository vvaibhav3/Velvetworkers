<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<style type="text/css">
		address{
			text-transform: capitalize;
            font-size: 18px;
		}

		.details{
			/* margin: 10px; */
			/* padding: 10px ; */
			border: 1px solid gray;
			font-size: 18px;
			text-transform: capitalize;
		}
		table{
			margin:20px;
			padding: 10px;
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

		.termsANDcondions{
			text-transform: capitalize;
            font-size: 15px;
		}
        @page {
                size: 7in 9.25in;
                margin: 5mm 1mm 5mm;
        }
	</style>
<title>Sales Order Print</title>
</head>
<body>


<?php
require("crusher_print.php");

// $sales_order_no=$_SESSION['sales_order_no'];
// echo $sales_order_no;

if(isset($_SESSION['sales_order_no'])){
$sales_order_no=$_SESSION['sales_order_no'];
require("../conn.php");

$sql="SELECT company,sales_order_no,site_name,address,city,date,payment_terms FROM sales_order1 WHERE sales_order_no=$sales_order_no";

			$result=mysqli_query($conn,$sql);
            $data=mysqli_fetch_all($result);

            foreach ($data as $d) {
            	// print_r($d);
                  $company=$d[0];
                  //$cutomer=$d[1];
                  $sales_order_no=$d[1];
                  $site_name=$d[2];
                  $address=$d[3];
                  $city=$d[4];
                    $date=$d[5];
                    $payment_terms=$d[6];
                 
              }

	

	// getting party mobile no and gst_no

	$sql2="SELECT mobile_no,gst_no FROM party_details WHERE company='$company'";

	$result2=mysqli_query($conn,$sql2);
    $data2=mysqli_fetch_all($result2);


	foreach ($data2 as $d2) {
		$mobile_no=$d2[0];
		$gst_no=$d2[1];
	}


		//your company name
	echo "<div class='container my-5 p-5' style='border:1px solid black;'>";
	echo "<header><center><h3>SAMARTH CONSTRUCTION COMPANY</h3></center></header><hr style='border: 0.5px solid black;'>";

		// your company address
	echo "<address class='ml-2'>office-address- office no 4- first floor , jamadar tower , opp. killa baag 138 , murarji peth , solapur .<br>
		tel no. 0217-27455555 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  mobile no. 9921555533<br>
		email abhaystoneindustries@gmail.com</address><hr>";

		// crusher address
	echo "<address class='ml-2'>Site Address - survey no 450 , kashegaon , near manchikonda pole factory , solapur tuljapur road , kashegaon , tal. - solapur , dist. - solapur (maharashtra) .</address><hr>";

		//sales order details
	echo "<center><h3>Sales Order</h3></center><hr style='border: 0.5px solid black;'>";

    //echo "<div class='details'>";
    
    // echo "<table class='table overflow-auto text-left mb-0 mt-0' style='border-top:2px solid black;'>
    //     <tbody>
        
    //     <tr>	<td scope='col'>sales order no - $sales_order_no</td>
    //             <td scope='col'>date - $date<td>
    //             <td></td>
    //             <td></td>
    //     </tr>
        
    //     </tbody></table>";

    //     echo "<table class='table overflow-auto text-left mt-0' >
    //     <tbody>
        
    //     <tr>	<td scope='col'>company- $company</td></tr>
    //     <tr>	<td scope='col'>site address - $address , $city</td></tr>
    //     <tr>    <td scope='col'>Mobile No - $mobile_no</td</tr></tbody></table>
    //     ";

        echo "<address class='ml-4 mb-1'>sales order no - $sales_order_no &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; date - $date</address>
        <address class='ml-4 mb-1'>company- $company</address>
        <address class='ml-4 mb-1'>site address - $address , $city </address>
        <address class='ml-4 mb-0'>Mobile No - $mobile_no</address>
        <address class='ml-4'>Site Name - $site_name</address>";
	/*echo "sales order no - $sales_order_no &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			date - $date<br><br>";

	echo "company Name - $company &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; customer - $cutomer<br>";

	echo "mobile no - $mobile_no<br>";

	echo "site address - $address , $city<br>";

    */
	//echo "</div>";

	//getting sales order materials

	$sql3="SELECT material,total_quantity,unit,rate FROM material_orders WHERE sales_order_no=$sales_order_no";

	$result3=mysqli_query($conn,$sql3);
    $data3=mysqli_fetch_all($result3);


     echo "<hr class='mb-4'>";
	echo"<div class='setborder'><table class='table m-2 p-2 overflow-auto '>
        <thead>
        <tr>
            <th scope='col'>Material</th>
            <th scope='col'>Quantity</th>
            <th scope='col'>Unit</th>
            <th scope='col'>Rate</th>
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
         echo "</tbody></table></div>";  

         echo "<div class='termsANDcondions ml-3'>";
         
         $get_data="SELECT t_and_c FROM terms WHERE sales_order_no=$sales_order_no";
         $get_result=mysqli_query($conn,$get_data);

         $s_no=mysqli_fetch_all($get_result);

         foreach($s_no as $sn){
             $sdata=$sn[0];
         }
         $strings=($sdata);
         if($strings==0){
             echo "1.taxes - quoted rate's are without GST it will be charged extra on invoice amount 5% extra .<br>
             2.royalty - quoted rate's are with royalty .<br>
             3.quotation validity - 30 days .<br>
             4.delivery - as per schedule mention / given by customer . <br>
             5.material supplying vehicle diesel issued by the purchase party and diesel amount should be deducted monthly in our sales bills .<br>
             6.material will be supplied after purchase order and purchase agreement only .<br>
             7.if there is technical problem in our crusher or natural problem will be occured and we can't supply materials (aggregate) to your<br>
             company in that case we are not liable for any penalty claim or any judical terms .<br>
             8.subject to solapur jurisdiction .<br>";
         }else{
         //using nl2br function to display string with new line on screen
         echo nl2br($strings,false);
         }
         echo "*payment terms - $payment_terms .";
         echo "</div>";

         echo "<h6 class='ml-3'>Hope , we have quoted in line our lowest offer as per your requirement and now look forward for your valuable order .</h6><br>";
         echo "<div class='text-right'> For , Abhay Stone Industries . </div>";

      echo "<center><button class='btn btn-outline-primary my-4 d-print-none' onclick='print_page()'> Print </buttton></center>";
      echo "</div>";//closing of container

}else{
    echo "<script>alert('Data Not Found..');
    window.location='../home.php';</script>";
}

mysqli_close($conn);
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