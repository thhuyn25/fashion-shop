<?php
session_start();
include '../database/dbhelper.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Hoàn tất - Streetwear Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="container my-5">
            <h2 class="text-center mb-4">Hoàn tất đơn hàng</h2>
            <p class="text-center">Cảm ơn bạn đã đặt hàng! Đơn hàng của bạn đã được xử lý thành công. Vui lòng kiểm tra email để biết thêm chi tiết.</p>
            <p class="text-center"><a href="/Frontend/index.php" class="btn btn-primary">Tiếp tục mua sắm</a></p>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>