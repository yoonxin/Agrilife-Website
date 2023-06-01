<?php


    date_default_timezone_set('Asia/Kuala_Lumpur');

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
        $user_join=$row['user_join'];
    }
        
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wilson's profile</title>
    <link rel="stylesheet" href="settings_style.css">
    
</head>
<body>
    <nav class="navbar">
        <div class="navbar_left">
            <a href="main_page.php" class="logo"><img src="photos/new_logo.svg"></a>

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
    



     <!-- Settings -->
		<div class="container_settings">
			<h1 class="title">Account Settings</h1>

            <div class="drop_down_settings" id="information_settings">
                <h3 onclick="toggleCategory(this)"> Information Settings ▼</h3>

                <?php
                    include("conn.php");

                    $result=mysqli_query($con,"SELECT * FROM users   WHERE id=$user_id");
                    while($row=mysqli_fetch_array($result))
                {
                ?>
                <div class="information_row">
                <form action="update_acc.php" method="post" type="hidden" name="id" enctype="multipart/form-data" value="<?php echo $row['id']?>">        <!-- form here -->
                    <div class="form-group">
                        <label>Background Picture</label>
                        <input type="file" name="background" class="form-control" value="<?php echo $user_background ?>">
                    </div>
                    <div class="form-group">
                        <label>Profile Image</label>
                        <input type="file" name="images" id="images" class="form-control" value="<?php echo $user_pic?>">
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $user_name ?>">
                    </div>
                    <div class="form-group">
                        <label>About</label>
                        <textarea class="form-control" name="about"> <?php echo $user_about ?> </textarea>
                    </div>
                    <div class="form-group">
                        <label>Contact Number</label>
                        <input type="text" name="contact_number" class="form-control" placeholder="Contact Numver" value="<?php echo $row['user_contact_num'] ?>">
                    </div>
                <div>
                    <input type="hidden" name="id" value="<?php $user_id ?>">
                    <button class="btn btn-primary" type="submit" name="submit">Update</button>
                    <button class="btn btn-light">Cancel</button>
                </div>
                </form>

                <?php
                }
                mysqli_close($con);
                ?>
                </div>
            </div>

                <div class="drop_down_settings" id="password_settings">
                    <h3 onclick="toggleCategory(this)"> Password Settings ▼</h3>


                <?php
                    include("conn.php");
                    $result=mysqli_query($con,"SELECT * FROM users WHERE id=$user_id");
                    while($row=mysqli_fetch_array($result))
                {
                ?>

                <form onsubmit="return validateForm()" action="update_password.php" method="post">
                    <div class="password_row">
                        <div class="form-group">
                            <label>Old password</label>
                            <input type="text" name="old_pass" class="form-control" readonly value="<?php echo $row['user_password'] ?>">
                        </div>

                        <div class="form-group">
                            <label>New password</label>
                            <input type="password" id="new_password" name="new_pass" class="form-control">
                        </div>


                        <div class="form-group">
                            <label>Confirm new password</label>
                            <input type="password" id="repeat_password" name="confirm_new_pass" class="form-control">
                        </div>

                <script>
                function validateForm() {
                    var newPassword = document.getElementById("new_password").value;
                    var repeatPassword = document.getElementById("repeat_password").value;

                    if (newPassword != repeatPassword) {
                        alert("New password and repeat new password fields should be same");
                        return false;
                    }
                    return true;
                    }
                </script>

                <div>
                    <button class="btn btn-primary" type="submit">Update</button>
                    <button class="btn btn-light">Cancel</button>
                </div>
                </form>
                </div>
            </div>
            <script>
                function toggleCategory(drop_down_settings) {
                drop_down_settings.parentElement.classList.toggle("open");
                }
            </script>
                <?php
                }
                mysqli_close($con);
                ?>
        </div>
    </div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>