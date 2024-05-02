<?php    
session_start(); 
include "../config/connection.php";
if($_SESSION['id']){
  $email=$_SESSION['email'];
  $id=$_SESSION['id'];
  $type=$_SESSION['type'];
  $query="SELECT * from users where email='$email' and id='$id' and type='$type'";
  $result=mysqli_query($conn,$query);
  $user_data=mysqli_fetch_assoc($result);
}
?>
<nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" style="font-size:1.7em;font-weight:bolder;" href="/TJCars" title="Tirthesh Jain Cabs">TJ Cars <i class="fa fa-car"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/tjcars">Home</a>
                </li>
                <?php if(!isset($_SESSION['id'])){?>
                <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Login/Register
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/tjcars/views/login.php">Login</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="/tjcars/views/register_user.php">Register As User</a></li>
                        <li><a class="dropdown-item" href="/tjcars/views/register_agency.php">Register As Agency</a></li>
                    </ul>
                </li>
                <?php }else{ ?>
                  <li class="nav-item dropdown">
                    <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Welcome <?=$user_data['name']?>
                    </a>
                    <ul class="dropdown-menu">
                      <?php if($_SESSION['type']=='agency'){ ?>
                        <li><a class="dropdown-item" href="/tjcars/views/agency.php">Agency Dashboard</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <?php } ?>
                        <li><a class="dropdown-item" href="/tjcars/controllers/logout.php">Logout</a></li>
                    </ul>
                </li>
                  <?php } ?>
            </ul>
           
        </div>
    </div>
</nav>