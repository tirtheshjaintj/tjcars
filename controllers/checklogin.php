<?php
session_start();

if(!(isset($_SESSION['id']) && isset($_SESSION['email']) && isset($_SESSION['type']) && $_SESSION['type']=="agency")){
    header("Location: /tjcars");
}
?>