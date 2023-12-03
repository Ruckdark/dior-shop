<?php 
session_start();
session_destroy();
echo "<script>alert('Bạn đã đăng xuất thành công')</script>";
echo "<script>window.open('index.php','_self')</script>";
?>