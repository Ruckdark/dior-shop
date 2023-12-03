<?php
// details.php
function CalculatePrice($conn, $order_id, $product_id)
{
    // Lấy thông tin của sản phẩm trong cùng 1 giỏ hàng
    $sql_select = "SELECT * FROM order_details WHERE OrderID = $order_id AND ProductID = $product_id";
    $result = mysqli_query($conn, $sql_select);

    // tính số tiền sản phẩm của 1 mặt hàng và cập nhật
    $price = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $price += $row['Quantity'] * $row['Price'];
        $sql_update = "UPDATE order_details SET Price = $price WHERE OrderID = $order_id AND ProductID = $product_id";
        mysqli_query($conn, $sql_update);
    }
}
function CalculateTotalAmount($conn, $order_id)
{
    // Lấy tất cả các mặt hàng trong cùng 1 giỏ hàng
    $sql_select = "SELECT * FROM order_details WHERE OrderID = $order_id";
    $result = mysqli_query($conn, $sql_select);

    // Tính tổng số tiền
    $total_amount = 0;
    while ($row = mysqli_fetch_assoc($result)) {
        $total_amount += $row['Price'];
    }

    // Cập nhật TotalAmount trong bảng orders
    $sql_update = "UPDATE orders SET TotalAmount = $total_amount WHERE OrderID = $order_id";
    mysqli_query($conn, $sql_update);
}
function AddToCart($conn, $user_id, $product_id, $quantity, $price)
{
    // Tìm giỏ hàng cuối cùng của người dùng chưa được thanh toán
    /* OrderStatus = 0 => chưa chốt đơn hàng
                   = 1 => đã chốt đơn hàng */
    $sql_select = "SELECT * FROM orders WHERE UserID = $user_id AND OrderStatus = 0 ORDER BY OrderID DESC LIMIT 1";
    $result = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        // Nếu giỏ hàng chưa được thanh toán tồn tại, lấy OrderID ($row > 0 == true)
        $order_id = $row['OrderID'];
    } else {
        // Nếu không, tạo một giỏ hàng mới ($row = 0)
        $sql_insert = "INSERT INTO orders(UserID, OrderDate, TotalAmount, OrderStatus) VALUES ($user_id, NOW(), 0, 0)";
        mysqli_query($conn, $sql_insert);
        $order_id = mysqli_insert_id($conn);
    }
    // Kiểm tra xem sản phẩm đã có trong giỏ hàng hay chưa
    $sql_check_product = "SELECT * FROM order_details WHERE OrderID = $order_id AND ProductID = $product_id";
    $result = mysqli_query($conn, $sql_check_product);
    if (mysqli_num_rows($result) > 0) {
        // Nếu sản phẩm đã có trong giỏ hàng, hiển thị thông báo và không thêm sản phẩm
        echo "<script>alert('Sản phẩm đã có trong giỏ hàng')</script>";
    } else {
        // Nếu sản phẩm chưa có trong giỏ hàng, thêm sản phẩm vào giỏ hàng
        // Thêm sản phẩm vào giỏ hàng
        $sql_insert = "INSERT INTO order_details(OrderID, ProductID, Quantity, Price) VALUES ($order_id, $product_id, $quantity, $price)";
        mysqli_query($conn, $sql_insert);

        // Cập nhật TotalAmount
        CalculatePrice($conn, $order_id, $product_id);
        CalculateTotalAmount($conn, $order_id);
    }
}
function DeleteProduct($conn, $product_id){
    $sql_delete = "DELETE FROM products WHERE ProductID = $product_id";
    if (mysqli_query($conn, $sql_delete)) {
        echo "<script>alert('Xoá mặt hàng thành công')</script>";
    }else{
        echo "<script>alert('Error')</script>";
    }

}
