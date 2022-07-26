<?php
include 'connection.php';
$id=$_GET['id'];
$result = mysqli_query($connection,"Update login set status='deactive' where user_id=$id");
header("Location:prouserdetails.php");
?>