<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Chi tiết sản phẩm</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php include 'includes/header.php'; ?>
    <section class="product-detail">
        <?php
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $result = mysqli_query($conn, "SELECT * FROM products WHERE id = $id");
            if ($result && $row = mysqli_fetch_assoc($result)) {
                echo "<h1>" . htmlspecialchars($row['name']) . "</h1>";
                echo "<img src='assets/images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['name']) . "'>";
                echo "<p>Giá: " . number_format($row['price']) . " VNĐ</p>";
                echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                echo "<a href='cart.php?add=" . $row['id'] . "' class='btn'>Thêm vào giỏ hàng</a>";
            } else {
                echo "<p>Sản phẩm không tồn tại.</p>";
            }
        } else {
            echo "<p>Không tìm thấy sản phẩm.</p>";
        }
        ?>
    </section>
    <?php include 'includes/footer.php'; ?>
</body>
</html>