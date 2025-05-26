<?php
session_start();
include '../database/dbhelper.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $note = $_POST['note'];
    $total = 0;
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT price FROM products WHERE id = ?";
        $product = executePrepared($sql, [$product_id])[0];
        $total += $product['price'] * $quantity;
    }
    $order_query = "INSERT INTO orders (user_id, total, status, created_at) VALUES (1, ?, 'pending', NOW())";
    executePrepared($order_query, [$total]);
    $order_id = $conn->insert_id;
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $sql = "SELECT price FROM products WHERE id = ?";
        $product = executePrepared($sql, [$product_id])[0];
        $detail_query = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        executePrepared($detail_query, [$order_id, $product_id, $quantity, $product['price']]);
    }
    unset($_SESSION['cart']);
    $dateTime = date('H:i, d/m/Y'); // Sử dụng thời gian hiện tại
    echo "<p class='alert alert-success text-center'>Đơn hàng đã được đặt lúc $dateTime! Vui lòng kiểm tra email.</p>";
}
$dateTime = date('H:i, d/m/Y'); // Sử dụng thời gian hiện tại
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Thanh toán - Streetwear Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <section class="container my-5">
        <h2 class="text-center mb-4">Thanh toán (Cập nhật: <?php echo $dateTime; ?>)</h2>
        <form method="post" class="border p-4">
            <div class="mb-3">
                <label class="form-label">Tên:</label><input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Địa chỉ:</label><input type="text" name="address" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Số điện thoại:</label><input type="text" name="phone" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Ghi chú:</label><textarea name="note" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Xác nhận thanh toán</button>
        </form>
    </section>

    <?php include 'footer.php'; ?>
</body>
</html>