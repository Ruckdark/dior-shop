<?php
require_once 'header.php';

if (!isset($_SESSION['login-email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
    echo "<script>window.open('profile.php','_self')</script>";
}

require_once 'footer.php';
