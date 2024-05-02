<?php 
session_start();
require "config/connection.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tirthesh Jain Cars</title>
    <?php require 'components/bootstrap.php';?>
    <link rel="stylesheet" href="css/card.css">
</head>
<body>
<?php include "components/navbar.php"; ?>
<div class="container pt-5 mt-5">
<h1>Available Cars To Rent</h1>
</div>
<div class="container mt-5">
            <div class="row" id="all_cars">
                <?php
 $id=$_SESSION['id'];
 $query="SELECT * FROM `cars` order by date_time desc";
 $result=mysqli_query($conn,$query);
  if(mysqli_num_rows($result)>0){
  while($row=mysqli_fetch_assoc($result)){
?>
                <div class="col-md-4 col-sm-6">
                    <div class="card mb-4">
                        <img src="https://static.vecteezy.com/system/resources/thumbnails/006/428/439/small_2x/flat-yellow-sport-car-with-isolated-white-background-modern-car-design-free-vector.jpg"
                            class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Vehicle Model: <?=$row['model']?></h5>
                            <h5 class="card-title">Seating Capacity: <?=$row['seating']?></h5>
                            <h5 class="card-title">Rent Per Day: ₹<?=$row['price']?></h5>
                            <div class="d-flex justify-content-end">
                        <?php if(!isset($_SESSION['id'])){ ?>
                            <a href="/tjcars/views/login.php" class="btn btn-primary">Rent Car <i class="fa fa-car" aria-hidden="true"></i></a>
                        <?php } ?>
                        <?php if(isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type']=='user'){ ?>
                            <button class="btn btn-primary book" data-bs-toggle="modal" data-bs-target="#exampleModal" data-carid="<?=base64_encode($row['id'])?>">Rent Car <i class="fa fa-car" aria-hidden="true"></i></button>
                        <?php } ?>
                        <?php if(isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type']=='agency'){ ?>
                            <button href="#" class="btn btn-primary" disabled>Rent Car <i class="fa fa-car" aria-hidden="true"></i></button>
                        <?php } ?>
                        </div>
                        </div>
                    </div>
                </div>
                <?php }}
else{
?>
                <h3>Sorry No Cars <i class="fa fa-car"></i> are Available</h3>
<?php } ?>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php if(isset($_SESSION['id']) && isset($_SESSION['type']) && $_SESSION['type']=='user'){ ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span class="fw-bold mb-0">Book Your Car <i
                                class="fa fa-car"></i></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="booking_form">
                    <div class="modal-body">
                        <div class="d-flex align-items-center mb-3 pb-1">
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" id="model" minlength="4" maxlength="15" name="model" class="form-control"
                                placeholder="Alto" required>
                            <label for="floatingInput">Sarting Date</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" id="days" min="1" max="10" name="days" class="form-control"
                                placeholder="Booking Days" required>
                            <label for="floatingInput">Booking Days</label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary d-none" id="close_modal1"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Car <i class="fa fa-plus"
                                aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php } ?>
    <script src="../scripts/booking.js"></script>
</body>
</html>