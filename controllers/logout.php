<?php
session_start();
session_destroy();
    header("Location: /tjcars/views/login.php");
?>