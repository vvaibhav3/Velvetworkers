<!DOCTYPE html>
<html>

<head>
  <?php
  require("crusher.php");
  ?>
  <title>Reports</title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" href="./bg-style.css">
  <link rel="stylesheet" href="./table-style.css">
  <style type="text/css">

    .setborder table tbody tr td {
      border: 1px solid black;
    }

    .setborder table thead th {
      border: 1px solid black;
    }

    @page {
      size: 9.25in 7in ;
      margin: 5mm 2mm 5mm;
    }
  </style>
</head>

<body>


  <!-- include navbar -->
  <?php require("navbar.php"); ?>


  <div class="container shadow p-5 mb-4 bg-light d-print-none">
    <p class="h2 mb-0 ml-3 d-print-none">Reports</p>
    <hr class="mb-3 mt-0 d-print-none">
    <form action="" method="post">
      <div class="form-row d-print-none">

        <div class="form-group col-sm-4">
          <label for="selectTable">Select table</label>
          <select name="table_name" class="form-control" id="selectTable" required>
            <option>Sales Order</option>
            <option>Material Challan</option>
            <option>Invoice</option>
            <option>GRN</option>
            <option>Issue Note</option>
            <option>Clients</option>
            <option>Reading Report</option>
          </select>
        </div>

        <div class="form-group col-sm-4">
          <label for="selectSort1"> From -</label>
          <input type="date" name="from_sort" class="form-control" id="selectSort1">
        </div>

        <div class="form-group col-sm-4">
          <label for="selectSort2"> To -</label>
          <input type="date" name="to_sort" class="form-control" id="selectSort2">
        </div>

        <div class="form-group col-sm-4">
          <label for="inputSales_order_no">Sales Order No </label>
          <input type="number" name="sales_order_no" class="form-control" id="inputSales_order_no" placeholder="Enter Sales Order No.">
        </div>

        <div class="form-group col-sm-4">
          <label for="inputCompany">Company Name</label>
          <input type="text" name="company_name" class="form-control" id="Company" placeholder="Company Name">
        </div>

        <div class="form-group col-sm-4">
          <label for="inputSiteName">Site Name </label>
          <input type="text" name="site_name" class="form-control" id="inputSiteName" placeholder="Site Name">
        </div>

        <div class="form-group col-sm-4">
          <label for="inputMaterial">Material </label>
          <input type="text" name="material" class="form-control" id="inputMaterial" placeholder="Material">
        </div>

        <div class="form-group col-sm-12 text-center">
          <button type="submit" name="sort_data" class="btn btn-outline-primary col-sm-2 d-print-none">Sort</button>
        </div>
    </form>


  </div>
  </div>


  <script type="text/javascript">
    function print_page() {
      window.print();
    }

    function showData(c) {

      if (c == 1) {
        document.getElementById("moreOptions").style.display = "block";
      } else {
        document.getElementById("moreOptions").style.display = "none";
      }
    }
  </script>
  <!-- 
