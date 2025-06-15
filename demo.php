<?php
    include("connect.php");
?>

<html>
    <body>
    <div class="trailer">
    <div class="section-title">Trailer</div>
    <?php
        $sql = "SELECT trailer_url FROM movies";
        $result = mysqli_query($conn, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<iframe src='" . htmlspecialchars($row['trailer_url']) . "' allowfullscreen></iframe><br>";}
        } else {
            echo "<tr><td colspan='8'>Không có dữ liệu.</td></tr>";
        }
    ?>
</div>
</body>
</html>

