<?php
    require("crusher.php");
    $username=$_SESSION['username'];
    require("conn.php");

    if(isset($_POST['submit'])){

	$company_name=mysqli_real_escape_string($conn, $_POST['company']);

    $_SESSION['company']=$company_name;

    //$customer_name=mysqli_real_escape_string($conn,$_POST['customer']);

   // $sales_order_no=mysqli_real_escape_string($conn, $_POST['sales_order_no']);


    $address=mysqli_real_escape_string($conn, $_POST['address']);

    $city=mysqli_real_escape_string($conn, $_POST['city']);

    $site_name=mysqli_real_escape_string($conn, $_POST['site_name']);

    $date=mysqli_real_escape_string($conn, $_POST['date']);

    $payment_terms=mysqli_real_escape_string($conn, $_POST['payment_terms']);

    // $sql1="SELECT sales_order_no FROM sales_order1 WHERE sales_order_no=$sales_order_no LIMIT 1";
    
    // $result1=mysqli_query($conn, $sql1);
    
    // if(mysqli_num_rows($result1))
    // {       
    //         mysqli_close($conn);
    //         echo "<script> alert('Sales Order No is Duplicate Failed.....');";
    //         echo "window.location='sales_order.php'";
    //         echo "</script>";

    // }
    // else{
    
    


    $insert="INSERT INTO sales_order1(company,address,city,site_name,date,payment_terms,username) VALUES('$company_name','$address','$city','$site_name','$date','$payment_terms','$username')";
    
    if(mysqli_query($conn, $insert))
    {        
        
            $sql_set_no="UPDATE sr_no SET sales_order_no=sales_order_no+1"; 

            mysqli_query($conn,$sql_set_no);

            $get_data="SELECT sales_order_no FROM sales_order1 ORDER BY sales_order_no DESC LIMIT 1";
            $get_result=mysqli_query($conn,$get_data);

			$s_no=mysqli_fetch_all($get_result);

			foreach($s_no as $sn){
				$sdata=$sn[0];
			}
            $_SESSION['sales_order_no']=$sdata;
            
            $check_terms="SELECT * FROM terms WHERE sales_order_no=$sdata";
            $get_result=mysqli_query($conn,$check_terms);
            $ab=mysqli_num_rows($get_result);
            if($ab==0){
                
                $insert_data="INSERT INTO terms(sales_order_no) VALUES($sdata)";
                mysqli_query($conn,$insert_data);
                    
                    //  echo "<script>alert('$sdata AND $ab');</script>";
                // }
            }
            mysqli_close($conn);

            echo "<script>";
            echo "window.location='get_sales_order_material.php'";
            echo "</script>";
    }
 //}
 
}else{
    mysqli_close($conn);
    echo "<script>alert('failed......');
    window.location='sales_order.php';</script>";
}

?>