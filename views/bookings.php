<?php require '../controllers/checklogin.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TJ Cars Agency Dashboard</title>
    <?php require '../components/bootstrap.php';?>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <?php require "../components/navbar.php"; ?>
<div class="container pt-5 mt-5">
<h1>View Your Bookings <i class="fa fa-eye" aria-hidden="true"></i></h1>
<div class="d-flex justify-content-end">
    <a href="/tjcars/views/agency.php" class="btn btn-primary m-2"><i class="fa fa-plus" aria-hidden="true"></i> Add New Car Page</a>
</div>
<div class="container mt-2">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="card mb-4">
        <img src="https://static.vecteezy.com/system/resources/thumbnails/006/428/439/small_2x/flat-yellow-sport-car-with-isolated-white-background-modern-car-design-free-vector.jpg" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Vehicle Model: Alto</h5>
          <h5 class="card-title">Vehicle Number: PB10DA1860</h5>
          <h5 class="card-title">Seating Capacity: 7</h5>
          <h5 class="card-title">Rent Per Day:  ₹1000</h5>
          <a href="#" class="btn btn-success"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
          <a href="#" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
        </div>
      </div>
    </div>

</div>
</div>
    </div>
</div>
</div>
</body>

</html>