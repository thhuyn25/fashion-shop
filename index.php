<?php
session_start();
include 'database/config.php';
include 'database/dbhelper.php';

$conn = createConnection();
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$products = executeResult($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Shopweb</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .promo-bar { background: #000; color: #fff; text-align: center; padding: 10px; }
        .products { max-width: 1200px; margin: 0 auto; padding: 20px; }
        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; }
        .product-item { border: 1px solid #ddd; padding: 15px; text-align: center; background: #fff; transition: box-shadow 0.3s; }
        .product-item:hover { box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        .product-item img { max-width: 100%; height: auto; }
        .btn { background: #000; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; }
        .btn:hover { background: #333; }
    </style>
</head>
<body>
    <div class="promo-bar">Miễn phí vận chuyển nội địa trên đơn hàng từ 500K.</div>
    <?php include 'fontend/header.php'; ?>

    <div class="products">
        <h1 class="text-center">Shopweb - Trang chủ</h1>
        <p class="text-center">Chào mừng đến với Shopweb!</p>
        <p class="text-center">Thời gian hiện tại: <?php echo date('H:i, d/m/Y'); ?></p>

        <div class="product-grid">
            <?php if (empty($products)): ?>
                <p class="text-center">Không có sản phẩm nào để hiển thị.</p>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-item">
                        <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                        <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                        <p class="price"><?php echo number_format($product['price'], 0, ',', '.'); ?> VNĐ</p>
                        <p><?php echo htmlspecialchars($product['description']); ?></p>
                        <a href="#" class="btn">Thêm vào giỏ</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php include 'fontend/footer.php'; ?>
</body>
</html>

<?php
$conn->close();
?>