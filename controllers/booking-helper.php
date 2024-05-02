<?php
session_start();
require "../config/connection.php";
if(!isset($_SESSION['id'])){
die(0);
}
$id=$_SESSION['id'];
