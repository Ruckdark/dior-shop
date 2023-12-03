<?php
require 'header.php';
?>

<div id="body">
    <?php
    $user_id = $_SESSION['user_id'];
    if ($_SESSION['login-email'] == "admin@gmail.com") {

        echo "<div id='main'>
        <div id='container'>
            <div id='user_img'>
                <img src='./assets/IMG/USER IMG/user-profile-icon-flat-style-member-avatar-vector-illustration-isolated-background-human-permission-sign-business-concept_157943-15752.avif' alt=''>
            </div>
            
            <div id='user_info'>
                <input type='text' placeholder='name'>
                <br>
                <input type='text' placeholder='email'>
                <br>
                <input type='text' placeholder='phone'>
                <br>
                <input type='text' placeholder='address'>
                <br>
                <a href='product_upload.php'>Tải lên sản phẩm</a><br>
                <br>
                <br><a href='logout.php'>Đăng xuất</a>
            </div>
        </div>
    </div>";
        // require 'file_upload.php';
        
    }else {
        echo "<div id='main'>
        <div id='container'>
            <div id='user_img'>
                <img src='./assets/IMG/USER IMG/user-profile-icon-flat-style-member-avatar-vector-illustration-isolated-background-human-permission-sign-business-concept_157943-15752.avif' alt=''>
            </div>
            
            <div id='user_info'>
                <input type='text' placeholder='name'>
                <br>
                <input type='text' placeholder='email'>
                <br>
                <input type='text' placeholder='phone'>
                <br>
                <input type='text' placeholder='address'>
                <br>
                <br><a href='logout.php'>Đăng xuất</a>
            </div>
        </div>
    </div>";
    }
    ?>
    
</div>

<?php
require 'footer.php';
?>