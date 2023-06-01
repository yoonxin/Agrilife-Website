<?php
include("conn.php");
$comment_id=$_GET['comment_id'];
/* get post_id when user click delete at user profile */

$result2=mysqli_query($con,"DELETE FROM comment WHERE comment_id='$comment_id'");


/**run query to delete the post and post-related data */

mysqli_close($con);

echo '<script> window.history.back ()</script>';
/** go back to user profile */
?>