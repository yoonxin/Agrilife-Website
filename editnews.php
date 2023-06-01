<?php
date_default_timezone_set('Asia/Kuala_Lumpur');
session_start();

if(!isset($_SESSION["user_email"]))
{
    echo '<script>alert ("Unauthorized access!")</script>';
	header("location: admin_page.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Trending News</title>
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
        background-color: #7bd37b;
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
        resize: none;
        height: 145px;
        font-size: 15px;
    }

    .input-field-time {
        display: none;
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
            <?php
                    include("conn.php");
                    $news_id=$_GET['news_id'];
                    $date = date("Y-m-d h:i:sa");
                    $result=mysqli_query($con,"SELECT * FROM news WHERE news_id=$news_id");
                    while($row=mysqli_fetch_array($result))
                {
            ?>
            <form action="updatenews.php" method="post" class="content" enctype="multipart/form-data">
            <h2 class="title">Edit Trending News</h2>
                <div class="input-field">
                    <input type="text" name="news_title" placeholder="Title" value="<?php echo $row['news_title'] ?>">
                </div>
                        
                <div class="input-field">
                    <input type="file" name="images" id="images">
                </div>

                <div class="input-field-text">
                    <textarea name="news_content" placeholder="Content"><?php echo $row['news_content'] ?></textarea>
                </div>
                <input type="hidden" name="news_date" value="<?php echo $date?>">
                <input type="hidden" name="news_id" value="<?php echo $news_id ?>">
            <p><button type="submit" value="Update" class="btn2" name="btn2" >Update Trending News</button></p>
        </form>
        <?php
        }
        mysqli_close($con);
        ?>
        </div>
    </div>

</body>
</html>