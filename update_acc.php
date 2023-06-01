<?php
include("conn.php");

session_start();
if (isset($_SESSION['user_email'])) {
    $user_email = $_SESSION['user_email'];
} else {
    $user_email="no email";
}

if (isset($_FILES['images']) && !empty($_FILES['images']['name'])) {
    include("upload.php");
}
if (isset($_FILES['background']) && !empty($_FILES['background']['name'])) {
    include("upload_background.php");
}

$sql = "UPDATE users SET
    user_name='{$_POST['username']}', 
    user_about='{$_POST['about']}',  
    user_contact_num='{$_POST['contact_number']}'";

if (!empty($_FILES['images']['name'])) {
    $image_path = 'uploads/' . $_FILES['images']['name'];
    $sql .= ", user_pic='{$image_path}'";
}
if (!empty($_FILES['background']['name'])) {
    $image_path2 = 'uploads/' . $_FILES['background']['name'];
    $sql .= ", user_background='{$image_path2}'";
}

$sql .= " WHERE user_email='$user_email'";

if(mysqli_query($con,$sql)){
    mysqli_close($con);
    echo "<script>window.location.href='edit.php';</script>";
}
else{
    echo "System couldn't update your details.";
    echo mysqli_error($con);
}
?>
