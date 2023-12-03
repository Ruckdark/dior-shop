<?php
session_start();
require 'config.php';
require 'functions.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
    <link rel="stylesheet" href="./assets/style.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="./css/h3style.css">
    <link rel="stylesheet" href="./assets/product.css">
    <link rel="stylesheet" href="./assets/product_add.css">
    <link rel="stylesheet" href="./assets/user_profile.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- Header -->
    <div class="header" id="header">

        <a href="index.php" id="logo">LOGO</a>
        
        <div id="nav">
            <div class="nav-item active">
                <a href="index.php" title="Home">TRANG CHỦ</a>
            </div>

            <div class="nav-item">
                <a href="products.php" title="Products">SẢN PHẨM</a>
            </div>

            <div class="nav-item">
                <a href="news.php" title="News">TIN TỨC</a>
            </div>
        </div>

        <div id="nav-icon">
            <a id="cart-icon" class="nav-item" href="cart.php" title="Cart">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>

            <a id="user-icon" class="nav-item" href="check_login.php" title="Account">
                <i class="fa-solid fa-user"></i>
            </a>
        </div>
    </div>