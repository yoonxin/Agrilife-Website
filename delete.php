<?php
include("conn.php");
$post_id=$_GET['post_id'];
/* get post_id when user click delete at user profile */
$result=mysqli_query($con,"DELETE FROM posts WHERE post_id='$post_id'");
$result2=mysqli_query($con,"DELETE FROM comment WHERE parent_comment_id='$post_id'");
$result3=mysqli_query($con,"DELETE FROM favourite WHERE parent_post_id='$post_id'");

/**run query to delete the post and post-related data */

mysqli_close($con);

header('Location:php_user_profile.php');
/** go back to user profile */
?>