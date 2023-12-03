<?php
require 'header.php';
if (!isset($_SESSION['login-email'])) {
    echo "<script>alert('Bạn cần đăng nhập trước')</script>";
    echo "<script>window.open('login.php', '_self')</script>";
    exit();
    // $global_order_id;
}
?>
<div id="body">
    <div class="body-item active">
        <div id="cart_page">
            <div id="cart_list">
                <h2>Danh Sách Giỏ Hàng <i class="fa-solid fa-cart-shopping"></i></h2>
                <ul>
                    <form action="cart.php" method="post">
                        <input type="submit" value="Xoá theo lựa chọn" name="delete_check" class="">
                        <input type="submit" value="Xoá tất cả" name="delete_all" class="">

                        <?php
                        $user_id = $_SESSION['user_id'];
                        // Kiểm tra xem có tồn tại giỏ hàng nào của người dùng hiện tại chưa thanh toán không
                        $sql_select = "SELECT * FROM orders WHERE UserID = $user_id AND OrderStatus = 0 ORDER BY OrderID DESC LIMIT 1";
                        $result = mysqli_query($conn, $sql_select);
                        $row = mysqli_fetch_assoc($result);
                        if ($row) {
                            // Nếu có thì tiếp tục hiển thị giỏ hàng trước đó của người dùng hiện tại
                            $order_id = $row['OrderID'];
                            // global $global_order_id;
                            // $global_order_id = $order_id;
                        }else{
                            // Nếu không thì tạo 1 giỏ hàng mới 
                            $sql_insert = "INSERT INTO orders(UserID, OrderDate, TotalAmount, OrderStatus) VALUES ($user_id, NOW(), 0, 0)";
                            mysqli_query($conn, $sql_insert);
                            $order_id = mysqli_insert_id($conn);
                            // global $global_order_id;
                            // $global_order_id = $order_id;
                        }
                        // Hiển thị ra thông tin các sản phẩm trong giỏ hàng
                        $sql_select = "SELECT order_details.OrderID, products.ProductID, products.ProductName, products.ProductImage, order_details.Quantity, order_details.Price
                                    FROM order_details JOIN products ON order_details.ProductID = products.ProductID WHERE order_details.OrderID = $order_id ORDER BY OrderID DESC";
                        $result = mysqli_query($conn, $sql_select);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                // $order_id = $row['OrderID'];
                                $product_id = $row['ProductID'];
                                echo "<li>";
                                echo "<div class='cart_text'>
                                        <h2>Sản phẩm</h2>
                                        <h2>Giá tiền</h2>
                                        <h2>Số lượng</h2>
                                    </div>";
                                echo "<div class='cart_item'>";
                                echo "<div class='tick_box'><input type='checkbox' name='tick_box[]' value='$product_id' id='tick_box'></div>";
                                echo "<div class='cart_product'>
                                        <div class='box'>
                                            <a href='details.php?product_id=$product_id'><img src='" . $row['ProductImage'] . "'></a>
                                        </div>
                                    </div>";
                                echo "<div class='price'><span>" . $row['Price'] . "</span></div>";
                                echo "<div class='quantity'>
                                        <!--<div class='quantity_box'>-->
                                            <!--<button class='minus_item'>-</button>-->
                                            <input type='number' value='".$row['Quantity']."' class='quantity_number' style='width: 50px'>
                                            <!--<button class='add_item'>+</button>-->
                                        <!--</div>-->
                                    </div>";
                                echo "<div class='delete_button'><a href='cart.php?delete=$product_id'><i class='fa-solid fa-trash'></i></a></div>";
                                echo "</div>";
                                echo "</li>";
                            }
                            // btn delete
                            if (isset($_GET['delete'])) {
                                $product_id = $_GET['delete'];
                                $sql_delete = "DELETE FROM order_details WHERE OrderID = $order_id AND ProductID = $product_id";
                                if (mysqli_query($conn, $sql_delete)) {
                                    echo "<script>alert('Xoá thành công')</script>";
                                    echo "<script>window.open('cart.php','_self')</script>";
                                }else{
                                    echo "Error".$sql."<br>".mysqli_error($conn);
                                }
                            }
                            // btn delete_check 
                            if (isset($_POST['delete_check'])) {
                                $product_id = $_POST['tick_box'];
                                foreach($product_id as $p){
                                    $sql_delete = "DELETE FROM order_details WHERE OrderID = $order_id AND ProductID = $p";
                                    if (mysqli_query($conn, $sql_delete)) {
                                        echo "<script>alert('Xoá thành công')</script>";
                                        echo "<script>window.open('cart.php','_self')</script>";
                                    }else {
                                        echo "Error: ".$sql."<br>".mysqli_error($conn);
                                    }
                                }
                            }
                            // btn delete_all
                            // TODO: test
                            if (isset($_POST['delete_all'])) {
                                //$sql_delete_all = "TRUNCATE TABLE order_details";
                                $sql_delete_all = "DELETE FROM order_details WHERE OrderID = $order_id";
                                if (mysqli_query($conn, $sql_delete_all)) {
                                    echo "<script>alert('Xoá thành công')</script>";
                                    echo "<script>window.open('cart.php','_self')</script>";
                                }else {
                                    echo "Error: ".$sql."<br>".mysqli_error($conn);
                                }
                                
                            }
                            
                        } else {
                            echo "<div class='cart-item'>";
                            echo "<h3 style='text-align: center'>Chưa có sản phẩm</h3>";
                            echo "</div>";
                        }    
                        ?>

                    </form>
                </ul>
            </div>
            <a href="orders.php?order_id=<?php echo $order_id ?>"><button class="purchase_button">Thanh Toán</button></a>
        </div>
    </div>
</div>
<?php
require 'footer.php';
?>