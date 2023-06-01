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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    
</head>
<body>
<nav class="navbar">
         <div class="navbar-left">
            <a href="main_page.php" class="logo"><img src="photos/new_logo.svg"></a>

            <form id="searchForm" action="favourite_search.php" method="get" onsubmit="submitForm(event)">
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
                <li><a href="news_page.php"><img src="photos/noti.png"><span>News</span></a></li>
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
            <div class="create-post">

            <?php
            include("conn.php");
    
            $sql2="SELECT * FROM favourite WHERE user_email='$user_email'";
            $result2 = mysqli_query($con, $sql2);
            $parent_post_ids=array();
            while($row=mysqli_fetch_assoc($result2)){
                $parent_post_ids[]=$row['parent_post_id'];
            }
            if (!empty($parent_post_ids)){
                $parent_post_id=implode(",",$parent_post_ids);

            $sql = "SELECT * FROM posts ORDER BY post_date DESC";
            $posts = mysqli_query($con, $sql);

            while($row=mysqli_fetch_array($posts))
            {
                $post_id=$row['post_id'];
                if ((in_array($post_id,$parent_post_ids))){
                echo '<div class="user-post">';

                    echo '<div class="post-author">';
                        echo"<img src=$row[user_profile]>";
                        echo"<div>";
                            echo"<h1>$row[user_name]</h1>";
                            echo"<small>$row[post_date]</small>";
                        echo '</div>';
                    echo '</div>';
                    echo'<br><br>';
                    echo "<p>$row[post]</p>";
                    if ($row['images']!="uploads/"){
                    echo "<img src=$row[images] width=100%>";
                    }
                    ?>
                    <div class="post_like">
                            <div>
                                <a href="favourite_delete.php?post_id=<?php echo $post_id; ?>">
                                    <img src="images/remove_favourite.webp" width="25px" id="favouriteImage">
                                </a>
                            </div>
                            <script>
                                document.getElementById("favouriteImage").addEventListener("click", function(event) {
                                    var hrefValue = this.getAttribute("href");
                                    console.log(hrefValue);
                                    window.location.href = hrefValue;
                                });
                            </script>
                            <form action="comment.php" method="post" id="comment_form">
                            <div class="comment_bar">
                                <input type="text" placeholder="Comment..." name="comment_content">
                                <input type="image" src="images/send.png" style="width: 35px" alt="Submit Me">
                                <input type="hidden" name="parent_comment_id" value="<?php echo $row['post_id']?>">
                                <input type="hidden" name="comment_sender_name" value="<?php echo $user_name ?>">
                                <input type="hidden" name="comment_sender_email" value="<?php echo $user_email ?>">
                            </div>
                            </form>
                    </div>
                        
                    <div class="reverse">
                                                            
                    <div class="comments_row" id="comments_row">
                        <span class="show_comment" onclick="toggleCategory(this)"> Show Comment</span>
                        <?php
                        include("conn.php");

                        $sql1 = "SELECT * FROM comment";
                        $result1 = mysqli_query($con, $sql1);
                        $parent_comment_ids = array();
                        while ($row = mysqli_fetch_assoc($result1)){
                            $parent_comment_ids[] = $row['parent_comment_id'];
                        }

                        $sql3 = "SELECT * FROM comment WHERE parent_comment_id = '$post_id'";
                
                            $result3 = mysqli_query($con, $sql3);
                            if($result3 === false) {
                                echo "Error executing query: " . mysqli_error($con);
                                exit();
                            }
                            if(mysqli_num_rows($result3) > 0) {
                                while($row = mysqli_fetch_assoc($result3)) {
                                    if ((in_array($post_id,$parent_comment_ids))){
                                        $comment_number=$result3->num_rows;
                                        $comment_id=$row['comment_id'];
                                        echo "<div class='comment_box'>";
                                        echo $row["comment_sender_name"].":"."<br>";
                                        echo $row["comment_content"]."<br>";
                                        if ($user_email==$row['comment_sender_email']){
                                        echo "<a href='delete_comment.php?comment_id=$comment_id' id='deleteComment'>Delete Comment</a>";
                                        }
                                        echo "</div>";
                                    }}
                            }
                            echo "</div>";
                            $sql5 = "SELECT * FROM favourite WHERE parent_post_id='$post_id'";
                            $result5 = mysqli_query($con, $sql5);
                            $parent_post_ids2=array();
                            while ($row = mysqli_fetch_array($result5)) {
                                $parent_post_ids2[]=$row['parent_post_id'];
                                // Do something with $row here
                            }
                            if(mysqli_num_rows($result5) > 0){
                            if (in_array($post_id,$parent_post_ids2)){
                                $favourite_number=$result5->num_rows;
                            }}

                            echo '<div class="post-stats">';
                            echo "<div>";
                            if (isset($favourite_number)){
                                echo "<span class='liked-users'>$favourite_number Persons Favour This Post</span>";
                            }else{
                                echo "<span class='comment-link'>0 Favour</span>";
                            }
                            echo"</div>";
                            echo "<div>";
                            if (isset($comment_number)){
                                echo "<span class='comment-link'>$comment_number Comment</span>";
                            }else{
                                echo "<span class='comment-link'>0 Comment</span>";
                            }
                            echo "</div>";
                        echo"</div>";
                    echo"</div>";
                echo '</div>';
            }}}
            mysqli_close($con); //to close the database connection
            ?>
            </div>
            <script>
            document.getElementById("deleteComment").addEventListener("click", function(event) {
                event.preventDefault();
                var hrefValue = this.getAttribute("href");
                console.log(hrefValue);
                window.location.href = hrefValue;
            });
            </script>
            <script>
                function toggleCategory(comments_row) {
                comments_row.parentElement.classList.toggle("open");
                }
            </script>
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