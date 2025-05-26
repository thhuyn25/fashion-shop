<?php
include '../database/dbhelper.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Liên hệ - Streetwear Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="container my-5">
            <h2 class="text-center mb-4">Liên hệ</h2>
            <div class="row">
                <div class="col-md-6">
                    <h3>Thông tin liên hệ</h3>
                    <p>Địa chỉ: 123 Đường ABC, Quận 1, TP.HCM</p>
                    <p>Điện thoại: <a href="tel:0123456789">0123 456 789</a></p>
                    <p>Email: <a href="mailto:your-email@example.com">your-email@example.com</a></p>
                </div>
                <div class="col-md-6">
                    <h3>Gửi tin nhắn</h3>
                    <form method="post" action="/Frontend/contact_submit.php" class="border p-4">
                        <div class="mb-3">
                            <label class="form-label">Tên:</label><input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email:</label><input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tin nhắn:</label><textarea name="message" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>