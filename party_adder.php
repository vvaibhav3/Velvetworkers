<?php

require("conn.php");
if(isset($_POST['add_party']))
{
    $company_name=mysqli_real_escape_string($conn, $_POST['company_name']);
    
    $address=mysqli_real_escape_string($conn, $_POST['address']);
    $city=mysqli_real_escape_string($conn, $_POST['city']);
    
    $gst_no=mysqli_real_escape_string($conn, $_POST['gst_no']);
    
    $mobile_no=mysqli_real_escape_string($conn, $_POST['mobile_no']);
    
    $sql="SELECT company FROM party_details WHERE company= '$company_name' LIMIT 1";
    
    $result= mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($result)){
        
            echo "<script> alert('";
            echo " Already Available";
            echo "')</script>";
    }else{
        
        $data= "INSERT INTO party_details(company,address,city,gst_no,mobile_no) VALUES('$company_name','$address', '$city', $gst_no,$mobile_no)";
        
        mysqli_query($conn, $data);
        
            echo "<script> alert('";
            echo " Company Added";
            echo "')</script>";
    }
    
}
    
    
?>

<?php
    
     $sql3="SELECT * FROM party_details";
    $result3=mysqli_query($conn,$sql3);
    $data3=mysqli_fetch_all($result3);
    
        echo "<hr><div id='t'>";
echo"<table width=100% color='white' border=2><tr><th>Id</th><th>Company</th><th>Address</th><th>City</th><th>GST_No</th><th>Mobile_No</th></tr>";
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
         echo "</table></div>";    
         mysqli_close($conn);   
?>