<form class='form-inline' method='post' method=''>
      <div class='form-group mx-sm-3'>
        <input type='$typeOfCol' name='value' class='form-control' id='inputGetCol' placeholder='Enter $getCol'>
      </div>
      <div class='form-group mx-sm-3'>
        <button type='submit' name='getValue' class='btn btn-primary '>Submit</button>
      </div>
      <button class='btn btn-outline-primary ml-5' onclick='print_page()' align='right'> Print </button>
    </form>  -->
  <?php
  require("conn.php");

  function sales_order_sorter($sort1, $sort2, $sales_order_no, $company, $material, $site_name)
  {
    $query = "SELECT material_orders.sales_order_no,date,material_orders.company,material,quantity,unit,site_name,city,payment_terms FROM material_orders INNER JOIN sales_order1 On material_orders.sales_order_no=sales_order1.sales_order_no WHERE quantity!=(-1) ";
    if ($sort1 != "") {
      $query = $query . " AND date>='$sort1'";
    }

    if ($sort2 != "") {
      $query = $query . " AND date<='$sort2'";
    }

    if ($sales_order_no != "") {
      $query = $query . " AND material_orders.sales_order_no=$sales_order_no";
    }

    if ($company != "") {
      $query = $query . " AND material_orders.company='$company'";
    }

    if ($material != "") {
      $query = $query . " AND replace(material,' ','')=replace('$material',' ','')";
    }

    if ($site_name != "") {
      $query = $query . " AND site_name='$site_name'";
    }
    return $query;
  }

  function client_sorter($sort1, $sort2)
  {
    if ($sort1 == "" && $sort2 == "") {
      return "SELECT company,address,city,mobile_no,gst_no FROM party_details";
    } else {
      return "SELECT company,address,city,mobile_no,gst_no FROM party_details";
    }
  }

  function material_challan_sorter($sort1, $sort2, $sales_order_no, $material ,$company)
  {

    $query = "SELECT date,challan_no,sales_order_no,company,material,quantity,unit,cash_or_credit,vehicle_no,driver_name,mobile_no,status FROM material_challan1 WHERE quantity!=(-1)";
    if ($sort1 != "") {
      $query = $query . " AND date>='$sort1'";
    }

    if ($sort2 != "") {
      $query = $query . " AND date<='$sort2'";
    }

    if ($sales_order_no != "") {
      $query = $query . " AND sales_order_no=$sales_order_no";
    }

    if ($material != "") {
      $query = $query . " AND replace(material,' ','')=replace('$material',' ','')";
    }
    
    if ($company != "") {
      $query = $query . " AND company='$company'";
    }
    return $query;
  }

  function truck_reading_sorter($sort1, $sort2, $company)
  {
    $query = "SELECT company,challan_no,date,material,quantity,unit,vehicle_no,driver_name,truck_reading FROM material_challan1 WHERE challan_no!=(-1)";
    if ($sort1 != "") {
      $query = $query . " AND date>='$sort1'";
    }

    if ($sort2 != "") {
      $query = $query . " AND date<='$sort2'";
    }
    if ($company != "") {
      $query = $query . " AND material_orders.company='$company'";
    }
    return $query;
  }

  function invoice_sorter($sort1, $sort2, $sales_order_no, $material,$company)
  {
     $query = "SELECT invoice_no,invoice_each.date,material_challan1.company,invoice_each.sales_order_no,invoice_each.material,invoice_each.quantity,invoice_each.unit,invoice_each.rate,amount,sgst,cgst,total FROM invoice_each INNER JOIN material_challan1 On invoice_each.challan_no=material_challan1.challan_no WHERE invoice_each.quantity!=(-1)";
    if ($sort1 != "") {
      $query = $query . " AND invoice_each.date>='$sort1'";
    }

    if ($sort2 != "") {
      $query = $query . " AND invoice_each.date<='$sort2'";
    }

    if ($sales_order_no != "") {
      $query = $query . " AND invoice_each.sales_order_no=$sales_order_no";
    }

    if ($material != "") {
       $query = $query . " AND replace(material,' ','')=replace('$material',' ','')";
    }
    if ($company != "") {
      $query = $query . " AND material_challan1.company='$company'";
    }
    return $query;
  }

  function grn_sorter($sort1, $sort2)
  {
    if ($sort1 == "" && $sort2 == "") {
      return "SELECT grn_material.grn_no,grn_date,supplier_name,supplier_challan_no,sch_date,supplier_bill_no,sb_date,material,quantity,unit,supplier_address FROM grn_material INNER JOIN good_reciept_note WHERE grn_material.grn_no=good_reciept_note.grn_no ";
    } else {
      return "SELECT grn_material.grn_no,grn_date,supplier_name,supplier_challan_no,sch_date,supplier_bill_no,sb_date,material,quantity,unit.supplier_address FROM grn_material INNER JOIN good_reciept_note WHERE grn_material.grn_no=good_reciept_note.grn_no AND grn_date>='$sort1' AND grn_date<='$sort2'";
    }
  }

  function issue_sorter($sort1, $sort2)
  {
    if ($sort1 == "" && $sort2 == "") {
      return "SELECT issue_note_material.issue_no,issue_date,grn_no,issued_to,material,quantity,unit,remark FROM issue_note_material INNER JOIN issue_note WHERE issue_note_material.issue_no=issue_note.issue_no";
    } else {
      return "SELECT issue_note_material.issue_no,issue_date,grn_no,issued_to,material,quantity,unit,remark FROM issue_note_material INNER JOIN issue_note WHERE issue_note_material.issue_no=issue_note.issue_no AND issue_date>='$sort1' AND issue_date<='$sort2'";
    }
  }

  //Display Table Data


  if (isset($_POST['sort_data'])) {
    $table_name = mysqli_real_escape_string($conn, $_POST['table_name']);
    $from_sort = mysqli_real_escape_string($conn, $_POST['from_sort']);
    $to_sort = mysqli_real_escape_string($conn, $_POST['to_sort']);

    $sales_order_no = mysqli_real_escape_string($conn, $_POST['sales_order_no']);

    $company = mysqli_real_escape_string($conn, $_POST['company_name']);
    $company = strtoupper($company);
    $material = mysqli_real_escape_string($conn, $_POST['material']);
    $site_name = mysqli_real_escape_string($conn, $_POST['site_name']);
    //get value of selected column from user
    // $getCol=mysqli_real_escape_string($conn,$_POST['get_col']);

    // $typeOfCol=col_sorter($getCol);

    echo "
    <div class='d-print-none shadow p-2 bg-light mb-1' align='right'>
    <button class='btn btn-outline-primary mr-6 col-sm-1' onclick='print_page()' align='right'> Print </button>
    </div>";
    // $value=null;
    // if(isset($_POST['getValue'])){
    //   $value=mysqli_real_escape_string($conn,$_POST['value']);
    //   $getCol=col_setter($getCol);
    // }

    if ($table_name == "Sales Order") {

      $sql3 = sales_order_sorter($from_sort, $to_sort, $sales_order_no, $company, $material, $site_name);
      // echo $sql3;
      $result3 = mysqli_query($conn, $sql3);
      $data3 = mysqli_fetch_all($result3);
      $count = mysqli_num_rows($result3);
      if ($count == 0) {
        echo "<script>alert('Not Found');</script>";
      }
      // echo "<hr>";
      echo "<p class='shadow-sm p-3 m-0 bg-light lead h1' align='center'> Sales Order Reports</p>";

      echo "<div class='setborder'><table class='overflow-auto bg-light'>
                <thead>
                <tr>
            <th scope='col'>Sales Order No</th>
            <th scope='col'>Date</th>
            <th scope='col'>Company</th>
            <th scope='col'>Material</th>
            <th scope='col'>Quantity</th>
            <th scope='col'>Unit</th>
            <th scope='col'>Site Name</th>
            <th scope='col'>City</th>
            <th scope='col'>Payment terms</th>
            <th scope='col'>Status</th>
                </tr>
                </thead>
                <tbody class='overflow-auto'>";
      $i = 1;
      $flag = 0;
      foreach ($data3 as $d) {
        $array = $d;
        //print_r($array);

        echo "<tr>";
        foreach ($array as $p) {
          $print_data = $p;
          echo "<td class='p-2'>";
          if ($i == 4 && $print_data == 0) {
            $flag = 1;
          }
          echo "$print_data";
          $i += 1;
          echo "</td>";
        }
        if ($flag == 1) {
          echo "<td class='p-2'>";
          echo "completed";
          echo "</td>";
          $flag = 0;
        } else {
          echo "<td class='p-2'>";
          echo "--";
          echo "</td>";
        }
        echo "</tr>";
        $i = 1;
      }
      echo "</tbody></table></div>";
    } elseif ($table_name == "Material Challan") {

      $sql3 = material_challan_sorter($from_sort, $to_sort, $sales_order_no, $material,$company);
      $result3 = mysqli_query($conn, $sql3);
      $data3 = mysqli_fetch_all($result3);
      $count = mysqli_num_rows($result3);
      if ($count == 0) {
        echo "<script>alert('Not Found');</script>";
      }

      // echo "<hr>";

      echo "<p class='shadow-sm p-3 m-0 bg-light lead h1' align='center'>Material Challan Reports</p>";

      echo "<div class='setborder'><table class='overflow-auto bg-light'>
        <thead>
        <tr>
            
        <th scope='col'>Date</th>
        <th scope='col'>Challan No</th>
        <th scope='col'>Sales Order No</th>
            <th scope='col'>Company</th>
            <th scope='col'>Material</th>
            <th scope='col'>Quantity</th>
            <th scope='col'>Unit</th>
            <th scope='col'>CS/CR</th>
            <th scope='col'>Vehicle No</th>
            <th scope='col'>Driver Name</th>
            <th scope='col'>Mobile No</th>
            <th scope='col'>Invoice Status</th>
        </tr>
        </thead>
        <tbody class='overflow-auto'>";
      foreach ($data3 as $d) {
        $array = $d;
        //                    print_r($print_data);

        echo "<tr>";
        foreach ($array as $p) {
          $print_data = $p;

          echo "<td class='p-2'>";
          echo "$print_data";
          echo "</td>";
        }
        echo "</tr>";
      }
      echo "</tbody></table></div>";
    } elseif ($table_name == "Invoice") {

      $sql3 = invoice_sorter($from_sort, $to_sort, $sales_order_no, $material,$company);
      $result3 = mysqli_query($conn, $sql3);
      $data3 = mysqli_fetch_all($result3);
      $count = mysqli_num_rows($result3);
      if ($count == 0) {
        echo "<script>alert('Not Found');</script>";
      }

      // echo "<hr>";

      echo "<p class='shadow-sm p-3 m-0 bg-light lead h1' align='center'>Invoice Reports</p>";

      echo "<div class='setborder'><table class='overflow-auto bg-light'>
      <thead>
      <tr>
          <th scope='col'>Invoice No</th>
          <th scope='col'>Date</th>
          <th scope='col'>Company Name</th>
          <th scope='col'>Sales Order No</th>
          <th scope='col'>Material</th>
          <th scope='col'>Quantity</th>
          <th scope='col'>Unit</th>
          <th scope='col'>Rate</th>
          <th scope='col'>Networth</th>
          <th scope='col'>SGST</th>
          <th scope='col'>CGST</th>
          <th scope='col'>Total</th>
      </tr>
      </thead>
      <tbody class='overflow-auto'>";
      foreach ($data3 as $d) {
        $array = $d;
        //                    print_r($print_data);

        echo "<tr>";
        foreach ($array as $p) {
          $print_data = $p;

          echo "<td class='p-2'>";
          echo "$print_data";
          echo "</td>";
        }
        echo "</tr>";
      }
      echo "</tbody></table></div>";
    } elseif ($table_name == "GRN") {

      $sql3 = grn_sorter($from_sort, $to_sort);
      $result3 = mysqli_query($conn, $sql3);
      $data3 = mysqli_fetch_all($result3);

      // echo "<hr>";

      echo "<p class='shadow-sm p-3 m-0 bg-light lead h1' align='center'> GRN Reports</p>";

      echo "<div class='setborder'><table class='overflow-auto bg-light'>
    <thead>
    <tr>
        <th scope='col'>GRN No</th>
        <th scope='col'>GRN Date</th>
        <th scope='col'>Supplier Name</th>
        <th scope='col'>Supplier Challan No</th>
        <th scope='col'>Date</th>
        <th scope='col'>Supplier Bill No</th>
        <th scope='col'>Date</th>
        <th scope='col'>Material</th>
        <th scope='col'>Quantity</th>
        <th scope='col'>Unit</th>
        <th scope='col'>Address</th>
    </tr>
    </thead>
    <tbody class='overflow-auto'>";
      foreach ($data3 as $d) {
        $array = $d;
        //                    print_r($print_data);

        echo "<tr>";
        foreach ($array as $p) {
          $print_data = $p;

          echo "<td class='p-2'>";
          echo "$print_data";
          echo "</td>";
        }
        echo "</tr>";
      }
      echo "</tbody></table></div>";
    } elseif ($table_name == "Issue Note") {

      $sql3 = issue_sorter($from_sort, $to_sort);
      $result3 = mysqli_query($conn, $sql3);
      $data3 = mysqli_fetch_all($result3);

      // echo "<hr>";

      echo "<p class='shadow-sm p-3 m-0 bg-light lead h1' align='center'>Issue Note Reports</p>";

      echo "<div class='setborder'><table class='overflow-auto bg-light'>
    <thead>
    <tr>      
        <th scope='col'>Issue No</th>
        <th scope='col'>Issue Date</th>
        <th scope='col'>GRN No</th>
        <th scope='col'>Issued To</th>
        <th scope='col'>Material</th>
        <th scope='col'>Quantity</th>
        <th scope='col'>Unit</th>
        <th scope='col'>Remarks</th>
    </tr>
    </thead>
    <tbody class='overflow-auto'>";
    $id=1;
      foreach ($data3 as $d) {
        $array = $d;
        //                    print_r($print_data);

        echo "<tr>";
        foreach ($array as $p) {
          $print_data = $p;

          echo "<td class='p-2'>";
          echo "$print_data";
          echo "</td>";
        }
        echo "</tr>";
      }
      echo "</tbody></table></div>";
    } elseif ($table_name == "Clients") {
      $sql3 = client_sorter($from_sort, $to_sort);
      $result3 = mysqli_query($conn, $sql3);
      $data3 = mysqli_fetch_all($result3);

      //  echo "<hr>";
      echo "<p class='shadow-sm p-3 m-0 bg-light lead h1' align='center'>Client Reports</p>";

      echo "<div class='setborder'><table class='overflow-auto bg-light'>
           <thead>
           <tr>
       <th scope='col'>Company</th>
       <th scope='col'>Address</th>
       <th scope='col'>City</th>
       <th scope='col'>Mobile No</th>
       <th scope='col'>GST No.</th>
           </tr>
           </thead>
           <tbody class='overflow-auto'>";
      foreach ($data3 as $d) {
        $array = $d;
        //                    print_r($print_data);

        echo "<tr>";
        foreach ($array as $p) {
          $print_data = $p;

          echo "<td class='p-2'>";
          echo "$print_data";
          echo "</td>";
        }
        echo "</tr>";
      }
      echo "</tbody></table></div>";
    } elseif ($table_name == "Reading Report") {

      $sql3 = truck_reading_sorter($from_sort, $to_sort, $company);
      $result3 = mysqli_query($conn, $sql3);
      $data3 = mysqli_fetch_all($result3);

      // echo "<hr>";

      echo "<p class='shadow-sm p-3 m-0 bg-light lead h1' align='center'>Diesel Reports</p>";

      echo "<div class='setborder'><table class='overflow-auto bg-light'>
      <thead>
      <tr>
      <th scope='col'>Company</th>
      <th scope='col'>Challan No</th>
      <th scope='col'>Date</th>
      <th scope='col'>Material</th>
      <th scope='col'>Quantity</th>
      <th scope='col'>Unit</th>
      <th scope='col'>Vehicle No</th>
      <th scope='col'>Driver Name</th>
      <th scope='col'>Truck Reading</th>
  </tr>
  </thead>
  <tbody class='overflow-auto'>";
      foreach ($data3 as $d) {
        $array = $d;
        //                    print_r($print_data);

        echo "<tr>";

        foreach ($array as $p) {
          $print_data = $p;

          echo "<td class='p-2'>";
          echo "$print_data";
          echo "</td>";
        }
        echo "</tr>";
      }
      echo "</tbody></table></div>";
    }
  }

  mysqli_close($conn);

  ?>
  <br><br><br>

  <!-- include footer -->
  <?php require("footer.php"); ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
