<?php
require 'header.php';
?>

<div class="product_container">
    <!-- <div class="product_detail"> -->
    <!-- <form action='details.php?add_cart=$product_id' method='post' class="product_detail"> -->
    <?php
    if (isset($_GET['product_id']) && isset($_SESSION['login-email']) && $_SESSION['login-email'] == 'admin@gmail.com') {
        $product_id = $_GET['product_id'];
        $sql_select =  "SELECT * FROM products WHERE ProductID = $product_id";
        $result = mysqli_query($conn, $sql_select);
        $row = mysqli_fetch_assoc($result);
        echo "<form action='details.php' method='post' class='product_detail'>";
        echo "<input type='hidden' name='product_id' value='$product_id'>";
        echo "<div class='product_img'><img src='" . $row['ProductImage'] . "' alt = " . $row['ProductName'] . "></div>";
        echo "<div class='product_info'>";
        echo "<h2 class='product_name'>" . $row['ProductName'] . "</h2>";
        echo "<h2 class='product_price'>Giá: " . $row['ProductPrice'] . "</h2>";
        echo "<input type='hidden' name='price' value='".$row['ProductPrice']."'>";
        echo "<p class='product_description'>" . $row['ProductDescription'] . "</p>";
        echo "<div class='quantity'>
                    <!--<button class='minus_item'>-</button>-->
                    <input name='quantity' type='number' value='1' class='quantity_number' >
                    <!--<button class='add_item'>+</button>-->
                </div>";
        echo "<button name='add_cart' class='buy_button' type='submit'>Thêm vào giỏ hàng</button>";
        echo "<button name='delete_product' type='submit' class='delete_button'>Xoá mặt hàng</button>";
        echo "</div>";
        echo "</form>";
    }
    else if (isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];
        $sql_select =  "SELECT * FROM products WHERE ProductID = $product_id";
        $result = mysqli_query($conn, $sql_select);
        $row = mysqli_fetch_assoc($result);
        echo "<form action='details.php' method='post' class='product_detail'>";
        echo "<input type='hidden' name='product_id' value='$product_id'>";
        echo "<div class='product_img'><img src='" . $row['ProductImage'] . "' alt = " . $row['ProductName'] . "></div>";
        echo "<div class='product_info'>";
        echo "<h2 class='product_name'>" . $row['ProductName'] . "</h2>";
        echo "<h2 class='product_price'>Giá: " . $row['ProductPrice'] . "</h2>";
        echo "<input type='hidden' name='price' value='".$row['ProductPrice']."'>";
        echo "<p class='product_description'>" . $row['ProductDescription'] . "</p>";
        echo "<div class='quantity'>
                    <!--<button class='minus_item'>-</button>-->
                    <input name='quantity' type='number' value='1' class='quantity_number' style='width: 25%;' >
                    <!--<button class='add_item'>+</button>-->
                </div>";
        echo "<button name='add_cart' class='buy_button' type='submit'>Thêm vào giỏ hàng</button>";
        
        echo "</div>";
        echo "</form>";
    }

    if (isset($_POST['add_cart'])) {
        if (!isset($_SESSION['user_id'])) {
            // Nếu người dùng chưa đăng nhập, chuyển hướng họ đến trang đăng nhập
            echo "<script>alert('Bạn cần đăng nhập trước')</script>";
            echo "<script>window.open('login.php','_self')</script>";
            exit();
        }
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];
        $user_id = $_SESSION['user_id'];
        $price = $_POST['price'];
        AddToCart($conn, $user_id, $product_id, $quantity, $price);
        echo "<script>window.open('cart.php','_self')</script>";
    }
    if (isset($_POST['delete_product'])) {
        $product_id = $_POST['product_id'];
        DeleteProduct($conn, $product_id);
        echo "<script>window.open('products.php','_self')</script>";
    }

    ?>
    <!-- </form> -->
</div>
<?php
require 'footer.php';
?>
