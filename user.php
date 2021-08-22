<!DOCTYPE html>
<html>

<head>
    <?php

require("highLevel.php");
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
<?php require("navbar.php");?>
    <div class="container py-5">
        
    <div class="data row">
        <a href="check_mobile.php" class="text-white col-sm-auto">
            <div class="menu">
                Add User
            </div>
        </a>

        <a href="forgotten_password.php" class="text-white col-sm-auto">
            <div class="menu">
                New Password
            </div>
        </a>
        </div>



    </div>
    </div>
    <br>

    <!-- include footer -->
    <?php require("footer.php"); ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>