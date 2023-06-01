<?php
session_start();
if(!isset($_SESSION["user_email"]))
{
    echo '<script>alert ("Unauthorized access!")</script>';
	header("location:login_reg.php");
}
include('conn.php');
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="adminpage.css">    <!-- css styling -->
    <script src="javascripttab.js"></script>    <!-- javascript for showing tabs -->
    <title>Admin Page</title>
</head>

<body>

    <div class="container">
        <div class="left-sidebar">
            <h1><?php echo "Hello, ". $_SESSION["user_email"]. "! Welcome to your dashboard." ?></h1>
            <iframe src="https://free.timeanddate.com/clock/i8t2mi56/n4366/tlmy/fn14/fs16/tct/pct/ahl/ftb/pt2/tt0/tw0/tm1/th1/ta1/tb1" frameborder="0" width="228" height="22" allowtransparency="true"></iframe>
            <div class="sidebar-activity">
                <div class="tab" id="tab1" onclick="tab(1)">Dashboard</div>
                <div class="tab" id="tab2" onclick="tab(2)">Manage User Post</div>
                <div class="tab" id="tab3" onclick="tab(3)">Manage Trending News</div>
                <div class="tab" id="tab4" onclick="tab(4)">Manage User Comment</div>
                <div class="tab" id="tab5" onclick="tab(5)">Manage User Account</div>
            </div>
        </div>

        <!-- this is the Dashboard -->
        <div class="main-content">
            <div class="flex-container">
                <div class="content" id="content1"><h2>Overview</h2>
                    <div class="cardbox">
                        <div class="card">
                            <div>
                                <div class="numbers">
                                    <?php //sql to count total number of post
                                        $sql = "SELECT COUNT(*) as total FROM posts";
                                        $result=mysqli_query($con, $sql);
                                        $row = mysqli_fetch_assoc ($result);
                                        $total = $row['total'];
                                        echo $total;
                                    ?>
                                </div>
                                <div class="cardname">Number of Posts</div>
                            </div>
                            <div class="iconbx">
                                <ion-icon name="open-outline"></ion-icon>
                            </div>
                        </div>

                        <div class="card">
                            <div>    
                                <div class="numbers">
                                    <?php //sql to count total number of user
                                        $sql2 = "SELECT COUNT(*) as total FROM users WHERE user_type='user'";
                                        $result2 = mysqli_query($con, $sql2);
                                        $row = mysqli_fetch_assoc ($result2);
                                        $total = $row['total'];
                                        echo $total;
                                    ?>
                                </div>
                                <div class="cardname">Number of User</div>
                            </div>
                            <div class="iconbx">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                        </div>

                        <div class="card">    
                            <div>
                                <div class="numbers">
                                    <?php //sql to count total number of user
                                        $sql3 = "SELECT COUNT(*) as total FROM comment";
                                        $result3 = mysqli_query($con, $sql3);
                                        $row = mysqli_fetch_assoc ($result3);
                                        $total = $row['total'];
                                        echo $total;
                                    ?>
                                </div>
                                <div class="cardname">Comments</div>
                            </div>
                            <div class="iconbx">
                                <ion-icon name="chatbox-ellipses-outline"></ion-icon>
                            </div>
                        </div>
                    </div>

                    <!--data chart -->
                    <div class="graphbox">
                        <div class="box">
                            <div>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                        
                        <div class="box">
                            <div>
                                <canvas id="Posting"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                 <!-- this is Manage User Post -->
                 <div class="content" id="content2"><h2>Manage User Post</h2>
                    <div class="details">
                        <div class="managepost">
                            <div class="cardheader">
                                <h2>List of User Post</h2>
                            </div>
                            <?php
                                $select = "SELECT * FROM posts ";
                                $result = mysqli_query($con, $select);
                                if (mysqli_num_rows($result) > 0) {
                             ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <td>Post ID</td>
                                            <td>Post Date</td>
                                            <td>User Name</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <!-- php to display list of user post starts -->
                                    <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                        <td><?php echo $row["post_id"]; ?></td>
                                            <td><?php echo $row['post_date']; ?></td>
                                            <td><?php echo $row['user_name']; ?></td>
                                            <td><a href="deletepost.php?post_id=<?php echo $row['post_id']; ?>" onClick="return confirm('Delete record for <?php echo $row['post_id']; ?>?');">Delete</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo "No result found!";
                            }
                            ?>
                        </div>
                    </div>
                </div>

                <!-- This is Manage Trending News-->
                <div class="content" id="content3"><h2>Manage Trending News</h2>
                    <div class="details">
                        <div class="addnews">
                            <div class="cardheader">
                                <h2>Add Trending News</h2>
                                <a href="addnews.php">Click here to Add News</a>
                            </div>
                        </div>
                    </div>

                    <div class="details">
                        <div class="managenews">
                            <div class="cardheader">
                                <h2>List of Trending News</h2>
                            </div>
                            <?php
                                $select = "SELECT * FROM news "; //posts table
                                $result=mysqli_query($con, $select);
                                if (mysqli_num_rows($result) > 0) {
                            ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <td>News ID</td>
                                            <td>News Title</td>
                                            <td>News Date</td>
                                            <td>News Content</td>
                                            <td>News Images</td>
                                            <td>Edit News?</td>
                                            <td>Delete News?</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <!-- php to display list of news from database -->
                                    <?php 
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                            <td><?php echo $row["news_id"]; ?></td> 
                                            <td><?php echo $row['news_title']; ?></td>
                                            <td><?php echo $row['news_date']; ?></td> 
                                            <td><?php echo $row['news_content']; ?></td>
                                            <td><?php echo $row['news_images']; ?></td>
                                            <td><a href="editnews.php?news_id=<?php echo $row['news_id']; ?>" onClick="return confirm('Edit record for <?php echo $row['news_id']; ?>?');">Edit</a></td>
                                            <td><a href="deletenews.php?id=<?php echo $row['news_id']; ?>" onClick="return confirm('Delete record for <?php echo $row['news_id']; ?>?');">Delete</a></td>
                                            
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo "No result found";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- This is Manage User Comment-->
                <div class="content" id="content4"><h2>Manage User Comment</h2>
                    <div class="details">
                        <div class="manage_comment">
                            <div class="cardheader">
                                <h2>List of User Comment</h2>
                            </div>
                            <?php
                                $select = "SELECT * FROM comment ";
                                $result = mysqli_query($con, $select);
                                if (mysqli_num_rows($result) > 0) {
                             ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <td>Comment ID</td>
                                            <td>Post ID</td>
                                            <td>Comment Content</td>
                                            <td>User Email</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <!-- php to display list of user post starts -->
                                    <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                        <td><?php echo $row["comment_id"]; ?></td>
                                            <td><?php echo $row['parent_comment_id']; ?></td>
                                            <td><?php echo $row['comment_content']; ?></td>
                                            <td><?php echo $row['comment_sender_email']; ?></td>
                                            <td><a href="delete_comment.php?comment_id=<?php echo $row['comment_id']; ?>" onClick="return confirm('Delete record for <?php echo $row['comment_id']; ?>?');">Delete</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo "No result found!";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- This is Manage User Account-->
                <div class="content" id="content5"><h2>Manage User Account</h2>
                    <div class="details">
                        <div class="manage_account">
                            <div class="cardheader">
                                <h2>List of User Account</h2>
                            </div>
                            <?php
                                $select = "SELECT * FROM users WHERE user_type='user'";
                                $result = mysqli_query($con, $select);
                                if (mysqli_num_rows($result) > 0) {
                             ?>
                                <table>
                                    <thead>
                                        <tr>
                                            <td>User ID</td>
                                            <td>User Email</td>
                                            <td>User Name</td>
                                            <td>User Join</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    <!-- php to display list of user post starts -->
                                    <?php
                                        while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                        <tr>
                                        <td><?php echo $row["id"]; ?></td>
                                            <td><?php echo $row['user_email']; ?></td>
                                            <td><?php echo $row['user_name']; ?></td>
                                            <td><?php echo $row['user_join']; ?></td>
                                            <td><a href="delete_user.php?user_email=<?php echo $row['user_email']; ?>" onClick="return confirm('Delete record for <?php echo $row['user_email']; ?>?');">Delete</a></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo "No result found!";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <!-- ------------right-sidebar---------- display whaterver uploaded data  -->
    <?php 
        include('conn.php');
        $sql = "SELECT * FROM users WHERE user_type = 'user' LIMIT 10";
        $result = mysqli_query($con, $sql);
        ?>
        <div class="right-sidebar">
            <div class="sidebar-news">
                <h3>New User</h3>
                <?php if (mysqli_num_rows($result) > 0) {
                $index = 1;
                while($row = mysqli_fetch_assoc($result)) {
                    // Display each record
                    echo "<a href=admin_page.php>$row[user_email]</a>";
                    echo "<span>$row[user_join]</span>";
    
                    $index++;
                }
                } else {
                echo "No records found.";
                }?>

            </div>
            <div class="sidebar-useful-links">
                <button onclick="location.href='logout.php'">Logout</button>

                <div class="copyright-msg">
                    <img src="photos/new_logo.svg">
                    <p>AGRILIFE &#169; 2023. All right reserved</p>
                </div>
            </div>
        </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
<script src="my_chart.js"></script>     <!-- javascript for the line and bar chart -->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
