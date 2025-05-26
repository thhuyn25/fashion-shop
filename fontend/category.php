<?php
// Include file hỗ trợ kết nối (không cần session_start vì đã gọi từ header.php)
include '../database/dbhelper.php';
$category = isset($_GET['type']) ? $_GET['type'] : 'all';
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Danh mục - Streetwear Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css"> <!-- Điều chỉnh đường dẫn CSS -->
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <section class="container my-5">
            <h2 class="text-center mb-4">Danh mục: <?php echo ucfirst(str_replace('-', ' ', $category)); ?></h2>
            <div class="product-grid">
                <?php
                $sql = "SELECT * FROM products";
                if ($category != 'all') {
                    $sql .= " WHERE category = '$category'";
                }
                $products = executeResult($sql);
                if (count($products) > 0) {
                    foreach ($products as $product) {
                        echo '<div class="product-item">';
                        echo '<a href="product_detail.php?id=' . htmlspecialchars($product['id']) . '">';
                        echo '<img src="../images/' . htmlspecialchars($product['image']) . '" alt="' . htmlspecialchars($product['name']) . '">';
                        echo '<h3>' . htmlspecialchars($product['name']) . '</h3>';
                        echo '<p class="price">' . number_format($product['price'], 0, ',', '.') . ' VNĐ</p>';
                        if (isset($product['is_new']) && $product['is_new']) {
                            echo '<span class="badge new">New</span>';
                        }
                        echo '</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="text-center">Không có sản phẩm trong danh mục này.</p>';
                }
                ?>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>