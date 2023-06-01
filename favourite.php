<?php
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $parent_post_id = $_POST['parent_post_id'];
    $user_email=$_POST['user_email'];
    $date = date('Y-m-d H:i:s');
    $sql2="SELECT * FROM favourite WHERE user_email='$user_email'";
    $result2 = mysqli_query($con, $sql2);
    $parent_post_ids=array();
    while($row=mysqli_fetch_assoc($result2)){
        $parent_post_ids[]=$row['parent_post_id'];
    }
    if (isset($_POST['parent_post_id'])) {
        if (in_array($parent_post_id,$parent_post_ids)){
            header("Location: main_page.php");
            exit();
        }
        else{

        $sql = "INSERT INTO favourite(parent_post_id,user_email,date) 
        VALUES ('$parent_post_id','$user_email','$date')";

        $result = mysqli_query($con, $sql);

        if (! $result) {
            $result = mysqli_error($con);
        }
        else {

            header("Location: main_page.php");
            echo '<script>
            window.history.back();
            </script>';
        }}
    }
}
mysqli_close($con);
?>