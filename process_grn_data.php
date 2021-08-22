<?php

session_start();
if(!isset($_SESSION['username'])){
    header('location: index.html');   
}

require("conn.php");

if(isset($_POST['get_grn_data'])){

    $username=$_SESSION['username'];

    $grn_no=mysqli_real_escape_string($conn, $_POST['grn_no']);

    // $material=mysqli_real_escape_string($conn, $_POST['material']);

    $check_duplicate_grn_no="SELECT grn_no FROM good_reciept_note WHERE grn_no=$grn_no LIMIT 1";
    $check_result=mysqli_query($conn, $check_duplicate_grn_no);

    //check dupliaction
    if(mysqli_num_rows($check_result)){
        echo "<script> alert('Material Is Already Present Failed.....');";
        echo "window.location='grn.php';";
        echo "</script>";
    }
    else{

        //store into database

        $grn_date=mysqli_real_escape_string($conn, $_POST['grn_date']);

        $supplier_challan_no=mysqli_real_escape_string($conn, $_POST['supplier_challan_no']);

        $sch_date=mysqli_real_escape_string($conn, $_POST['sch_date']);

        $supplier_bill_no=mysqli_real_escape_string($conn, $_POST['supplier_bill_no']);  

        $sb_date=mysqli_real_escape_string($conn, $_POST['sb_date']);

        if($sb_date<$grn_date){
            mysqli_close($conn);
            echo "<script> alert('Supplier Bill Date Is Wrong Failed.....');";
            echo "window.location='grn.php';";
            echo "</script>";   
        }

        $supplier_name=mysqli_real_escape_string($conn, $_POST['supplier_name']);

        $supplier_address=mysqli_real_escape_string($conn, $_POST['supplier_address']);

        // $qty=mysqli_real_escape_string($conn, $_POST['quantity']);

        // $unit=mysqli_real_escape_string($conn, $_POST['unit']);

        $insert="INSERT INTO good_reciept_note(grn_no,grn_date,supplier_challan_no,sch_date,supplier_bill_no,sb_date,supplier_name,supplier_address,username) VALUES($grn_no,'$grn_date',$supplier_challan_no,'$sch_date',$supplier_bill_no,'$sb_date','$supplier_name','$supplier_address','$username')";

        if(mysqli_query($conn,$insert)){
            mysqli_close($conn);
            $_SESSION['grn_no']=$grn_no;
            echo "<script> alert('Done.....');";
            echo "window.location='get_grn_material.php';";
            echo "</script>";
        }
        else{
            mysqli_close($conn);
            echo "<script> alert('Failed Try later.....');";
            echo "window.location='grn.php';";
            echo "</script>";
        }
    }

}
else{
    mysqli_close($conn);
    echo "<script>";
    echo "window.location='grn.php';";
    echo "</script>";
}

?>