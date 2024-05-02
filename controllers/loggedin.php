<?php
session_start();
require "../config/connection.php";
require "../controllers/redirect.php";
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
   if(filter_var($email, FILTER_VALIDATE_EMAIL)){
    $query="SELECT * from users where email='$email'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)==0){
        echo "0";
    }
    else{
        $row=mysqli_fetch_assoc($result);
        if(password_verify($password,$row['password'])){
          echo "1";
          $_SESSION['id']=$row['id'];
          $_SESSION['email']=$row['email'];
          $_SESSION['type']=$row['type'];
        }
        else{
            echo "0";
        }
    }
}
else{
    echo "0";
}
}


?>