<?php
require 'header.php';
?>
<style>
    @media(max-width:900px) {
        #body .body-item .product {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
<div id="body">
    <!-- Products body -->
    <div class="body-item active">

        <form id="search-box" method="post" action="">
            <input id="search-input" type="text" placeholder="Nhập sản phẩm cần tìm..." value="" name="search-input">

            <button type="submit" name="search" id="search-icon">

                <i class="fa-solid fa-magnifying-glass">

                </i>
            </button>

        </form>

        <div class="container">
            <!-- Categories -->
            <div class="products_list col" id="products_list">
                <ul id="list_1">
                    <li>
                        <h4>Phân loại</h4>
                    </li>
                    <?php
                    $sql_select = "SELECT * FROM categories";
                    $result = mysqli_query($conn, $sql_select);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $category_id = $row['CategoryID'];
                            $category_name = $row['CategoryName'];
                            if (isset($_GET['cate_id']) && $_GET['cate_id'] == $category_id) {
                                echo "<li>
                                    <a class='category-button-active' href='products.php?cate_id=$category_id'>$category_name</a>
                                </li>";
                            } else {
                                echo "<li>
                                    <a class='category-button' href='products.php?cate_id=$category_id'>$category_name</a>
                                </li>";
                            }
                        }
                    } else {
                        echo "<li>Không có danh mục</li>";
                    }
                    ?>
                </ul>

                <ul id="list_2">
                    <li>
                        <h5>Chưa nghĩ ra</h5>
                    </li>
                    <li>
                        <p>#</p>
                    </li>
                    <li>
                        <p>#</p>
                    </li>
                </ul>
            </div>
            <!-- Products -->
            <div class="product">
                <?php
                // phân trang ,mỗi trang 12 sản phẩm
                $per_page = 12;
                // nếu tham số page có tồn tại thì gán giá trị của tham số page cho biến $page nếu ko thì gán là 1
                // xác định biến $page để xác định trang hiện tại là trang bao nhiêu và tính toán sản phẩm bắt đầu cho mỗi trang ($start_from)
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    // truy cập vào trang mà không chỉ định tham số page, người dùng sẽ được chuyển hướng đến trang đầu tiên.
                    $page = 1;
                }
                // sản phẩm mỗi trang bắt đầu từ (số trang -1) nhân với 12
                $start_from = ($page - 1) * $per_page;
                
                if (isset($_POST['search'])) {
                    $search_keyword = $_POST['search-input'];

                    $sql_search = "SELECT * FROM products WHERE ProductName LIKE '%$search_keyword%' LIMIT $start_from, $per_page";
                    $result = mysqli_query($conn, $sql_search);

                    if (mysqli_num_rows($result) > 0) {
                        echo "<script>alert('Kết quả tìm kiếm cho: $search_keyword')</script>";
                        while ($row = mysqli_fetch_assoc($result)) {
                            $product_id = $row['ProductID'];
                            echo "<div class='product-item'>";
                            echo "<a href='details.php?product_id=$product_id'><img src='" . $row["ProductImage"] . "' alt='" . $row["ProductName"] . "'></a>";
                            echo "<h2>" . $row["ProductName"] . "</h2>";
                            echo "<p>Giá: " . $row["ProductPrice"] . " VND</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<script>alert('Không tìm thấy sản phẩm phù hợp')</script>";
                    }
                }
                // Kiểm tra xem có chọn vào danh mục nào không
                if (!isset($_GET['cate_id']) && !isset($_POST['search'])) {
                    // nếu không thì xuất ra toàn bộ sản phẩm
                    $sql_select = "SELECT ProductID, ProductName, ProductDescription, ProductPrice, ProductImage FROM Products ORDER BY ProductID DESC LIMIT $start_from, $per_page";
                    $result = mysqli_query($conn, $sql_select);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $product_id = $row['ProductID'];
                            echo "<div class='product-item'>";
                            echo "<a href='details.php?product_id=$product_id'><img src='" . $row["ProductImage"] . "' alt='" . $row["ProductName"] . "'></a>";
                            echo "<h2>" . $row["ProductName"] . "</h2>";
                            echo "<p>Giá: " . $row["ProductPrice"] . " VND</p>";
                            echo "</div>";
                        }
                    } else {
                        echo "<script>alert('Lỗi: Vui lòng chọn một phân loại.')</script>";
                    }
                } else if(isset($_GET['cate_id']) && !isset($_POST['search'])) {
                    // nếu có thì xuất ra sản phẩm dựa theo danh mục
                    $cate_id = $_GET['cate_id'];
                    $sql_select = "SELECT * FROM `products` WHERE `CategoryID` = $cate_id ORDER BY ProductID DESC LIMIT $start_from, $per_page";
                    $result = mysqli_query($conn, $sql_select);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $product_id = $row['ProductID'];
                            echo "<div class='product-item'>";
                            echo "<a href='details.php?product_id=$product_id'><img src='" . $row["ProductImage"] . "' alt='" . $row["ProductName"] . "'></a>";
                            echo "<h2>" . $row["ProductName"] . "</h2>";
                            echo "<p>Giá: " . $row["ProductPrice"] . " VND</p>";
                            echo "</div>";
                        }
                    }
                }
                

                ?>

            </div>

        </div>
    </div>
    <!-- Pagination page -->
    <div class="body-item active" style="text-align: center; margin:80px">
        <div class="pagination-page">
            <?php
            // kiểm tra xem có chọn vào danh mục nào không
            if (isset($_POST['search'])) {
                $sql_select = "SELECT * FROM products ";

                $result = mysqli_query($conn, $sql_select);
                // tính số cột được trả về khi thực thi câu truy vấn
                $total = mysqli_num_rows($result);
                // tính số trang ,hàm làm tròn lên
                $total_pages = ceil($total / $per_page);
                // Hiển thị nút lùi về đầu trang (trang 1)
                if ($page > 1) {
                    echo "<a class='pagination-button' href='products.php?page=1'><<</a> ";
                }

                // Hiển thị nút lùi 1 trang
                if ($page > 1) {
                    echo "<a class='pagination-button' href='products.php?page=" . ($page - 1) . "'><</a> ";
                }
                // Hiển thị liên kết đến các trang
                for ($i = 1; $i <= $total_pages; $i++) {
                    // kiểm tra xem đây có phải là trang hiện tại đang hiển thị không
                    if ($i == $page) {
                        // nếu đúng thì sử dụng lớp pagination-button-active để làm nổi bật nút liên kết đến các trang
                        echo "<a class='pagination-button-active' href='products.php?page=$i'>$i</a> ";
                    } else {
                        // nếu không thì sử dụng lớp pagination-button
                        echo "<a class='pagination-button' href='products.php?page=$i'>$i</a> ";
                    }
                }

                // Hiển thị nút tiến 1 trang
                if ($page < $total_pages) {
                    echo "<a class='pagination-button' href='products.php?page=" . ($page + 1) . "'>></a> ";
                }

                // Hiển thị nút tiến cuối trang (trang cuối cùng)
                if ($page < $total_pages) {
                    echo "<a class='pagination-button' href='products.php?page=$total_pages'>>></a> ";
                }
            }
            if (!isset($_GET['cate_id']) && !isset($_POST['search'])) {
                // nếu không thì hiển thị các nút liên kết đến từng trang chứa tất cả các sản phẩm
                $sql_select = "SELECT * FROM products ";

                $result = mysqli_query($conn, $sql_select);
                // tính số cột được trả về khi thực thi câu truy vấn
                $total = mysqli_num_rows($result);
                // tính số trang ,hàm làm tròn lên
                $total_pages = ceil($total / $per_page);
                // Hiển thị nút lùi về đầu trang (trang 1)
                if ($page > 1) {
                    echo "<a class='pagination-button' href='products.php?page=1'><<</a> ";
                }

                // Hiển thị nút lùi 1 trang
                if ($page > 1) {
                    echo "<a class='pagination-button' href='products.php?page=" . ($page - 1) . "'><</a> ";
                }
                // Hiển thị liên kết đến các trang
                for ($i = 1; $i <= $total_pages; $i++) {
                    // kiểm tra xem đây có phải là trang hiện tại đang hiển thị không
                    if ($i == $page) {
                        // nếu đúng thì sử dụng lớp pagination-button-active để làm nổi bật nút liên kết đến các trang
                        echo "<a class='pagination-button-active' href='products.php?page=$i'>$i</a> ";
                    } else {
                        // nếu không thì sử dụng lớp pagination-button
                        echo "<a class='pagination-button' href='products.php?page=$i'>$i</a> ";
                    }
                }

                // Hiển thị nút tiến 1 trang
                if ($page < $total_pages) {
                    echo "<a class='pagination-button' href='products.php?page=" . ($page + 1) . "'>></a> ";
                }

                // Hiển thị nút tiến cuối trang (trang cuối cùng)
                if ($page < $total_pages) {
                    echo "<a class='pagination-button' href='products.php?page=$total_pages'>>></a> ";
                }
            } else if(isset($_GET['cate_id']) && !isset($_POST['search'])){
                // nếu có thì hiển thị các nút liên kết đến từng trang chứa các sản phẩm dựa theo danh mục đó
                $cate_id = $_GET['cate_id'];
                $sql_select = "SELECT * FROM products WHERE CategoryID = $cate_id";
                
                $result = mysqli_query($conn, $sql_select);
                // tính số cột được trả về khi thực thi câu truy vấn
                $total = mysqli_num_rows($result);
                // tính số trang ,hàm làm tròn lên
                $total_pages = ceil($total / $per_page);
                // Hiển thị nút lùi về đầu trang (trang 1)
                if ($page > 1) {
                    echo "<a class='pagination-button' href='products.php?page=1&cate_id=$cate_id'><<</a> ";
                }

                // Hiển thị nút lùi 1 trang
                if ($page > 1) {
                    echo "<a class='pagination-button' href='products.php?page=" . ($page - 1) . "&cate_id=$cate_id'><</a> ";
                }
                // Hiển thị liên kết đến các trang
                for ($i = 1; $i <= $total_pages; $i++) {
                    // kiểm tra xem đây có phải là trang hiện tại đang hiển thị không
                    if ($i == $page) {
                        // nếu đúng thì sử dụng lớp pagination-button-active để làm nổi bật nút liên kết đến các trang
                        echo "<a class='pagination-button-active' href='products.php?page=$i&cate_id=$cate_id'>$i</a> ";
                    } else {
                        // nếu không thì sử dụng lớp pagination-button
                        echo "<a class='pagination-button' href='products.php?page=$i&cate_id=$cate_id'>$i</a> ";
                    }
                }

                // Hiển thị nút tiến 1 trang
                if ($page < $total_pages) {
                    echo "<a class='pagination-button' href='products.php?page=" . ($page + 1) . "&cate_id=$cate_id'>></a> ";
                }
                
                // Hiển thị nút tiến cuối trang (trang cuối cùng)
                if ($page < $total_pages) {
                    echo "<a class='pagination-button' href='products.php?page=$total_pages&cate_id=$cate_id'>>></a> ";
                }
            }
            ?>
        </div>

    </div>

    <!-- News -->
    <div class="body-item">
        <div id="news">
        </div>
    </div>

    <!-- cart-page -->
    <div class="body-item">
        <div id="cart-page">

        </div>
    </div>
</div>
<?php
require 'footer.php';
?>