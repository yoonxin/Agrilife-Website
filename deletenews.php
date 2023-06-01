<?php 
include("conn.php");

    $id = intval($_GET['id']);
    $delete = "DELETE FROM news WHERE news_id = $id";
    $result = mysqli_query($con,$delete);
    if (mysqli_query($con, $result)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
    mysqli_close($con);
    header('Location: admin_page.php');

?>