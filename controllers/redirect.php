<?php
session_start();
if(isset($_SESSION['id']) && $_SESSION['type']=='user'){
  header("Location: /tjcars");
}
if(isset($_SESSION['id']) && $_SESSION['type']=='agency'){
  header("Location: /tjcars/views/agency.php");
}
?>