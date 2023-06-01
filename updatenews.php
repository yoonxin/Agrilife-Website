<?php
include("conn.php");

if (isset($_FILES['images']) && !empty($_FILES['images']['name'])) {
    include("upload.php");
}

$sql = "UPDATE news SET
        news_title='{$_POST['news_title']}', 
        news_content='{$_POST['news_content']}',  
        news_date='{$_POST['news_date']}'";

if (!empty($_FILES['images']['name'])) {
    $image_path = 'uploads/' . $_FILES['images']['name'];
    $sql .= ", news_images='{$image_path}'";
}

$sql .= " WHERE news_id=$_POST[news_id]";

if(mysqli_query($con,$sql)){
    mysqli_close($con);

    echo "<script>window.location.href='admin_page.php';</script>";
}
else{
    echo "System couldn't update your details.";
    echo mysqli_error($con);
}
?>
