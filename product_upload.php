<?php
require_once 'header.php';
?>
<div id="body">
    <div class="container">
        <h2>Thêm Mặt Hàng</h2>
        <form action="product_upload.php" method="post" enctype="multipart/form-data">

            <div>
                <input type="text" name="product_name" placeholder="Tên mặt hàng" required><br>
            </div>
            <!-- <label for="product_type">Product type:</label> -->




            <!-- <label for="product_description">Product Description:</label> -->
            <div>
                <input type="text" name="product_description" placeholder="Miêu tả mặt hàng" required></textarea><br>
            </div>

            <!-- <label for="product_price">Product Price:</label> -->
            <div>
                <input type="text" name="product_price" placeholder="Giá mặt hàng" required><br>
            </div>

            <select name="product_type" required>
                <option value="0">Phân loại</option>
                <option value="1">Áo</option>
                <option value="2">Quần</option>
                <option value="3">Giày</option>
                <option value="4">Trang sức</option>
                <option value="5">Túi xách</option>
                <option value="6">Mũ</option>
            </select><br><br>

            <!-- <label for="product_image">Product Image:</label> -->
            <div>
                <input type="file" name="product_image" accept="image/*" required><br>
            </div>

            <input type="submit" name="submit" value="Upload Product">

        </form>
    </div>
</div>

<?php
if (isset($_POST["submit"])) {
    $upload_dir = 'images/uploads/';

    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    // Kiểm tra nếu giá tiền không phải là số
    if (!is_numeric($product_price)) {
        echo "<script>alert('Lỗi: Giá tiền phải là số.')</script>";
        $uploadOk = 0;
    }
    $product_type = $_POST['product_type'];
    // Kiểm tra nếu không chọn phân loại hoặc phân loại bằng 0
    if ($product_type == 0) {
        echo "<script>alert('Lỗi: Vui lòng chọn một phân loại.')</script>";
        $uploadOk = 0;
    }

    $target_file = $upload_dir . basename($_FILES["product_image"]["name"]);
    $file_name = $_FILES["product_image"]["name"];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra nếu tệp đã tồn tại
    if (file_exists($target_file)) {
        echo "<script>alert('Lỗi: Tệp đã tồn tại.')</script>";
        $uploadOk = 0;
    }

    // Kiểm tra kích thước của tệp
    if ($_FILES["product_image"]["size"] > 2 * 1024 * 1024) {
        echo "<script>alert('Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.')</script>";
        $uploadOk = 0;
    }

    // Kiểm tra định dạng tệp
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"  && $imageFileType != "gif") {
        echo "<script>alert('Lỗi: Chỉ cho phép các tệp JPG, JPEG, PNG và GIF.')</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
            $sql_insert = "INSERT INTO products(CategoryID, ProductName, ProductDescription, ProductPrice, ProductImage)
                            VALUES ('$product_type', '$product_name', '$product_description', '$product_price', '$target_file')";
            if (mysqli_query($conn, $sql_insert)) {
                echo "<script>alert('{$file_name} Tải lên thành công.')</script>";
            } else {
                echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        }
    }
    echo "<script>window.open('product_upload.php','_self')</script>";
}
?>
<?php
require_once 'footer.php';
?>