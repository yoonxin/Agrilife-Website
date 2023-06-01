<?php
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['parent_comment_id']) && isset($_POST['comment_content'])) {
        $parent_comment_id = $_POST['parent_comment_id'];
        $comment_content = $_POST['comment_content'];
        $commentSenderName = $_POST['comment_sender_name'];
        $commentSenderEmail=$_POST['comment_sender_email'];
        $date = date('Y-m-d H:i:s');

        /*if form is posted, parent_cpmment_id & comment_content is set, set the elements below*/
        $sql = "INSERT INTO comment(parent_comment_id,comment_content,comment_sender_name,comment_sender_email,date) 
        VALUES ('$parent_comment_id','$comment_content','$commentSenderName','$commentSenderEmail','$date')";

        $result = mysqli_query($con, $sql);

        if (! $result) {
            $result = mysqli_error($con);
            echo $result;
        }
        else {
            echo '<script>alert("Your comment has been uploaded successfully!");
            window.history.back();
            </script>';
        }
        /* run query to insert data, if query runs successfully, bring back to the previous page */
    }
}
mysqli_close($con);
?>