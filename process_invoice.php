<!DOCTYPE html>
<html>

<head>
  <?php

  require("office.php");
  ?>
  <title>Process Invoice</title>


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style type="text/css">
    address {
      text-transform: capitalize;
      font-size: 18px;
    }

    .print_data {
      display: none;
      text-transform: capitalize;
    }

    .details {
      text-transform: capitalize;
      font-size: 18px;
    }

    table {
      font-size: 16px;
    }


    .setborder table tbody tr td {
      border: 2px solid black;
    }

    .setborder table thead th {
      border: 2px solid black;
    }

    @media print {

      .print_data {
        display: inline-block;
      }

      .details {
        display: inline-block;
      }

    }

    @page {
      size: 7in 9.25in;
      margin: 5mm 0.1mm 5mm;
    }
  </style>

  <link rel="stylesheet" href="./bg-style.css">
</head>

<body>


  <!-- include navbar -->
  <?php require("navbar.php"); ?>

  <div class="container mb-4 bg-light ">

    <?php

    require("conn.php");
    // $id=array();

    if (isset($_POST['get_challan_list'])) {

      $sales_order_no = $_SESSION['sales_order_no2'];
      //$invoice_no=$_SESSION['invoice_no'];

      //$sql9="SELECT status FROM material_challan1 WHERE status=$invoice_no LIMIT 1";
      ///check if duplicate invoice no....
      // $result7=mysqli_query($conn,$sql9);

      // if(mysqli_num_rows($result7)){
      //   unset($_SESSION['inoice_no']);
      //   unset($_SESSION['sales_order_no2']);
      //   mysqli_close($conn);
      //   echo "<script> alert('Invoice No Is Dupliacte Failed....');";
      //   echo "window.location='invoice.php'";
      //   echo "</script>"; 
      // }

      if (!isset($_POST['challan_list'])) {
        mysqli_close($conn);
        echo "<script>alert('Please Mark CheckBox to Proceed');window.location='invoice.php';</script>";
      }
      $selected_data = array($_POST['challan_list']);

      $username = $_SESSION['username'];

      //Getting Material Details
      foreach ($selected_data as $s) {
        $ct = count($s);
        for ($i = 0; $i < $ct; $i++) {
          // echo $s[$i]."<br>";
          $id[$i] = $s[$i];
          $sql = "SELECT challan_no,material,quantity,unit,rate,company FROM material_challan1 WHERE challan_no=$s[$i]";
          $result = mysqli_query($conn, $sql);
          $data = mysqli_fetch_all($result);

          foreach ($data as $d3) {
            // print_r($d3);
            $challan_no[$i] = $d3[0];
            $material[$i] = $d3[1];
            $qty[$i] = $d3[2];
            $unit[$i] = $d3[3];
            $rate[$i] = $d3[4];
            $company = $d3[5];
            // echo $d3[0]."<br>";
          }
        }
      }
      date_default_timezone_set('Asia/Kolkata');
      $date = date("Y-m-d");
      $time = date("H:i:s");

      // echo "";


      if (mysqli_num_rows($result)) {
        // echo $material[1]."<br>";
        // echo $qty[1]."<br>";
        // echo $rate[1]."<br>";
        $m = count($material);
        echo "<div class='h1 text-center d-print-none'>Material Details 
                          <hr class='mt-0 mb-4'></div>";
        // echo $m;
        // echo "<br> <h1>calculation</h1>";

        //amount=Quantity * Rate calculating for Sub total material
        $k = 1;
        for ($j = 0; $j < $m; $j++) {

          date_default_timezone_set('Asia/Kolkata');
          $date = date("Y-m-d");
          $time = date("H:i:s");

          $amount[$j] = $qty[$j] * $rate[$j];

          $_SESSION['id'] = $challan_no[$j];
          // echo $material[$j]." amount : ".$amount[$j]."<br>";

          $insert_data = "INSERT INTO finished_materials(challan_no,sales_order_no,material,quantity,unit,rate,sub_total,time,date,username) VALUES($challan_no[$j],$sales_order_no,'$material[$j]',$qty[$j],'$unit[$j]',$rate[$j],$amount[$j],'$time','$date','$username')";

          if (mysqli_query($conn, $insert_data)) {

            echo "<div class='row d-print-none'>

                          <div class='form-group col-sm-4'>
                            <label for='inputMaterial'>$k. Material</label>
                            <input type='text' class='form-control' id='inputMaterial' value=$material[$j]  disabled>
                          </div>

                          <div class='form-group col-sm-4'>
                            <label for='inputQuantity'>Quantity</label>
                            <input type='text' class='form-control' id='inputQuantity' value=$qty[$j]  disabled>
                          </div>

                          <div class='form-group col-sm-4'>
                            <label for='inputUnit'>Unit</label>
                            <input type='text' class='form-control' id='inputUnit' value=$unit[$j]  disabled>
                          </div>

                           <div class='form-group col-sm-4'>
                            <label for='inputRate'>Rate</label>
                            <input type='text' class='form-control' id='inputRate' value=$rate[$j]  disabled>
                          </div>

                          <div class='form-group col-sm-4'>
                            <label for='inputSubTotal'>Sub Total</label>
                            <input type='text' class='form-control' id='inputSubTotal' value=$amount[$j]  disabled>
                          </div>
                          <hr class='mt-0 mb-4'></div>";


            $k++;
          } else {
            echo "Failed...";
          }
        }
        // calculating networth i.e. Total without GST
        $n = count($amount);
        // echo $n;
        // print_r($amount);
        $networth = 0;
        for ($k = 0; $k < $n; $k++) {
          $networth = $networth + $amount[$k];
        }
        // echo "networth: ".$networth;

        $SGST = ($networth * 2.5) / 100;
        // echo "<br>SGST : ".$SGST;
        $CGST = ($networth * 2.5) / 100;
        // echo "<br>CGST : ".$CGST;
        $total = ($networth + $SGST + $CGST);
        // echo "<br> Total With GST: ".$total;


        date_default_timezone_set('Asia/Kolkata');
        $date1 = date("Y-m-d");
        $time1 = date("H:i:s");

        $temp_challan_no = $_SESSION['id'];
        $insert_data2 = "INSERT INTO invoice_amounts(challan_no,sales_order_no,networth,sgst,cgst,total,time,date,username) VALUES($temp_challan_no,$sales_order_no,$networth,$SGST,$CGST,$total,'$time1','$date1','$username')";

        if (mysqli_query($conn, $insert_data2)) {

          //getting invoice no
          $get_data = "SELECT invoice_no FROM invoice_amounts ORDER BY invoice_no DESC LIMIT 1";
          $get_result = mysqli_query($conn, $get_data);

          $s_no = mysqli_fetch_all($get_result);

          foreach ($s_no as $sn) {
            $sdata = $sn[0];
          }
          $invoice_no = $sdata;
          echo "<div class='h1 text-center d-print-none'> Total Amount 
                          <hr class='mt-0 mb-4'></div>

                          <div class='row d-print-none'>
						            
                          <div class='form-group col-sm-4'>
                          <label for='inputNetWorth'>Net Worth</label>
                          <input type='number' name='net_worth' class='form-control' id='inputNetWorth' value=$networth disabled>
                          </div>

                              <div class='form-group col-sm-4'>
                          <label for='inputSGST'>SGST</label>
                          <input type='number' name='SGST' step='any' class='form-control' id='inputSGST' value=$SGST disabled>
                            </div>

                            <div class='form-group col-sm-4'>
                          <label for='inputCGST'>CGST</label>
                          <input type='number' name='CGST' step='any' class='form-control' id='inputCGST' value=$CGST disabled>
                            </div>

                             <div class='form-group col-sm-4'>
                          <label for='inputTotalAmount'>Total Amount</label>
                          <input type='number' name='total_amount' step='any' class='form-control' id='inputTotalAmount' value=$total disabled>
                            </div>

                          </div>";
        } else {
          echo "<script>alert('Failed...');</script>";
        }

        //Cleaning Material Challan
        date_default_timezone_set('Asia/Kolkata');
        $date2 = date("Y-m-d");
        $time2 = date("H:i:s");
        // $username=$_SESSION['username'];
        $a = count($id);

        for ($v = 0; $v < $a; $v++) {
          $sql3 = "SELECT * FROM material_challan1 WHERE challan_no=$id[$v]";
          $result3 = mysqli_query($conn, $sql3);
          $data3 = mysqli_fetch_all($result3);

          foreach ($data3 as $d) {
            $array = $d;
          }

          //deleting data

          // $insert="INSERT INTO deleted_material_challan(company,challan_no,sales_order_no,date,material,quantity,unit,rate,vehicle_no,driver_name,truck_reading,mobile_no,username,deleted_time,deleted_date) VALUES('$array[0]',$array[1],$array[2],'$array[3]','$array[4]',$array[5],'$array[6]',$array[7],'$array[8]','$array[9]',$array[10],$array[11],'$username','$time2','$date2')";

          //if(mysqli_query($conn, $insert)){


          // $delete_query="DELETE FROM material_challan1 WHERE id=$id[$v]";
          $_SESSION['invoice_no'] = $invoice_no;
          $update = "UPDATE material_challan1 SET status=$invoice_no WHERE challan_no=$id[$v]";

          mysqli_query($conn, $update);
          //}
          // Printing Data
          echo "<div class='print_data'>";

          echo "<div class='container p-4' style='border:1px solid black;'>";

          echo "<header><center><h3>ABHAY STONE INDUSTRIES</h3></center></header><hr style='border: 0.3px solid black;'>";

          // your company address
          echo "<address class='ml-3'>office-address- office no 4- first floor , jamadar tower , opp. killa baag 138 , murarji peth , solapur .<br>
    tel no. 0217-27455555 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  mobile no. 9921555533<br>
    email abhaystoneindustries@gmail.com</address><hr>";

          // crusher address
          echo "<address  class='ml-3'>site Address - survey no 450 , kashegaon , near manchikonda pole factory , solapur - tuljapur road , kashegaon , tal. - solapur , dist. - solapur (maharashtra) .</address><hr>";

          //getting gst_no
          $sql4 = "SELECT address,city,mobile_no,gst_no FROM party_details WHERE company='$company'";

          $result4 = mysqli_query($conn, $sql4);
          $data4 = mysqli_fetch_all($result4);


          foreach ($data4 as $d4) {
            $address = $d4[0];
            $city = $d4[1];
            $mobile = $d4[2];
            $gst_no = $d4[3];
          }

          echo "<center><h3>Tax-Invoice</h3></center><hr style='border: 0.5px solid black;'>";

          echo "<div class='details'>";


          echo "<address class='ml-4 mb-1'>invoice no - $invoice_no &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp; date - $date</address>
  <address class='ml-4 mb-1'>company- $company</address>
  <address class='ml-4 mb-1'>site address - $address , $city .</address>
  <address class='ml-4 mb-1'>Mobile No - $mobile</address>
  <address class='ml-4 mb-3'>gst no.- $gst_no</address>";

          // echo "<table class='table overflow-auto text-left mb-0 mt-0' style='border-top:2px solid black;'>
          // <tbody>

          // <tr>	  <td scope='col'>invoice no - $invoice_no</td>
          //         <td scope='col'>date - $date<td>
          //         <td></td>
          //         <td></td>
          // </tr>

          // </tbody></table>";

          // echo "<table class='table overflow-auto text-left mt-0' >
          // <tbody>

          // <tr>	<td scope='col'>company- $company</td></tr>
          // <tr>	<td scope='col'>site address - $address , $city</td></tr>
          // <tr>    <td scope='col'>Mobile No - $mobile</td</tr>
          // </tbody></table><tbody></table>";



          //   echo "<table class='table table-border-0 overflow-auto text-left' border='0'>
          //   <tbody>

          //   <tr>	<td scope='col'>invoice no - $invoice_no</td>
          //           <td scope='col'>date - $date<td>
          //           <td></td>
          //           <td></td>
          //   </tr>
          //   <tr>	<td scope='col'>company- $company</td>
          //   <td scope='col'>gst no.- $gst_no</td>
          //           <td></td>
          //           <td></td>
          // </tr>

          //   </tbody></table>";

          // echo "<address class='ml-3 mb-1'><h6>site address - $address , $city </h6></address><br>
          // <address class='ml-3'><h6>Mobile No - $mobile</h6></address>";

          echo "<div class='setborder'><table class='table text-center'>";
          echo "<thead>";
          echo "<tr>";
          echo "<th>Sr No.</th><th>Material</th><th>Quantity</th><th>Unit</th>
        <th>Rate</th><th>Amount</th>";
          echo "</tr></thead><tbody>";

          $k = 1;
          $index = 0;
          for ($j = 0; $j < $m; $j++) {

            if ($j == 0) {
              $print_array[0][0] = $material[$j];
              $print_array[0][1] = $qty[$j];
              $print_array[0][2] = $unit[$j];
              $print_array[0][3] = $rate[$j];
              $print_array[0][4] = $amount[$j];
              $index += 1;
              //echo $print_array[0][0];
            } else {
              $flag = 0;
              for ($w = 0; $w < $j; $w++) {
                //for($w=0;$w<5;$w++){
                if ($print_array[$w][0] == $material[$j]) {
                  $print_array[$w][1] += $qty[$j];
                  $print_array[$w][4] += $amount[$j];
                  //echo $print_array[$w][0]."<br> org=".$material[$j];
                  $flag = 1;
                  break;
                }
              }
              if ($flag == 0) {
                $print_array[$index][0] = $material[$j];
                $print_array[$index][1] = $qty[$j];
                $print_array[$index][2] = $unit[$j];
                $print_array[$index][3] = $rate[$j];
                $print_array[$index][4] = $amount[$j];
                //echo $print_array[$index][0]."<br> org=".$material[$j];
                $index += 1;
              }
            }

            /* if($material[$j+1]==$material[$j]){
                  $new_quantity=$qty[$j]+$qty[$j+1];
                  $new_amount=$amount[$j]+$amount[$j+1];
                  echo "<tr>";
                  echo "<td>$j</td><td>$material[$j]</td><td>$new_quantity</td>
                        <td>$unit[$j]</td><td>$rate[$j]</td><td>$new_amount</td>";
                  echo "</tr>";
                }
                else{
                  echo "<td>$j</td><td>$material[$j]</td><td>$qty[$j]</td>
                        <td>$unit[$j]</td><td>$rate[$j]</td><td>$amount[$j]</td>";
                  echo "</tr>";
                }*/
          }

          for ($jv = 0; $jv < $index; $jv++) {
            echo "<tr>";
            $temp = $jv + 1;
            echo "<td>$temp</td><td>" . $print_array[$jv][0] . "</td><td>" . $print_array[$jv][1] . "</td><td>" . $print_array[$jv][2] . "</td><td>" . $print_array[$jv][3] . "</td><td>" . $print_array[$jv][4] . "</td>";
            echo "</tr>";
            //inserting data into invoice each table
            $material_temp = $print_array[$jv][0];
            $quantity_temp = $print_array[$jv][1];
            $unit_temp = $print_array[$jv][2];
            $rate_temp = $print_array[$jv][3];
            $amount_temp = $print_array[$jv][4];
            $material_sgst = ($print_array[$jv][4] * 2.5) / 100;
            $material_cgst = $material_sgst;
            $material_total = ($material_sgst + $material_cgst + $print_array[$jv][4]);
            $insert = "INSERT INTO invoice_each(invoice_no,date,challan_no,sales_order_no,material,quantity,unit,rate,amount,sgst,cgst,total,username) VALUES($invoice_no,'$date',$challan_no[$jv],$sales_order_no,'$material_temp',$quantity_temp,'$unit_temp',$rate_temp,$amount_temp,$material_sgst,$material_cgst,$material_total,'$username')";
            mysqli_query($conn, $insert);
          }

          echo "</tbody>";
          echo "</table></div>";

          echo "<hr>";

          echo "<center><h3>Total Amount</h3></center><hr style='border: 0.5px solid black;'>";

          echo "Networth - rs.$networth &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

          echo "SGST Amount (2.5%) - rs.$SGST &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";

          echo "CGST Amount (2.5%) - rs.$CGST &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br>";

          echo "Total - rs.$total &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<hr style='border: 0.5px solid black;'>";

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
      }
    } else {
      unset($_SESSION['id']);
      // unset($_SESSION['invoice_no']);
      unset($_SESSION['sales_order_no2']);
      // echo "<script> alert('Done....');";
      //echo "</script>";

      if (isset($_POST['remove_gst'])) {
        $invoice_no1 = $_SESSION['invoice_no'];
        $networth1 = "SELECT networth from invoice_amounts WHERE invoice_no=$invoice_no1";
        $result1 = mysqli_query($conn, $networth1);
        $networth1 = mysqli_fetch_all($result1);
        $net = 0;
        foreach ($networth1 as $n) {
          $net = $n[0];
        }
        $update_invoice_amounts = "UPDATE invoice_amounts set sgst=0,cgst=0,total=$net WHERE invoice_no=$invoice_no1";
        mysqli_query($conn, $update_invoice_amounts);
        $sql_ch = "SELECT challan_no FROM invoice_each WHERE invoice_no=$invoice_no1";
        $sql_net = "SELECT amount FROM invoice_each WHERE invoice_no=$invoice_no1";
        $result1 = mysqli_query($conn, $sql_ch);
        $data_ch = mysqli_fetch_all($result1);

        $result2 = mysqli_query($conn, $sql_net);
        $data_net = mysqli_fetch_all($result2);

        $i = 0;
        foreach ($result1 as $dch) {
          $ch[$i] = $dch;
          $i += 1;
        }
        $i = 0;
        foreach ($result2 as $n) {
          $netw[$i] = $n;
          $i += 1;
        }
        $k = 0;
        $j = 0;
        for ($var = 0; $var < $i; $var++) {
          foreach ($netw[$var] as $nw) {
            // $k = $nw;
            $new_nw[$k] = $nw;
            $k += 1;
          }
          foreach ($ch[$var] as $ch1) {
            // $k = $nw;
            $new_dch[$j] = $ch1;
            $j += 1;
          }
        }
        for ($var = 0; $var < $i; $var++) {
          $update_invoice_each = "UPDATE invoice_each set sgst=0,cgst=0,total=$new_nw[$var] WHERE challan_no=$new_dch[$var]";
          if (mysqli_query($conn, $update_invoice_each)) {

            echo "<script>alert('GST removed....');
	          window.location='invoice.php';</script>";
          }
          else{
            echo "<script>alert('Failed....');
	          window.location='invoice.php';</script>";
          }
        }
      }

      mysqli_close($conn);
      header('location: invoice.php');
    }

    ?>

    <!-- <div class="mx-auto" style="width: 300px;"> -->
    <!-- <form class="form-inline" action="" method="post"> -->
    <center>
      <!-- <input type="number" name="invoice_no" class="form-control" id="Invoice_No" placeholder="Enter Invoice No" required> -->

      <!-- <button class=" btn btn-outline-primary d-print-none" onclick="print_page()"> Print </button> -->
      <form class="form-inline" action="" method="post">
        <button type="submit" name="remove_gst" class="btn btn-outline-primary col-sm-2 d-print-none"> Remove GST </button>
      </form>
      <button type="submit" name="done" class="btn btn-success my-3 d-print-none " onclick="success()">Done</button>
    </center>
    <!-- <button class="btn btn-outline-warning mx-2" onclick="print_page()">Print</button> -->
    <!-- </form> -->
    <!-- </div> -->
  </div>
  <!-- Closing of container -->

  <script type="text/javascript">
    function print_page() {
      window.print();
    }

    function success() {
      alert('succesfully done....');
      window.location = 'invoice.php';
    }
  </script>

  <!-- include footer -->
  <?php require("footer.php"); ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>