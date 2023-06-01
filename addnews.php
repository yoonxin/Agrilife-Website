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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["newstitle"];
    $content = $_POST["newscontent"];

    if (isset($_FILES['images']) && !empty($_FILES['images']['name'])) {
        include("upload.php");
    }

    $image_path = 'uploads/' . $_FILES['images']['name'];
    
    //if everything ok. upload to database
    $sql="INSERT INTO news (news_title, news_content,news_images)
    VALUES  ('$title', '$content', '$image_path')";
    
    if(mysqli_query($con,$sql)){
        mysqli_close($con);
    
        echo "<script>window.location.href='admin_page.php';</script>";
    }
    else{
        echo "System couldn't update your details.";
        echo mysqli_error($con);
    }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Trending News</title>
    <style>
    body {
        margin: 0px;
        padding: 0px;
    }

    #wrapper {
        width: fit-content;
        margin: 0 auto;
    }   

    .container {
        margin-top: 100px;
    }
    
    .content {
        font-family: "Bahnschrift Light";
        width: 500px;
        height: auto;
        background-color: #549171;
        padding: 10px;
        border-radius: 20px;
        border: 3px solid black;
        text-align: center;
        box-shadow: 0 4px 20px 0 rgba(0, 0, 0, 0.3), 0 6px 20px 0   rgba(0, 0, 0, 0.3);
    }    

    .input-field{
        border: 2px solid black;
        height: 30px;
        background: #d2edde;
        margin: 10px 0;
        border-radius: 18px;
        padding: 3px;
        display: flex;
        align-items: center;
    }

    .input-field-text {
        border: 2px solid black;
        height: 100%;
        background: #d2edde;
        margin: 10px 0;
        border-radius: 18px;
        padding: 3px;
        display: flex;
        align-items: center;
    }

    .input-field-text textarea {
        background: none;
        border: none;
        outline: none;
        width: 528px;
        height: 145px;
        resize: none;
        font-size: 15px;
    }

    
    .input-field input{
        flex: 5;
        background: none;
        border: none;
        outline: none;
        width: 100%;
        font-size: 18px;
        font-weight: 100;
        border-radius: 15px;
    }

    button {
        font-family: "Bahnschrift Light";
        background: none;
        background-color: #E7E6E6;
        border: none;
        border-radius: 20px;
        font-size: 25px;
        cursor: pointer;
        padding: 6px 6%;
        margin-top: 7px;
    }

    button.btn2:hover {
        background-color: black;
        color: #E7E6E6;
    }

    </style>
</head>
<body>
    <div id="wrapper">
        <div class="container">
        <form action="addnews.php" method="post" class="content" enctype="multipart/form-data">
            <h2 class="title">Add Trending News</h2>
                <div class="input-field">
                    <input type="text" name="newstitle" placeholder="Title" required/>
                </div>
                        
                <div class="input-field">
                    <input type="file" name="images" id="images">
                </div>

                <div class="input-field-text">
                    <textarea name="newscontent" placeholder="Content" required></textarea>
                </div>
                    
            <p><button type="submit" value="Signup" class="btn2" name="btn2" >Add News</button></p>
        </form>
        </div>
    </div>
</body>