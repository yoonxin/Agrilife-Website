<?php
include("conn.php");

include ("session.php");
if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
} else {
    $user_email="no email";
}


$post_id=$_GET['post_id'];
$result3=mysqli_query($con,"DELETE FROM favourite WHERE parent_post_id='$post_id' AND user_email='$user_email'");

mysqli_close($con);

echo '<script> window.history.back ()</script>';
?>