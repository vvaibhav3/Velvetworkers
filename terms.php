<!DOCTYPE html>
<html>

<head>
    <?php

    require("crusher.php");
    ?>
    <title>TERMS AND CONDITION</title>
    <style type="text/css">

    </style>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>

    <div class="container p-5">
        <form action="" method="post">
            <div class="form-group" align="center">
                <label for="textarea" class="h5">TERMS AND CONDITIONS</label>
                <textarea name="terms" class="form-control p-4" id="textarea" rows="15">
1.taxes - quoted rate's are without GST it will be charged extra on invoice amount 5% extra .
2.royalty - quoted rate's are with royalty .
3.quotation validity - 30 days .
4.delivery - as per schedule mention / given by customer .  
5.material supplying vehicle diesel issued by the purchase party and diesel amount should be deducted monthly in our sales bills .
6.material will be supplied after purchase order and purchase agreement only .
7.if there is technical problem in our crusher or natural problem will be occured and we can't supply materials (aggregate) to your
company in that case we are not liable for any penalty claim or any judical terms .
8.subject to solapur jurisdiction .

        </textarea>
            </div>

            <div class="form-group" align="center">
                <!-- <input type="number" name="sales_order_no" class="form-control col-sm-4 ml-4" placeholder=" Enter Sales Order No" required> -->
                <button type="submit" class="btn btn-primary " name="confirm">Confirm </button>
            </div>
        </form>
    </div>


    <?php

    if (isset($_POST['confirm'])) {

        require("conn.php");
        $terms = mysqli_real_escape_string($conn, $_POST['terms']);
        $get_data = "SELECT sales_order_no FROM sales_order1 ORDER BY sales_order_no DESC LIMIT 1";
        $get_result = mysqli_query($conn, $get_data);

        $s_no = mysqli_fetch_all($get_result);

        foreach ($s_no as $sn) {
            $sdata = $sn[0];
        }
        $sales_order_no = $sdata;

        $insert_data = "INSERT INTO terms(sales_order_no,t_and_c) VALUES($sales_order_no+1,'$terms')";

        if (mysqli_query($conn, $insert_data)) {
            mysqli_close($conn);
    echo "<script>alert('Terms And Conditions Added......');
	window.location='sales_order.php';</script>";
        } else {
            mysqli_close($conn);
            echo "<script>alert('Failed......');</script>";
        }
    }

    ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>