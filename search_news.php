<?php

    include ("session.php");

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

        $sql2="SELECT*FROM posts WHERE user_email='$user_email'";
        $result2=mysqli_query($con,$sql2);
        $user_post_number=$result2->num_rows;

        $sql3="SELECT*FROM favourite WHERE user_email='$user_email'";
        $result3=mysqli_query($con,$sql3);
        $user_favourite_number=$result3->num_rows
        
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="main_page_style.css">
    <style>
        .news-post{
        background: #fff;
        padding: 20px 25px 5px;
        margin: 5px 0 15px;
    }

    .news-author{
        display: flex;
        align-items: flex-start;
    }

    .news-author h1{
        font-size: 30px;
        font-weight: 800;
        color: black;
    }
    .news-author small{
        display: block;
        margin-bottom: -2px;
        font-weight: 400;
        font-size: 12px;
        color: #999;
    }

    .news-post p{
        font-size: 16px;
        font-weight: 400;
        line-height: 1.5;
        margin-bottom: 15px;
        margin-top: -15px;
        padding-bottom: 5px;
        color: #333333;
        font-family: "Open Sans", sans-serif;
    }

    .news-post img{
        margin-bottom: 20px;
    }

    </style>
</head>
<body>
<nav class="navbar">
         <div class="navbar-left">
            <a href="main_page.php" class="logo"><img src="photos/new_logo.svg"></a>

            <form id="searchForm" action="search_news.php" method="get" onsubmit="submitForm(event)">
                <div class="search_box">
                    <img src="photos/search.png">
                    <input type="text" placeholder="Search here...." name="search" id="searchInput">
                </div>
            </form>
         </div>
         <script>
            function submitForm(event) {
                event.preventDefault(); // prevent the form from being submitted normally
                // Your code to handle the form submission goes here
            }
            
            document.addEventListener('keydown', function(event) {
            if (event.key === "Enter") {
                if (document.activeElement === document.getElementById("searchInput")) {
                document.getElementById("searchForm").submit();
                }
            }
            });
        </script>
         <div class="navbar-center">
            <ul>
                <li><a href="main_page.php"><img src="photos/home.png"><span>Home</span></a></li>
                <li><a href="news_page.php" class="active_link"><img src="photos/noti.png"><span>News</span></a></li>
            </ul>
         </div>

         <div class="navbar-right">
            <div class="online">
                <?php echo "<img src=$user_pic class='nav_profile_pic' onclick='toggle_menu()'>" ?>
            </div>
         </div>

         <div class="drop_down_menu" id="profile_menu">
            <div class="menu">
                <a href="edit.php" class="menu_function">
                    <img src="photos/settings.png">
                    <p>Settings</p>
                </a>
                <a href="logout.php" class="menu_function">
                    <img src="photos/logout.png">
                    <p>Log Out</p>
                </a>
            </div>
        </div>

        <script>
            let profile_menu = document.getElementById("profile_menu");
            function toggle_menu(){
                profile_menu.classList.toggle("open_menu");
            }
        </script>
    </nav>
    <!--------------navbar end------------>

    <div class="container">
        <!--------------left-sidebar------------>
        <div class="left-sidebar">
            <div class="sidebar-profile-box">
                <?php echo "<img src=$user_background width=100%>" ?>
                <div class="sidebar-profile-info">
                    <?php echo "<img src=$user_pic>"?>
                    <h1><?php echo $user_name?></h1>
                    <h3><?php echo $user_about?></h3>
                    <ul>
                        <li>Your post number<span><?php echo $user_post_number?></span></li>
                        <li>Your favourite<span><?php echo $user_favourite_number?></span></li>
                    </ul>
                </div>
                <div class="sidebar-profile-link">
                    <a href="favourite_page.php"><img src="images/favourite_icon.jpg">My Favourite</a>
                    <a href="php_user_profile"><img src="images/profile.webp">My Profile</a>
                </div>
            </div>
            <div class="sidebar-activity">
                <h3>RECENT</h3>
                <a href="#"><img src="images/test.png"> Web Development </a>
                <a href="#"><img src="images/test.png"> Code Better </a>
                <a href="#"><img src="images/test.png"> Handsome Ler </a>
                <h3>GROUPS</h3>
                <a href="#"><img src="images/test.png"> Web Development Group</a>
                <a href="#"><img src="images/test.png"> Code Better Group</a>
                <a href="#"><img src="images/test.png"> Handsome Ler Group</a>
                <h3>HASHTAG</h3>
                <a href="#"><img src="images/test.png"> Web</a>
                <a href="#"><img src="images/test.png"> Code</a>
                <a href="#"><img src="images/test.png"> Handsome</a>
                <div class="discover-more-link">
                    <a href="#">Discover More</a>
                </div>
            </div>

        </div>        
        <!--------------main-content------------>
        <div class="main-content">

            <?php include("conn.php");
            $news=mysqli_query($con,"SELECT * FROM news");
            ?>

            <?php
            include("conn.php");
            $search = $_GET['search'];
            $sql = "SELECT * FROM news  WHERE news_title LIKE '%".$search."%' OR news_content LIKE '%".$search."%' ORDER BY news_date DESC";
            $news = mysqli_query($con, $sql);
            while($row=mysqli_fetch_array($news))
            {
                echo '<div class="news-post">';

                    echo '<div class="news-author">';
                        echo"<div>";
                            echo"<h1>$row[news_title]</h1>";
                            echo"<small>$row[news_date]</small>";
                        echo '</div>';
                    echo '</div>';
                    echo'<br><br>';
                    echo "<p>$row[news_content]</p>";
                    if ($row['news_images']!="uploads/"){
                    echo "<img src=$row[news_images] width=100%>";}
                echo'</div>';}
                    ?>

        </div>
        <!--------------right-sidebar------------>
        <?php 
        include('conn.php');
        $sql = "SELECT * FROM news LIMIT 3";
        $result = mysqli_query($con, $sql);
        ?>
        <div class="right-sidebar">
            <div class="sidebar-news">
                <h3>Trending News</h3>
                <?php if (mysqli_num_rows($result) > 0) {
                $index = 1;
                while($row = mysqli_fetch_assoc($result)) {
                    // Display each record
                    echo "<a href=news_page.php>$row[news_title]</a>";
                    echo "<span>$row[news_date]</span>";
    
                    $index++;
                }
                } else {
                echo "No records found.";
                }?>

                <a href="news_page.php" class="read-more-link">Read More</a>
            </div>
            <div class="sidebar-useful-links">
                <a href="about_us.php">About Us</a>
                <a href="#">Help</a>
                <a href="#">Privacy Policy</a>
                <a href="#">More</a>

                <div class="copyright-msg">
                    <img src="photos/new_logo.svg">
                    <p>AGRILIFE &#169; 2023. All right reserved</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>