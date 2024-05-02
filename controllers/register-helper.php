<?php
session_start();
require "../config/connection.php";
if(isset($_POST['email']) && isset($_POST['password'])){
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));
    $name = htmlspecialchars(trim($_POST['name']));
    $type = htmlspecialchars(trim($_POST['type']));
    $hpass=password_hash($password,PASSWORD_DEFAULT);
   if(filter_var($email, FILTER_VALIDATE_EMAIL) && ($type=='user' || $type=='agency')){
    $query="SELECT * from users where email='$email'";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0){
        echo "0";
    }
    else{
        $query="INSERT INTO `users`(`name`, `password`, `type`, `email`) 
        VALUES ('$name','$hpass','$type','$email')";
        $result=mysqli_query($conn,$query);
        if($result){
        $_SESSION['id']=mysqli_insert_id($conn);
        $_SESSION['email']=$email;
        $_SESSION['type']=$type;
        echo "1";
       }
    }
}
else{
    echo "0";
}
}
?>