<?php
include 'connection.php';
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
SESSION_START();
if(!isset($_SESSION['contact']))
{
   header("location:logout.php");
}
$amount=$_POST['amount'];
$orgcontact=$_SESSION['contact'];
echo $orgcontact;
$result = mysqli_query($connection,"SELECT * FROM `personal_details`,login WHERE login.user_id=personal_details.user_id and login.user_name='$orgcontact'");
$row = mysqli_fetch_array($result);
$user_id = $row['user_id'];
$email=$row['email'];
$result1= mysqli_query($connection,"SELECT * FROM `bank_account` where user_id='$user_id'");

   $sql1=mysqli_query($connection,"SELECT * FROM `wallet` WHERE user_id='$user_id'"); 
   $row3=mysqli_fetch_array($sql1);
   $balance=$row3['amount'];
  $name_error="";
  $amount=$_GET['amount'];
  $total = $balance+$amount;
  $update="UPDATE `wallet` SET `amount`='$total' WHERE `user_id`='$user_id'";
  $query = mysqli_query($connection,$update);
  if($query)
  {
    require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 
 
$mail = new PHPMailer; 
 
$mail->isSMTP();                      // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';       // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;               // Enable SMTP authentication 
$mail->Username = 'ewallet0904@gmail.com';   // SMTP username 
$mail->Password = 'jdwymqhwnurecmbl';   // SMTP password 
$mail->SMTPSecure = 'tls';            // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                    // TCP port to connect to 
 
// Sender info 
$mail->setFrom('sender@ewallet.com', 'Ewallet'); 
$mail->addReplyTo('reply@ewallet.com', 'Ewallet'); 
// Add a recipient 
$mail->addAddress($email); 
 
//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'Email from EWallet'; 
 
// Mail body content 
$bodyContent .= '<html>
<head>
<meta charset="utf-8">
</head>

<body background="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS4hVvyxHSVWVWGu8Uqq1bOi0x7KAhUG22svA&usqp=CAU" style="background-size: cover;">
    <center>
<h1 style="margin-top: 50px;">Welcome to <b style="color:crimson;">E-Wallet</b></h1>
<p>Hai,</p>
<p>Your wallet has been recharged</p>
Below given is your wallet balance <br>
<table border="1" style="margin-top:30px">
  <tr>
    <th scope="row">Mail From</th>
    <td>E-Wallet Admin</td>
  </tr>
  <tr>
    <th scope="row">Balance</th>
    <td>'.$total.'</td>
  </tr>
</table>
<div style="margin-top:30px">
</center>
</body>
</html>'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
    header("Location:wallethome.php");
} 
} else { 
    echo 'Message has been sent.'; 
    header("Location:wallethome.php");
} 


   header("Location:wallethome.php");




?>
