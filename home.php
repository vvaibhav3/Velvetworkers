<!DOCTYPE html>
<html>

<head>
    <?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('location: logout.php');
    }
    ?>
    <title>Home</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style type="text/css">
        .data {
            /*padding: 70px;*/
            font-family: 'Open Sans', sans-serif;
            text-align: center;
            /* font-family: sans-serif; */
            font-size: 25px;
            font-style: bold;

        }

        .menu {
            color: white;
            padding: 40px;
            margin: 2px;
            width: 280px;
            display: inline-block;
            /* border-bottom: 2px solid black; */
            box-shadow: 2px 2px 2px #3b6978;
            background-color: #6a00f4;
            text-transform: capitalize;
            border-radius: 3px;
        }

        .menu:hover {
            /* color: #F4D03F; */
            padding: 38px;
            /* background-color: #8900f2; */
            box-shadow: 3px 3px 3px #3b6978;
            border-bottom: 5px solid #72efdd;
        }

        body {
            background-image: url("./images/team1.jpg");
            background-attachment: fixed;
            background-size: cover;
            background-color: white;
        }
    </style>

</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-dark" style="background-image:linear-gradient(to right,#72efdd,#6a00f4);">

        <div class="container">

            <a class="navbar-brand" href="#" style="color:#EEEEEE;">
                <h1><img src="./images/tire.svg" width="50" height="50" class="d-inline-block align-top" alt="menubar">
                    SCC</h1>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto mt-2 ">
                    <li class="nav-item">
                        <h3>

                            <a class="nav-link" href="home.php">Home</a>
                        </h3>
                    </li>

                    <li class="nav-item dropdown">
                        <h3>
                            <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <img src="./images/print (2).svg" width="25" height="25" class="d-inline-block align-top ml-2" alt="menubar"> -->
                                Print Menu
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink" style="background-color: #6930c3;">
                                <a class="dropdown-item text-light" href="./print/sales_printer.php">Sales Order Prints</a>
                                <a class="dropdown-item text-light" href="./print/material_printer.php">Material Challan Prints</a>
                                <a class="dropdown-item text-light" href="./print/invoice_printer.php">Invoice Prints</a>
                                <a class="dropdown-item text-light" href="./print/grn_printer.php">GRN Prints</a>
                                <a class="dropdown-item text-light" href="./print/issue_note_printer.php">Issue Note Prints</a>
                        </h3>
                    </li>

                </ul>
                <!-- 
                <form class="form-inline " action="create_account.php" method="get">
                    <button type="submit" class="btn btn-warning" name="logout">
                        <b style="color: white;">Log Out</b>
                        <img src="./images/next (3).svg" width="17" height="17" class="d-inline-block mb-1 ml-1" alt="">
                    </button>
                </form> -->
                <form class="form-inline " action="logout.php" method="get">
                    <button type="submit" class="btn btn-warning" name="logout">
                        <b style="color: white;">Log Out</b>
                        <img src="./images/next (3).svg" width="17" height="17" class="d-inline-block mb-1 ml-1" alt="">
                    </button>
                </form>

            </div>
    </nav>

    <div class="jumbotron p-0 py-2">
        <div class="container">
            <p class="lead">Welcome , <?php echo $_SESSION['username']; ?></p>
        </div>
    </div>

    <div class="container py-3">
        <p class="lead">
            <div class="display-4 ml-5" style="color: #6a00f4;">
                <img src="./images/next (4).svg" width="45" height="45" class="ml-2 d-inline-block" alt="menubar">
                MENU
            </div>
        </p>
        <hr class="mt-0 mb-5">
        <div class="data row">
            <a href="add_data.php" class="text-white col-sm-auto">
                <div class="menu">
                    <img src="./images/database (3).svg" width="30" height="30" class="d-inline-block align-top" alt="">
                    Master
                </div>
            </a>

            <a href="sales_order.php" class="text-white col-sm-auto">
                <div class="menu">
                    <img src="./images/percent (3).svg" width="28" height="28" class="d-inline-block mb-2" alt="">
                    Sales Order
                </div>
            </a>

            <a href="material_challan.php" class="text-white col-sm-auto">
                <div class="menu">
                    <img src="./images/money (4).svg" width="32" height="32" class="d-inline-block mb-2" alt="">
                    Challan
                </div>
            </a>
        </div>

        <div class="data row mt-2">

            <a href="invoice.php" class="text-white col-sm-auto">
                <div class="menu">
                    <img src="./images/bill (5).svg" width="28" height="28" class="d-inline-block mb-2" alt="">
                    Invoice
                </div>
            </a>

            <a href="grn.php" class="text-white col-md-auto">
                <div class="menu">
                    <img src="./images/poll (1).svg" width="28" height="28" class="d-inline-block mb-2" alt="">
                    GRN
                </div>
            </a>

            <a href="issue_note.php" class="text-white col-sm-auto">
                <div class="menu">
                    <img src="./images/poll (1).svg" width="28" height="28" class="d-inline-block mb-2" alt="">
                    Issue Note
                </div>
            </a>
        </div>

        <div class="data row mt-2">

            <a href="reports.php" class="text-white col-sm-auto">
                <div class="menu">
                    <img src="./images/edit (1).svg" width="28" height="28" class="d-inline-block mb-2" alt="">
                    Reports
                </div>
            </a>


            <a href="delete_order.php" class="text-white col-sm-auto">
                <div class="menu">
                    <img src="./images/delete (1).svg" width="28" height="28" class="d-inline-block mb-2" alt="">
                    Delete Order
                </div>
            </a>


            <a href="delete_material_challan.php" class="text-white col-sm-auto">
                <div class="menu">
                    <img src="./images/delete (1).svg" width="28" height="28" class="d-inline-block mb-2" alt="">
                    Delete Challan
                </div>
            </a>

        </div>
        <div class="data row mt-2">
            <a href="delete_invoice.php" class="text-white col-sm-auto">
                <div class="menu">
                    <img src="./images/delete (1).svg" width="28" height="28" class="d-inline-block mb-2" alt="">
                    Delete Invoice
                </div>
            </a>
    
            <a href="delete_client.php" class="text-white col-sm-auto">
                <div class="menu">
                    <img src="./images/delete (1).svg" width="28" height="28" class="d-inline-block mb-2" alt="">
                    Delete Client
                </div>
            </a>

            <a href="user.php" class="text-white col-sm-auto">
                <div class="menu">
                <img src="./images/user.svg" width="28" height="35" class="d-inline-block mb-2" alt="">
                    Mange Users
                </div>
            </a>

        </div>



    </div>
    </div>



    <!-- include footer -->
    <?php require("footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>