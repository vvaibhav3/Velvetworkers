<?php

session_start();
if(!isset($_SESSION['username'])){
    header('location: index.html');   
}

require("conn.php");

if(isset($_POST['get_issue_data'])){

    $username=$_SESSION['username'];

    $issue_no=mysqli_real_escape_string($conn, $_POST['issue_no']);

    $check_duplicate_issue_no="SELECT issue_no FROM issue_note WHERE issue_no=$issue_no LIMIT 1";
    $check_result=mysqli_query($conn, $check_duplicate_issue_no);

    //check dupliaction
    if(mysqli_num_rows($check_result)){
        echo "<script> alert('Issue No. Is Duplicate Failed.....');";
        echo "window.location='issue_note.php';";
        echo "</script>";
    }
    else{

        //store into database

        $grn_no=mysqli_real_escape_string($conn, $_POST['grn_no']);

        $issue_date=mysqli_real_escape_string($conn, $_POST['issue_date']);

        $issued_to=mysqli_real_escape_string($conn, $_POST['issued_to']);

        $remark=mysqli_real_escape_string($conn, $_POST['remark']);

        // $material=mysqli_real_escape_string($conn, $_POST['material']);

        // $qty=mysqli_real_escape_string($conn, $_POST['quantity']);

        // $unit=mysqli_real_escape_string($conn, $_POST['unit']);

        //material quantity of grn with issue 
        // $get_grn_material_data="SELECT quantity FROM good_reciept_note WHERE grn_no=$grn_no AND material='$material'";
        
        // $result=mysqli_query($conn, $get_grn_material_data);

        //     $data=mysqli_fetch_all($result);

        //     $grn_qty=0;
        //     foreach($data as $d){
        //         $grn_qty=$d[0];
        //     }
        //     //echo "<script>alert('$d[0] and $d[1] ||$grn_qty and $grn_total_qty');</script>";
        //     if($grn_qty==0){
        //         echo "<script> alert('Invalid GRN No. Failed Try Again.....');";
        //         echo "window.location='issue_note.php';";
        //         echo "</script>";
        //     }
        //     else{
        //         $grn_quantity=$grn_qty;
        //     }

        //echo "<script> alert('$grn_quantity');</script>";
        
        // if($grn_quantity>0 && $grn_quantity>=$qty){
        //     $new_grn_quantity=$grn_quantity-$qty;

            // $update_material_quantity="UPDATE good_reciept_note SET quantity=$new_grn_quantity WHERE grn_no=$grn_no AND material='$material'";

            // if(mysqli_query($conn, $update_material_quantity)){

                $insert="INSERT INTO issue_note(issue_no,issue_date,grn_no,issued_to,remark,username) VALUES($issue_no,'$issue_date',$grn_no,'$issued_to','$remark','$username')";
            
                if(mysqli_query($conn, $insert)){
                    $_SESSION['issue_no']=$issue_no;
                    $_SESSION['grn_no']=$grn_no;
                    mysqli_close($conn);
                    echo "<script>";
                    echo "window.location='get_issue_note_material.php'";
                    echo "</script>";
                }else{
                    // $update_material_quantity="UPDATE good_reciept_note SET quantity=$grn_quantity WHERE grn_no=$grn_no AND material='$material'";
                    // mysqli_query($conn, $update_material_quantity);
                    mysqli_close($conn);
                    echo "<script> alert('Failed Try later.....');";
                    echo "window.location='issue_note.php';";
                    echo "</script>";
                }
            }
            // else{
            //     echo "<script> alert('Failed....');";
            //     echo "window.location='issue_note.php';";
            //     echo "</script>";
            // }
}
else{
    mysqli_close($conn);
    echo "<script>";
    echo "window.location='issue_note.php';";
    echo "</script>";
}

?>