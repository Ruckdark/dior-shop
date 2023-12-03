<div id="body">
    <form action="profile.php" method="POST" enctype="multipart/form-data">

        <h2>Upload Files</h2>


        <p>
            Select files to upload:

            <!-- name of the input fields are going to
                be used in our php script-->
            
            <input type="file" name="files[]" multiple>

            <br><br>

            <input type="submit" name="submit" value="Upload">
        </p>

    </form>
</div>
<?php

if (isset($_POST['submit'])) {

    // Cấu hình thư mục lưu trữ và loại tệp cho phép
    $upload_dir = 'images/uploads/';
    $allowed_types = array('jpg', 'png', 'jpeg', 'gif');

    // Xác định kích thước tối đa cho tệp, ví dụ 2MB
    $maxsize = 2 * 1024 * 1024;

    // Kiểm tra xem người dùng đã gửi biểu mẫu trống không
    if (!empty(array_filter($_FILES['files']['name']))) {

        // Lặp qua từng tệp trong mảng files[]
        foreach ($_FILES['files']['tmp_name'] as $key => $value) {

            $file_tmpname = $_FILES['files']['tmp_name'][$key];
            $file_name = $_FILES['files']['name'][$key];
            $file_size = $_FILES['files']['size'][$key];
            $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);

            // Đặt đường dẫn lưu trữ tệp
            $filepath = $upload_dir . $file_name;

            // Kiểm tra xem loại tệp có được cho phép hay không
            // in_array(): kiểm tra xem một giá trị cụ thể có tồn tại trong một mảng hay không
            if (in_array(strtolower($file_extension), $allowed_types)) {

                // Xác minh kích thước tệp - tối đa 2MB 
                if ($file_size > $maxsize)
                    echo "<script>alert('Lỗi: Kích thước tệp lớn hơn giới hạn cho phép.')</script>";

                // Nếu tệp đã tồn tại, thêm thời gian phía trước tên tệp để tránh ghi đè tệp
                if (file_exists($filepath)) {
                    $filepath = $upload_dir . time() . $file_name;

                    if (move_uploaded_file($file_tmpname, $filepath)) {
                        echo "<script>alert('{$file_name} Tải lên thành công.')</script>";
                        $sql_insert = "INSERT INTO products(ProductName, ProductDescription, ProductPrice, ProductImage)
                                        VALUES ()";
                    } else {
                        echo "<script>alert('Lỗi khi tải lên {$file_name}.')</script>";
                    }
                    
                } else {

                    if (move_uploaded_file($file_tmpname, $filepath)) {
                        echo "<script>alert('{$file_name} Tải lên thành công.')</script>";
                    } else {
                        echo "<script>alert('Lỗi khi tải lên {$file_name}')</script>";
                    }
                    
                }
            } else {

                // Nếu phần mở rộng của tệp không hợp lệ
                echo "<script>alert('Lỗi khi tải lên {$file_name}.({$file_extension} không được phép)')</script>";
            }
        }
        
    } else {

        // Nếu không có tệp nào được chọn
        echo "<script>alert('Không có tệp nào được chọn.')</script>";
    }
    
    echo "<script>window.open('profile.php','_self')</script>";
                    
}

?>