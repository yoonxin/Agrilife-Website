<?php
include("conn.php");
$email=$_GET['user_email'];


$result2=mysqli_query($con,"DELETE FROM comment WHERE comment_sender_email='$email'");
$result3=mysqli_query($con,"DELETE FROM favourite WHERE user_email='$email'");
$result=mysqli_query($con,"DELETE FROM posts WHERE user_email='$email'");
$result1=mysqli_query($con,"DELETE FROM users WHERE user_email='$email'");

mysqli_close($con);
echo '<script> window.history.back ()</script>';

?>