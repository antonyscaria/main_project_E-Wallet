<?php
include 'connection.php';
$id=$_GET['id'];
$insertlog = "UPDATE `appoinment` SET `status`='deleted' WHERE appoinment_id='$id'";
$sql = mysqli_query($connection,$insertlog);
header('location:appoinmentstatus.php')
?>