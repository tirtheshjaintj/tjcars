<?php
session_start();
require '../controllers/checklogin.php'; 
require "../config/connection.php";
if(!isset($_SESSION['id']) && $_SESSION['type']!='agency'){
  die(0);
}
?>

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
        <h1>Welcome To Agency DashBoard</h1>
        <div class="d-flex justify-content-end">
            <a href="/tjcars/views/bookings.php" class="btn btn-primary m-2"><i class="fa fa-eye"
                    aria-hidden="true"></i> View All Bookings</a>
            <div class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"
                    aria-hidden="true"></i> Add New Car</div>
        </div>
        <div class="container mt-2">
            <div class="row" id="my_cars">
                <?php
 $id=$_SESSION['id'];
 $query="SELECT * FROM `cars` WHERE agency_id='$id' order by date_time desc";
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
                            <h5 class="card-title">Vehicle Number: <?=$row['vehicle_no']?></h5>
                            <h5 class="card-title">Seating Capacity: <?=$row['seating']?></h5>
                            <h5 class="card-title">Rent Per Day: ₹<?=$row['price']?></h5>
                            <a href="#" class="btn btn-primary edit" 
                            data-carid="<?=base64_encode($row['id'])?>"
                            data-model="<?=$row['model']?>"
                            data-vehicle_no="<?=$row['vehicle_no']?>"
                            data-seating="<?=$row['seating']?>"
                            data-price="<?=$row['price']?>"
                            data-bs-toggle="modal" 
                            data-bs-target="#exampleModal2" data-carid="<?=base64_encode($row['id'])?>"
                            ><i
                                    class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                            <a href="#" class="btn btn-danger remove" data-carid="<?=base64_encode($row['id'])?>"><i
                                    class="fa fa-trash" aria-hidden="true"></i> Remove</a>
                        </div>
                    </div>
                </div>
                <?php }}
else{
?>
                <h3>Sorry No Cars <i class="fa fa-car"></i> are registered</h3>
                <?php } ?>

            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Button trigger modal -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span class="fw-bold mb-0">Add new Car <i
                                class="fa fa-car"></i></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="cars_form">
                    <div class="modal-body">
                        <div class="d-flex align-items-center mb-3 pb-1">
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" id="model" minlength="4" maxlength="15" name="model" class="form-control"
                                placeholder="Alto" required>
                            <label for="floatingInput">Vehicle Model</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" id="vehicle_no" name="vehicle_no" class="form-control"
                                placeholder="PB10DA1234" required>
                            <label for="floatingInput">Vehicle Number</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" id="seating" min="4" max="7" name="seating" class="form-control"
                                placeholder="Seating" required>
                            <label for="floatingInput">Seating Capacity</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" id="price" min="100" max="10000" name="price" class="form-control"
                                placeholder="Price" required>
                            <label for="floatingInput">Rate Per Day</label>
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
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><span class="fw-bold mb-0">Add new Car <i
                                class="fa fa-car"></i></span></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" id="edit_form">
                    <div class="modal-body">
                        <div class="d-flex align-items-center mb-3 pb-1">
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" id="model2" minlength="4" maxlength="15" name="model2" class="form-control"
                                placeholder="Alto" required>
                            <label for="floatingInput">Vehicle Model</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" id="vehicle_no2" name="vehicle_no2" class="form-control"
                                placeholder="PB10DA1234" required>
                            <label for="floatingInput">Vehicle Number</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" id="seating2" min="4" max="7" name="seating2" class="form-control"
                                placeholder="Seating" required>
                            <label for="floatingInput">Seating Capacity</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" id="price2" min="100" max="10000" name="price2" class="form-control"
                                placeholder="Price" required>
                            <label for="floatingInput">Rate Per Day</label>
                        </div>
                        <input type="hidden" name="car_id2" id="car_id2" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary d-none" id="close_modal2"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Car <i class="fa fa-plus"
                                aria-hidden="true"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../scripts/agency.js"></script>
</body>

</html>