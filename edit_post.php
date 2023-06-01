<?php
    date_default_timezone_set('Asia/Kuala_Lumpur');
    /**set datetime */
    include ("session.php");
    if (isset($_SESSION['user_email'])) {
        $user_email = $_SESSION['user_email'];
    } else {
        $user_email="no email";
    }
    /**include session and get user email */
    include("conn.php");
    $sql="SELECT * FROM users WHERE user_email = '$user_email'";
    $result = mysqli_query($con, $sql);
    while($row=mysqli_fetch_array($result)){
        $user_id=$row['id'];
        $user_name=$row['user_name'];
        $user_pic=$row['user_pic'];
        $user_background=$row['user_background'];
        $user_about=$row['user_about'];
        $user_join=$row['user_join'];
    }
    /**run query to set element */
    $post_id = $_GET['post_id'];
    /**get post id when user click edit at user profile*/

?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User profile</title>
    <link rel="stylesheet" href="profile_style.css">
    <style>
        #submit{
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            position: relative;
            left: 850px;
            margin-top: 20px;
        }

        #form-control {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            position: relative;
        }
        .action_choice{
            cursor: pointer;
            margin-top: 20px;
            display: none;
        }

        /**css style for edit button and text input field */
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar_left">
            <a href="main_page.php" class="logo"><img src="photos/new_logo.svg"></a>
            <!---bring user to main page when clicking the logo--->
            <form id="searchForm" action="search.php" method="get" onsubmit="submitForm(event)">
                <div class="search_bar">
                    <img src="photos/search.png">
                    <input type="text" placeholder="Search here...">
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
        <div class="navbar_center">
            <ul>
                <li><a href="main_page.php"><img src="photos/home.png"> <span>Home</span> </a></li>
                <li><a href="news_page.php"><img src="photos/noti.png"> <span>News</span> </a></li>
            </ul>
        </div>
        <div class="navbar_right">
            <?php echo "<img src=$user_pic class='nav_profile_pic' onclick='toggle_menu()'>" ?>
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

<!-- Navigation bar (up) -->

    <div class="container">
        <div class="user_profile">
            <div class="profile_info">
                <?php
                    echo "<br><br>";
                    echo "<img src=$user_pic>";
                    echo "<h2>".$user_name. "</h2><br><br>";
                    echo "<h3>About</h3>". $user_about. "<br><br>";
                    echo "<h3>Email</h3>". $user_email. "<br><br>";
                    echo "<h3>Join since</h3>". $user_join;

                ?>
            </div>
        </div>

<!-- User profile (left) -->


    
<div class="main-content">
            <div class="create-post">

            <?php include("conn.php");
            $posts=mysqli_query($con,"SELECT * FROM posts");
            ?>

            <?php
            include("conn.php");
    
            $sql = "SELECT * FROM posts WHERE post_id='$post_id' ORDER BY post_date DESC";
            $posts = mysqli_query($con, $sql);
            while($row=mysqli_fetch_array($posts))
            {
                $post_id=$row['post_id'];
                echo "<form action=update_post.php method=post enctype=multipart/form-data>";
                echo '<div class="user-post">';
                echo '<div class="post-author">';
                        echo"<img src=$row[user_profile]>";
                        echo"<div class=post-author-details>";
                            echo"<h1>$row[user_name]</h1>";
                            echo"<small>$row[post_date]</small>";
                        echo '</div>';
                        echo "<div class=action_choice>";
                            echo "<span class=show_choice onclick=toggleCategory(this)><img src=images/more.webp></span>";
                            echo "<div class=choice>";
                            echo "<a href='edit_post.php?post_id=$post_id' id='editPost'>Edit</a><br><br>";
                            echo "<a href='delete.php?post_id=$post_id' id='deletePost'>Delete</a>";
                            echo "</div>";
                        echo "</div>";
                    echo '</div>';
                    echo'<br><br>';
                    echo '<p><input type=text name=post_content id=form-control value="'.htmlspecialchars($row['post'], ENT_QUOTES).'"></p>';
                    if ($row['images']!="uploads/"){
                    echo "<input type=file name=images id=form-control img src=$row[images] width=100%>";
                    }
                    echo "<input type=hidden name=post_id value='$post_id'>";
                    echo "<button type=submit name=submit id=submit>Update</button>";
                echo "</form>";

                    ?>
                    <script>
                        function toggleCategory(action_choice) {
                        action_choice.parentElement.classList.toggle("open");
                        }
                    </script>
                    
                    <div class="post_like">
                            <form action="favourite.php"method="post" id="favourite_form">
                            <div>
                                <input type="image" img src="images/favourite.png" width="25px" onclick="changeImage()" id="favouriteImage">
                                <input type="hidden" name="parent_post_id" value="<?php echo $row['post_id']?>">
                                <input type="hidden" name="user_email" value="<?php echo $user_email?>">
                            </div>
                            <script>function changeImage() {
                            const image = document.getElementById("favouriteImage");
                            if (image.src.match("images/favourite.png")) {
                                image.src = "images/favourite_icon.jpg";
                            } else {
                                image.src = "images/favourite_icon.jpg";
                            }
                            }</script>
                            </form>
                            <form action="comment.php" method="post" id="comment_form">
                            <div class="comment_bar">
                                <input type="text" placeholder="Comment..." name="comment_content">
                                <input type="image" src="images/send.png" style="width: 35px" alt="Submit Me">
                                <input type="hidden" name="parent_comment_id" value="<?php echo $row['post_id']?>">
                        
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
                                    echo "<div class='comment_box'>";
                                    echo $row["comment_sender_name"]. "<br>";
                                    echo $row["comment_content"];
                                    echo "</div>";
                                }}
                            }
                            echo "</div>";
                            $sql2 = "SELECT * FROM favourite WHERE parent_post_id='$post_id'";
                            $result2 = mysqli_query($con, $sql2);
                            $parent_post_ids=array();
                            while ($row = mysqli_fetch_array($result2)) {
                                $parent_post_ids[]=$row['parent_post_id'];
                                // Do something with $row here
                            }
                            if(mysqli_num_rows($result2) > 0){
                            if (in_array($post_id,$parent_post_ids)){
                                $favourite_number=$result2->num_rows;
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
                        echo"</div>";
                    echo"</div>";
                echo '</div>';
            echo"</div>";
            }
            mysqli_close($con); //to close the database connection
            ?>
            </div>

            <script>
                function toggleCategory(comments_row) {
                comments_row.parentElement.classList.toggle("open");
                }
            </script>

        </div>

<!-- User post (right) -->

</body>
</html>