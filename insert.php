<?php
    function generateIncrementId($prefix, $idType) {
        $column = $idType == 'comment' ? 'comment_id' : 'post_id';
        $lastId = getLastId($prefix, $column);
        $nextId = $lastId + 1;
        $incrementId = $prefix . str_pad($nextId, 6, "0", STR_PAD_LEFT);
        return $incrementId;
    }

    function getLastId($prefix, $column) {
        $pdo = new PDO('mysql:host=localhost;dbname=assignment', 'root', '');
        $query = "SELECT $column FROM posts WHERE $column LIKE '$prefix%' ORDER BY $column DESC LIMIT 1";
        $stmt = $pdo->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$result) {
            return 0;
        }
        $lastId = substr($result[$column], strlen($prefix));
        return intval($lastId);
    }

    session_start();
    if (isset($_SESSION['user_email'])) {
        $user_email = $_SESSION['user_email'];
    } else {
        $user_email="no email";
    }

    include("conn.php");
    $sql="SELECT * FROM users WHERE user_email = '$user_email'";
    $result = mysqli_query($con, $sql);
    while($row=mysqli_fetch_array($result)){
        $user_id=$row['id'];
        $user_name=$row['user_name'];
        $user_pic=$row['user_pic'];
        $user_background=$row['user_background'];
        $user_about=$row['user_about'];
    }

    $post_id = generateIncrementId('POST', 'post');

    date_default_timezone_set('Asia/Kuala_Lumpur');
    $post_date=date("Y-m-d h:i:sa");
    include("conn.php");
    if (isset($_FILES['images']) && !empty($_FILES['images']['name'])) {
        include("upload.php");
    }

    $image_path = 'uploads/' . $_FILES['images']['name'];

    $sql="INSERT INTO posts (post_id, user_name,user_email, user_profile, post, images, post_date)
    VALUES
    ('$post_id','$user_name','$user_email','$user_pic','$_POST[post]','$image_path','$post_date')";

    if (!mysqli_query($con,$sql)){
        die('Error: ' . mysqli_error($con));
    }
    else {
        echo '<script>alert("Your Post Has Been Uploaded!");
        window.location.href = "main_page.php";
        </script>';
    }
    mysqli_close($con);


?>