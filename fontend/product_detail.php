<?php
include '../database/dbhelper.php';
$product_id = isset($_GET['id']) ? $_GET['id'] : 0;
$sql = "SELECT * FROM products WHERE id = $product_id";
$products = executeResult($sql);
$product = count($products) > 0 ? $products[0] : null;
$color = ['ColorName' => 'Đen']; // Giả định, cần bảng colors nếu có
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Chi tiết sản phẩm - Streetwear Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <div class="container my-5">
            <div class="breadcrumb">
                <a href="/Frontend/index.php" class="text-dark">Trang chủ</a> >
                <a href="/Frontend/category.php?type=<?php echo $product['category']; ?>" class="text-dark"><?php echo ucfirst($product['category']); ?></a> >
                <span class="text-muted"><?php echo $product['name']; ?></span>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="product-gallery">
                        <img src="../images/<?php echo $product['image']; ?>" alt="IMG-PRODUCT" class="img-fluid">
                        <!-- Thêm các ảnh phụ nếu có (Image2, Image3) -->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-details">
                        <h2 class="product-title"><?php echo $product['name']; ?></h2>
                        <p class="product-price"><?php echo number_format($product['price']); ?> VND</p>
                        <p class="product-desc"><?php echo $product['description']; ?></p>
                        <p class="product-color">Màu sắc: <?php echo $color['ColorName']; ?></p>
                        <form method="post" action="/Frontend/cart.php">
                            <div class="form-group mb-3">
                                <label>Kích thước</label>
                                <select name="size" class="form-control">
                                    <option>S</option>
                                    <option>M</option>
                                    <option>L</option>
                                    <option>XL</option>
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label>Số lượng</label>
                                <?php
                                $available = $product['quantity'] - (isset($_SESSION['cart'][$product_id]) ? $_SESSION['cart'][$product_id] : 0);
                                if ($available <= 0) {
                                    echo '<p class="text-danger">Hết hàng!</p>';
                                } else {
                                    echo '<select name="quantity" class="form-control">';
                                    for ($i = 1; $i <= $available && $i <= 10; $i++) {
                                        echo '<option>' . $i . '</option>';
                                    }
                                    echo '</select>';
                                    echo '<input type="hidden" name="product_id" value="' . $product_id . '">';
                                    echo '<button type="submit" name="add_to_cart" class="btn btn-dark mt-3">Thêm vào giỏ</button>';
                                }
                                ?>
                            </div>
                        </form>
                        <div class="product-categories mt-3">
                            <span>Danh mục: <?php echo ucfirst($product['category']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>
</body>
</html>