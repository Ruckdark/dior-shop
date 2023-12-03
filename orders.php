<?php
    require 'header.php';
?>
<div id="body">
<?php
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];
        $user_id = $_SESSION['user_id'];
        $sql_select = "SELECT * FROM orders WHERE OrderID = $order_id AND UserID = $user_id";
        $result = mysqli_query($conn, $sql_select);
        $row = mysqli_fetch_assoc($result);
        $date = $row['OrderDate'];
        $total_amount = $row['TotalAmount'];
        $status = $row['OrderStatus'];
        echo "<table class='order_table'>";
        echo "<tr><th>Mã đơn hàng</th><th>User ID</th><th>Ngày đặt hàng</th><th>Trạng thái</th></tr>";
        echo "<tr><td>$order_id</td><td>$user_id</td><td>$date</td><td>";
        if ($status == 0) {
            echo "Đang chờ xử lý";
        }else{
            echo "Đã xác nhận đơn hàng";
        }
        echo "</td></tr>";
        echo "</table>";
        }
?>
</div>

    
<?php
    require 'footer.php';
?>
