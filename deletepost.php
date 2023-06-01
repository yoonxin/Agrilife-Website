<?php
session_start();

if(!isset($_SESSION["user_email"]))
{
    echo '<script>alert ("Unauthorized access!")</script>';
	header("location: admin_page.php");
}
?>

<?php 
include("conn.php");

    $id = $_GET['post_id'];

    $result2=mysqli_query($con,"DELETE FROM comment WHERE parent_comment_id='$id'");
    $result3=mysqli_query($con,"DELETE FROM favourite WHERE parent_post_id='$id'");
    $result=mysqli_query($con,"DELETE FROM posts WHERE post_id='$id'");

    mysqli_close($con);
    header('Location: admin_page.php');

?>