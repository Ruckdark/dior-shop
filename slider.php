<!-- Slider -->
<div class="slider">
    <div class="list">
        <!-- Image -->
        <?php

        $sql_select = "SELECT SliderID, SliderImage, SliderName, SliderDescription FROM slider ORDER BY SliderID DESC";
        $result = mysqli_query($conn, $sql_select);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='item'>";
                echo "<img src='" . $row['SliderImage'] . "' alt='" . $row['SliderName'] . "'>";
                echo "</div>";
            }
        } else {
            echo "<div class='item'>
                    <img src='./assets/IMG/PRODUCTS IMG/1.0.02.3.22.002.223.23-11000032-bst-1_5.jpg' alt=''>
                </div>";
            echo "<div class='item'>
                    <img src='./assets/IMG/PRODUCTS IMG/1.0.02.3.22.002.223.23-11000032-bst-1_5.jpg' alt=''>
                </div>";
        }
        ?>

    </div>

    <!-- Button prev and next -->
    <div class="buttons">
        <button id="prev"><</button>
        <button id="next">></button>
    </div>

    <!-- Dots -->
    <ul class="dots">
        <li class="active"></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>

<script src="./js/slider.js"></script>