<?php
include("conn.php");


if (isset($_FILES['images']) && !empty($_FILES['images']['name'])) {
    include("upload.php");
}

$sql = "UPDATE posts SET
    post='{$_POST['post_content']}'"; 

if (!empty($_FILES['images']['name'])) {
    $image_path = 'uploads/' . $_FILES['images']['name'];
    $sql .= ", images='{$image_path}'";
}

$sql .= " WHERE post_id='$_POST[post_id]'";

if(mysqli_query($con,$sql)){
    mysqli_close($con);
    echo "<script>window.location.href='php_user_profile.php';</script>";
}
else{
    echo "System couldn't update your details.";
    echo mysqli_error($con);
}
?>
