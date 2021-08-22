
<nav class="navbar navbar-expand-lg navbar-dark " style="background-image:linear-gradient(to right,#72efdd,#6a00f4);">
	<div class="container">
  <a class="navbar-brand" href="#">
    <h1><img src="./images/tire.svg" width="50" height="50" class="d-inline-block align-top" alt="menubar">
                SCC
              </h1></a>
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
          MENU
        </a>
        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink" style="background-color: #6930c3;">
          <a class="dropdown-item text-light" href="add_data.php">Master</a>
          <a class="dropdown-item text-light" href="sales_order.php">Sales Order</a>
          <a class="dropdown-item text-light" href="material_challan.php">Material Challan</a>
          <a class="dropdown-item text-light" href="grn.php">Good Reciept Note</a>
          <a class="dropdown-item text-light" href="issue_note.php">Issue Note</a>
          <a class="dropdown-item text-light" href="invoice.php">Invoice</a>
          <a class="dropdown-item text-light" href="reports.php">Reports</a>
          <a class="dropdown-item text-light" href="delete_client.php">Delete Client</a>
          <a class="dropdown-item text-light" href="delete_order.php">Delete Order</a>
          <a class="dropdown-item text-light" href="delete_material_challan.php">Delete Challan</a>
          <a class="dropdown-item text-light" href="delete_invoice.php">Delete Invoice</a>
        </div>
    	</h3>
      </li>

       <li class="nav-item dropdown">
        <h3>
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Print Menu
        </a>
        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink" style="background-color: #6930c3;">
          <a class="dropdown-item text-light" href="./print/sales_printer.php">Sales Order Prints</a>
          <a class="dropdown-item text-light" href="./print/material_printer.php">Material Challan Prints</a>
          <a class="dropdown-item text-light" href="./print/invoice_printer.php">Invoice Prints</a>
          <a class="dropdown-item text-light" href="./print/grn_printer.php">GRN Prints</a>
          <a class="dropdown-item text-light" href="./print/issue_note_printer.php">Issue Note Prints</a>
        </div>
        </h3>
      </li>

<!-- 
      <li class="nav-item dropdown">
        <h3>
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Delete Menu
        </a>
        <div class="dropdown-menu " aria-labelledby="navbarDropdownMenuLink" style="background-color: #6930c3;">
          <a class="dropdown-item text-light" href="delete_order.php">Delete Order</a>
          <a class="dropdown-item text-light" href="delete_material_challan.php">Delete Challan</a>
          <a class="dropdown-item text-light" href="delete_invoice.php">Delete Invoice</a>
        </div>
        </h3>
      </li>
       -->
     </ul>

    <form class="form-inline " action="logout.php" method="get">          
        <button type="submit" class="btn btn-warning" name="logout">
        <b style="color:white;">Log Out</b>
<img src="./images/next (3).svg" width="17" height="17" class="d-inline-block mb-1 ml-1" alt="">
        </button>
          
    <!--     <button class="btn btn-dark mx-2" onclick="print_page()">Print</button> -->
    </form>
  </div>
</div>
</nav>

<div class="jumbotron p-0 py-2 d-print-none">
      <div class="container">
      <p class="lead"> Welcome !<?php
        echo $_SESSION['username'];?></p>
      </div>
</div>