<?php
include("conn.php");

session_start();
if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
} else {
    $user_email="no email";
}

$sql="UPDATE users SET 
user_password='{$_POST['confirm_new_pass']}'
WHERE user_email='$user_email'";

if(mysqli_query($con,$sql)){
    mysqli_close($con);
    echo "<script>window.location.href='edit.php';</script>";
}
else{
    echo mysqli_error($con);
    echo "System couldn't change your password.";
}
?>
