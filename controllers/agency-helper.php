<?php
session_start();
require "../config/connection.php";
if(!isset($_SESSION['id']) && $_SESSION['type']!='agency'){
die(0);
}
$id=$_SESSION['id'];

if(isset($_POST['action']) && $_POST['action']=='addcar' && isset($_POST['vehicle_no']) && isset($_POST['model']) && isset($_POST['seating']) && isset($_POST['price']) && is_numeric($_POST['seating']) && is_numeric($_POST['price']) ){
    $vehicle_no = $_POST['vehicle_no'];
    $model = $_POST['model'];
    $seating = $_POST['seating'];
    $price = $_POST['price'];
    $agency_id=$_SESSION['id'];
    $query="SELECT * from cars where vehicle_no='$vehicle_no'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        echo "0";
    }
    else{
    date_default_timezone_set('Asia/Kolkata');
    $currentDateTime = new DateTime();
    $formattedDateTime = $currentDateTime->format('Y-m-d H:i:s');
    $query="INSERT INTO `cars`(`model`, `vehicle_no`, `agency_id`, `seating`, `price`, `date_time`) 
    VALUES ('$model','$vehicle_no','$agency_id','$seating','$price','$formattedDateTime')";
    $result=mysqli_query($conn,$query);  
    echo "1";
    }
}

if(isset($_POST['action']) && $_POST['action']=='editcar' && isset($_POST['vehicle_no']) && isset($_POST['model']) && isset($_POST['seating']) && isset($_POST['price']) && is_numeric($_POST['seating']) && is_numeric($_POST['price']) ){
    $vehicle_no = $_POST['vehicle_no'];
    $model = $_POST['model'];
    $seating = $_POST['seating'];
    $price = $_POST['price'];
    $agency_id = $_SESSION['id'];
    $car_id = base64_decode($_POST['car_id']);
    // Check if the vehicle number is already associated with another car (excluding the current one being edited)
    $query = "SELECT * FROM cars WHERE vehicle_no='$vehicle_no' AND id != $car_id";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        echo "0"; // Vehicle number already exists
    } else {
        // Update the car details
        date_default_timezone_set('Asia/Kolkata');
        $formattedDateTime = date('Y-m-d H:i:s');
        $query = "UPDATE `cars` SET `model`='$model', `vehicle_no`='$vehicle_no', `seating`='$seating', `price`='$price', `date_time`='$formattedDateTime' WHERE `id`='$car_id' AND `agency_id`='$agency_id'";
        $result = mysqli_query($conn, $query);
        if($result) {
            echo "1"; // Car details updated successfully
        } else {
            echo "0"; // Error updating car details
        }
    }
}

if(isset($_POST['action']) && $_POST['action']=='getcars'){
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
                               <a href="#" class="btn btn-danger remove" data-carid="<?=base64_encode($row['id'])?>"><i class="fa fa-trash" aria-hidden="true"></i> Remove</a>
                           </div>
                       </div>
                   </div>
   <?php }}
   else{
   ?>
   <h3>Sorry No Cars <i class="fa fa-car"></i> are registered</h3>
   <?php }
}

if(isset($_POST['action']) && $_POST['action']=='removecar' && isset($_POST['car_id'])){
    $_POST['car_id'];
    $car_id=base64_decode($_POST['car_id']);
    $query="DELETE FROM `cars` WHERE agency_id='$id' and id='$car_id'";
    $result=mysqli_query($conn,$query);
    if($result){
    echo "1";
    }
    else{
        echo "0";
    }
}
?>