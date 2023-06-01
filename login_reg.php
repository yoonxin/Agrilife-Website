<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/ece3175d47.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="style/login_reg.css">
    <title>Welcome to Agrilife!</title>

</head>
<body>
<!-- php for login -->
<?php
include ("conn.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['btn1'])) {
        $useremail = $_POST['useremail'];
        $fpassword = $_POST['fpassword'];


        //to check if the email and password match our database
        $check= "SELECT * FROM users WHERE user_email='$useremail' AND user_password='$fpassword'"; 
        $result=mysqli_query($con,$check);
        $row = mysqli_fetch_array($result);

    if ($row['user_type'] == 'admin') {
        session_start();
        $_SESSION['user_email']=$useremail;
        header('location: admin_page.php');

    } elseif ($row['user_type'] == 'user') {
        session_start();
        $_SESSION['user_email']=$useremail;
        header('location: main_page.php');
        
    } else {
        echo '<script>alert ("Invalid email or password! Please try to log in again!");
        window.location.href = "login_reg.php";
        </script>';
    }
}
}



?>

    <!--Login page start here-->
    <div class="container">
        <div class="signin-signup"> 
            <div class="signin">
                
                <form action="login_reg.php" method="post" class="sign-in-form">   
                <h2 class="title">Log In</h2>
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" name="useremail" placeholder="Email Address" id="useremail"required>
                    </div>

                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password"  name="fpassword" placeholder="Password" required>
                    </div>

                    <!-- Forgot password hyperlink -->
                    <div id="forgot-ps">
                        <a href="#" target="_blank">Forgot password?</a>
                    </div>

                    <button type="submit" value="Login" id="btn1" name="btn1">Login</button>
                    
                    <!--Alternate login function-->
                    <div class="altlogin">  
                        <p style="font-size: 15px">Or Log In Via</p>
                        <div id="altbutton">
                            <a href="#google"><img src="images/google-icon.png" width="20px">
                            </a>
                        </div>
                        
                        <div id="altbutton">
                            <a href="#facebook"><img src="images/facebook-logo-13.png" width="20px">
                            </a>
                        </div>
                        
                        <div id="altbutton">
                            <a href="#twitter"><img src="images/twitter-logo.png" width="20px">
                            </a>
                        </div>                      
                    </div>
                </form>
            </div>

            <!-- sign up php -->
            <?php
            include ("conn.php");

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST['btn2'])) {
                $name = $_POST['username'];
                $email = $_POST['useremail'];
                $password = $_POST['psw'];
                $rpassword = $_POST['rpsw'];


                $checkgmail="SELECT id FROM users WHERE user_email='$email'";
                $result = mysqli_query($con, $checkgmail);
                $any = mysqli_num_rows($result);

                if ($password != $rpassword) {
                    echo '<script>alert ("Repeat password is incorrect! Please try again.");
                    window.location.href = "login_reg.php";
                    </script>';
                } else {
                    if ($any > 0 ) {
                        echo '<script>alert ("Email existed! Please try logging in again!");
                        window.location.href = "login_reg.php";
                        </script>';
                    } else {
                        $date = date('Y-m-d');
                        $insert = "INSERT INTO users (user_name, user_email, user_password, user_rpassword,user_join) 
                        VALUES ('$name', '$email', '$password', '$rpassword','$date' )"; //'$role'
                    
                        if (mysqli_query($con,$insert)) {   #if mysqli cannot be executed (!=not),then it will show error message.
                            echo '<script>alert("Thank you for registering! You will be redirected to the login page now.");   
                            window.location.href = "login_reg.php";</script>';
                        } else {
                            echo "Error: ".$sql4. "<br>" . mysqli_error($con);
                        }
                    }
                mysqli_close($con);
                }
            }}
            ?>   
            <!-- Here right SignUp form started. -->
            <div class="signup" id="signup" >
                
                <form action="login_reg.php" method="post" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                    <div class="input-field">
                        <input type="text" name="username" placeholder="Username" required/>
                    </div>
                
                    <div class="input-field"> 
                        <input type="email" name="useremail" placeholder="Email address" required/>
                    </div>
                    
                    <div class="input-field">
                        <input type="password" name="psw" placeholder="Password" required/>
                    </div>
                    
                    <div class="input-field">
                        <input type="password" name="rpsw" placeholder="Repeat Password" required/>
                    </div>
                
                    <button type="submit" value="Signup" id="btn" name="btn2" >Sign up</button>
                    <br>
            
                    <div class="altlogin">  
                        <p style="font-size: 15px">Or Sign Up Via</p>  
                        <div id="altbutton">
                            <a href="#google"><img src="images/google-icon.png" width="20px">
                            </a>
                        </div>
                    
                        <div id="altbutton">
                            <a href="#facebook"><img src="images/facebook-logo-13.png" width="20px">
                            </a>
                        </div>
                        
                        <div id="altbutton">
                            <a href="#twitter"><img src="images/twitter-logo.png" width="20px">
                            </a>
                        </div>                    
                    </div> 
                </form>
            </div>
        </div>

        <!-- Here Animation panel started -->
        <div class="panels-container">      
            <div class="panel left-panel">
                <div class="content">
                    <div class="imglogo">
                        <img src="images/logo.svg" alt="logo">
                    </div>
                    <h3>Agrilife</h3>
                    <p>Already a registered member? Log in here!</p>
                    <button class="btn" id="sign-in-btn">Login</button>
                </div>
            </div>

            <div class="panel right-panel">
                <div class="content">
                    <div class="imglogo">
                        <img src="images/logo.svg" alt="logo">
                    </div>
                    <h3>Agrilife</h3>
                    <p>Your go-to site where everyone shares knowledge and experience in a HUGE online community!</p>
                    <p>New to Agrilife? Sign Up Now!</p>
                    <button class="btn" id="sign-up-btn">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
   

</body>
<script src="app1.js"></script>

</html>