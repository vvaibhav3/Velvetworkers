<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

     <link rel="stylesheet" href="./table-style.css">
</head>
<body>

<?php
    require("crusher.php");
    require("conn.php");

    //  $sql3="SELECT id,grn_no,grn_date,supplier_challan_no,sch_date,supplier_bill_no,sb_date,supplier_name,supplier_address,material,quantity,unit FROM good_reciept_note";
     $sql3="SELECT grn_material.grn_no,grn_date,supplier_challan_no,sch_date,supplier_bill_no,sb_date,supplier_name,supplier_address,material,quantity,unit FROM grn_material INNER JOIN good_reciept_note WHERE grn_material.grn_no=good_reciept_note.grn_no AND quantity>0";
    
     $result3=mysqli_query($conn,$sql3);
     $data3=mysqli_fetch_all($result3);
    
    // echo "<hr>";
    echo"<table class='table table-bordered overflow-auto'>
        <thead class='thead-dark'>
        <tr>
            <th scope='col'>GRN No</th>
            <th scope='col'>GRN Date</th>
            <th scope='col'>Supplier Challan No</th>
            <th scope='col'>Date</th>
            <th scope='col'>Supplier Bill No</th>
            <th scope='col'>Date</th>
            <th scope='col'>Supplier Name</th>
            <th scope='col'>Supplier Address</th>
            <th scope='col'>Material</th>
            <th scope='col'>Quantity</th>
            <th scope='col'>Unit</th>
        </tr>
        </thead>
        <tbody class='overflow-auto'>";
                foreach($data3 as $d)
                {
                    $array=$d;
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
         echo "</tbody></table>";   

         mysqli_close($conn);   

        
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>