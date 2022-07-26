<?php
include 'connection.php';
include('phpqrcode/qrlib.php'); 
SESSION_START();
SESSION_DESTROY();
header("location:login.php");
?>