<?php
session_start();
include '../database/dbhelper.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    if (!isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] = 0;
    }
    $_SESSION['cart'][$product_id] += $quantity;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $_SESSION['cart'][$product_id] = $quantity;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['remove'])) {
    $product_id = $_POST['product_id'];
    unset($_SESSION['cart'][$product_id]);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Giỏ hàng - Streetwear Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="container my-5">
        <h2 class="text-center mb-4">Giỏ hàng</h2>
        <?php
        $total = 0;
        if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
            echo "<table class='table table-striped'>";
            echo "<thead><tr><th>Sản phẩm</th><th>Số lượng</th><th>Giá</th><th>Tổng</th><th>Hành động</th></tr></thead>";
            echo "<tbody>";
            foreach ($_SESSION['cart'] as $product_id => $quantity) {
                $sql = "SELECT * FROM products WHERE id = $product_id";
                $product = executeResult($sql)[0];
                $subtotal = $product['price'] * $quantity;
                $total += $subtotal;
                echo "<tr>";
                echo "<td>" . htmlspecialchars($product['name']) . "</td>";
                echo "<td><form method='post'><input type='number' name='quantity' value='$quantity' min='1' class='form-control w-50'><input type='hidden' name='product_id' value='$product_id'><button type='submit' name='update' class='btn btn-sm btn-outline-secondary'>Cập nhật</button></form></td>";
                echo "<td>" . number_format($product['price']) . " VNĐ</td>";
                echo "<td>" . number_format($subtotal) . " VNĐ</td>";
                echo "<td><form method='post'><input type='hidden' name='product_id' value='$product_id'><button type='submit' name='remove' class='btn btn-sm btn-danger'>Xóa</button></form></td>";
                echo "</tr>";
            }
            echo "<tr><td colspan='3' class='text-end'><strong>Tổng cộng:</strong></td><td><strong>" . number_format($total) . " VNĐ</strong></td><td></td></tr>";
            echo "</tbody></table>";
            echo "<a href='/Frontend/checkout.php' class='btn btn-primary mt-3'>Thanh toán</a>";
        } else {
            echo "<p class='text-center'>Giỏ hàng trống.</p>";
        }
        ?>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>