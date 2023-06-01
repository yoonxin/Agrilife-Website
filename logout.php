<?php
session_start();
header("location: login_reg.php");
session_destroy();
?>