<!DOCTYPE html>
<html>

<head>
  <?php
  require("crusher.php");
  ?>
  <title> Good Reciept Note</title>
  <style type="text/css">

  </style>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <link rel="stylesheet" href="./bg-style.css">
</head>

<body>


  <!-- include navbar -->
  <?php require("navbar.php"); ?>

  <div class="container shadow p-5 mb-4 bg-light d-print-none">

    <form action="process_grn_data.php" method="post">
      <p class="h2 mb-0 ml-3">Good Reciept Note</p>
      <hr class="mb-3 mt-0">
      <div class="form-row">
        <div class="form-group col-sm-4">
          <label for="inputGRN">GRN No </label>
          <input type="number" name="grn_no" class="form-control" id="inputGRN" placeholder="1123" required>
        </div>

        <div class="form-group col-sm-4">
          <label for="inputGRNDate">GRN Date</label>
          <input type="date" name="grn_date" class="form-control" id="inputGRNDate" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-sm-4">
          <label for="inputSupplierName">Supplier Name </label>
          <input type="text" name="supplier_name" class="form-control" id="inputSupplierName" placeholder="Supplier Name" required>
        </div>

        <div class="form-group col-sm-4">
          <label for="inputSupplierAddress">Supplier Address</label>
          <input type="text" name="supplier_address" class="form-control" id="inputSupplierAddress" placeholder="1234 Main Biulding, Pune ,40014 " required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-sm-4">
          <label for="inputSchNo">Supplier Challan No </label>
          <input type="number" name="supplier_challan_no" class="form-control" id="inputSchNo" placeholder="1123" required>
        </div>

        <div class="form-group col-sm-4">
          <label for="inputSchDate">Supplier Challan Date</label>
          <input type="date" name="sch_date" class="form-control" id="inputSchDate" required>
        </div>
      </div>

      <div class="form-row">
        <div class="form-group col-sm-4">
          <label for="inputSbNo">Supplier Bill No </label>
          <input type="number" name="supplier_bill_no" class="form-control" id="inputSbNo" placeholder="1123" value=0000>
        </div>

        <div class="form-group col-sm-4">
          <label for="inputSbDate">Supplier Bill Date</label>
          <input type="date" name="sb_date" class="form-control" id="inputSbDate" required>
        </div>
      </div>

      <!-- <div class="form-row">
        <div class="form-group col-sm-4">
          <label for="inputMaterial">Material</label>
          <input type="text" name="material" class="form-control" id="inputMaterial" placeholder="material" required>
        </div>

        <div class="form-group col-sm-2">
          <label for="inputQty">Quantity </label>
          <input type="number" name="quantity" class="form-control" id="inputQty" placeholder="100" required>
        </div>

        <div class="form-group col-sm-2">
          <label for="inputUnit">Unit</label>
          <input type="text" name="unit" class="form-control" id="inputUnit" placeholder="ltr/kg/brass">
        </div> -->

        <div class="form-group col-sm-8 my-2 text-center">
          <button type="submit" class="btn btn-outline-primary col-sm-2" name="get_grn_data">Submit</button>
        </div>
      </div>

    </form>
  </div>

  <center>
    <iframe src="display_grn_data.php" class="shadow" width="100%" height="400" frameBorder="0"></iframe>
  </center>
  <!-- include footer -->
  <?php require("footer.php"); ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>