<!DOCTYPE html>
<html>

<head>
    <title>Get Material</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./bg-style.css">
    <?php

    require("crusher.php");
    require("conn.php");
    $gt=$_SESSION['grn_no'];
    $query = "SELECT material FROM grn_material WHERE grn_no='$gt'";
    $result = mysqli_query($conn, $query);
    $options = mysqli_fetch_all($result);
    // echo $_SESSION['grn_no'];
    if (isset($_POST['add'])) {

        if (isset($_SESSION['issue_no'])) {

            // echo $_SESSION['grn_no'];
            $grn_no = $_SESSION['grn_no'];
            $issue_no = $_SESSION['issue_no'];
            $username = $_SESSION['username'];


            $material = mysqli_real_escape_string($conn, $_POST['material']);


            $check_dup_material="SELECT material FROM issue_note_material WHERE material='$material' AND issue_no=$issue_no";
            $dup=mysqli_query($conn, $check_dup_material);

            if(mysqli_num_rows($dup)){
                echo "<div class='alert alert-warning'>
                <div class='container'>Material Is Already Added..<br> Not Added...<br></div></div>";
            }
            else{

            $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);

            $unit = mysqli_real_escape_string($conn, $_POST['unit']);

            $check_material = "SELECT quantity FROM grn_material WHERE grn_no=$grn_no AND material='$material' AND quantity>$quantity";

            $check_result = mysqli_query($conn, $check_material);

            if (mysqli_num_rows($check_result)) {
                $data = mysqli_fetch_all($check_result);
                $grn_qty = 0;
                foreach ($data as $d) {
                    $grn_qty = $d[0];
                }
                // echo $grn_qty;
                $grn_quantity = $grn_qty;
                $new_grn_quantity = $grn_quantity - $quantity;

                $update_material_quantity = "UPDATE grn_material SET quantity=$new_grn_quantity WHERE grn_no=$grn_no AND material='$material'";
                if (mysqli_query($conn, $update_material_quantity)) {
                    $insert_data = "INSERT INTO issue_note_material(issue_no,material,quantity,unit,username) VALUES($issue_no,'$material',$quantity,'$unit','$username')";
                    if (mysqli_query($conn, $insert_data)) {
                        echo "<div class='alert alert-success'>
                        <div class='container'>Successfully Added You Can Add More...<br></div></div>";
                    }
                    else{
                        echo "<script>alert('Failed...');window.location:'issue_note.php';</script>";        
                    }
                }
            } else {
                mysqli_close($conn);
                echo "<script>alert('Please Check Material Details Failed...');window.location:'issue_note.php';</script>";
            }
        }
    }
    }

    ?>
</head>

<body style="background-color: #E8DAEF">

    <!-- include navbar -->
    <?php require("navbar.php"); ?>


    <div class="container shadow p-5 mb-4 bg-light">
        <div class="h1 text-center">Add Material</div>
        <hr class="mt-0 mb-4">

        <form action="" method="post">
            <div class="form-row">

            <div class="form-group col-sm-4">
                    <label for="selectMaterial">Material </label>
                    <select name="material" class="form-control" id="selectMaterial">
                        <?php
                        $ct = 1;
                        for ($i = 0; $i < $ct; $i++) {
                            foreach ($options as $ops) {
                                $d = $ops;
                                $ct = count($ops);
                                echo "<option> $d[$i]</option>";
                            }
                        }
                        // mysqli_close($conn);
                        ?>

                    </select>
                </div>

                <div class="form-group col-sm-4">
                    <label for="inputQuantity">Quantity</label>
                    <input type="number" name="quantity" class="form-control" id="inputQuantity" placeholder="Number">
                </div>

                <div class="form-group col-sm-4">
                    <label for="inputUnit">Unit</label>
                    <input type="text" name="unit" class="form-control" id="inputUnit" placeholder="Brass">
                </div>

                <div class="form-group col-sm-12 text-center">
                    <button type="submit" class="btn btn-outline-primary col-sm-2" name="add">Add</button>

                </div>

            </div>

        </form>

        <!-- For Finishing Order -->
        <center>
            <form action="" method="post" class="form-row col-sm-3">

                <button class="btn btn-outline-danger my-2 form-control" name="done" type="submit">Done</button>

            </form>
        </center>

        <?php

        if (isset($_POST['done'])) {
            unset($_SESSION['grn_no']);
            unset($_SESSION['issue_no']);
            echo "<script>alert('Successfully Done...'); window.location='issue_note.php';</script>";
        }
        // mysqli_close($conn);

        ?>
    </div>

    <!-- include footer -->
    <?php require("footer.php"); ?>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>