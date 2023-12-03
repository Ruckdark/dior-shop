<!-- About us -->
<div class="container">
    <div class="body-item active" style="margin-left: 170px; margin-top: 60px;">
        <div class="products_list col"></div>
        <?php
        echo "<h1 style='text-align:center; margin-left: -120px'>Sản phẩm mới nhất</h1>";
        ?>
        <div class="product" >
            <?php
                $sql_select = "SELECT `ProductID`, `ProductName`, `ProductPrice`, `ProductImage` FROM products ORDER BY ProductID DESC LIMIT 12";
                $result = mysqli_query($conn ,$sql_select);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_id = $row['ProductID'];
                        echo "<div class='product-item'>";
                        echo "<a href='details.php?product_id=$product_id'><img src='".$row["ProductImage"]."' alt='".$row["ProductName"]."'></a>";
                        echo "<h2>".$row["ProductName"]."</h2>";
                        echo "<p>Giá: ".$row["ProductPrice"]." VND</p>";
                        echo "</div>";
                    }
                }
            ?>
        </div>
    </div>
</div>
