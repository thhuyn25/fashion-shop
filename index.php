<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Trang chủ - Cửa hàng thời trang</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Liên kết tới file CSS -->
</head>
<body>
    <!-- Header -->
    <?php include 'includes/header.php'; ?>

    <!-- Ưu đãi -->
    <div class="promo-bar">
        <p>Miễn phí vận chuyển với đơn hàng trên 500K. Hàng pre-order giảm thêm 5%!</p>
    </div>

    <!-- Danh sách sản phẩm -->
    <section class="products">
        <h1>Sản phẩm</h1>
        <div class="product-grid">
            <?php
            if ($conn) {
                $result = mysqli_query($conn, "SELECT * FROM products");
                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='product-item'>";
                        echo "<img src='assets/images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                        echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                        echo "<p>Giá: " . number_format($row['price']) . " VNĐ</p>";
                        echo "<a href='product_detail.php?id=" . $row['id'] . "' class='btn'>Xem chi tiết</a>";
                        echo "</div>";
                    }
                    mysqli_free_result($result);
                } else {
                    echo "<p>Không thể tải sản phẩm: " . mysqli_error($conn) . "</p>";
                }
            } else {
                echo "<p>Kết nối cơ sở dữ liệu thất bại.</p>";
            }
            ?>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'includes/footer.php'; ?>
</body>
</html>