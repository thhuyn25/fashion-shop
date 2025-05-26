<?php
include '../database/dbhelper.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <title>Trang chủ - Streetwear Shop</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Header -->
    <?php include 'header.php'; ?>

    <!-- Ưu đãi -->
    <div class="promo-bar">
        <p>Miễn phí vận chuyển với đơn hàng trên 500K. Hàng pre-order giảm thêm 5%!</p>
    </div>

    <!-- Main Content -->
    <main>
        <!-- Banner Chính -->
        <section class="main-banner">
            <div class="banner-image">
                <img src="../images/main-banner.jpg" alt="Banner Chính">
                <div class="banner-content">
                    <h2>Bộ Sưu Tập Mới Nhất</h2>
                    <p>Khám phá phong cách thời trang hiện đại</p>
                    <a href="/Frontend/category.php?type=new-arrivals" class="btn-cta">Xem ngay</a>
                </div>
            </div>
        </section>

        <!-- Danh Mục Nổi Bật -->
        <section class="featured-categories">
            <div class="container">
                <h2 class="section-title">Danh Mục Nổi Bật</h2>
                <div class="categories-grid">
                    <div class="category-item">
                        <a href="/Frontend/category.php?type=tops">
                            <img src="../images/category-tops.jpg" alt="Tops">
                            <h3>Tops</h3>
                        </a>
                    </div>
                    <div class="category-item">
                        <a href="/Frontend/category.php?type=bottoms">
                            <img src="../images/category-bottoms.jpg" alt="Bottoms">
                            <h3>Bottoms</h3>
                        </a>
                    </div>
                    <div class="category-item">
                        <a href="/Frontend/category.php?type=outerwear">
                            <img src="../images/category-outerwear.jpg" alt="Outerwear">
                            <h3>Outerwear</h3>
                        </a>
                    </div>
                    <div class="category-item">
                        <a href="/Frontend/category.php?type=accessories">
                            <img src="../images/category-accessories.jpg" alt="Accessories">
                            <h3>Accessories</h3>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sản Phẩm Nổi Bật -->
        <section class="featured-products">
            <div class="container">
                <h2 class="section-title">Sản Phẩm Nổi Bật</h2>
                <div class="products-grid">
                    <?php
                    $sql = "SELECT * FROM products LIMIT 4";
                    $products = executeResult($sql);
                    foreach ($products as $product) {
                        echo '<div class="product-item">';
                        echo '<a href="/Frontend/product_detail.php?id=' . $product['id'] . '">';
                        echo '<img src="../images/' . $product['image'] . '" alt="' . $product['name'] . '">';
                        echo '<h3>' . $product['name'] . '</h3>';
                        echo '<p class="price">' . number_format($product['price']) . ' VNĐ</p>';
                        if (isset($product['is_new']) && $product['is_new']) {
                            echo '<span class="badge new">New</span>';
                        }
                        echo '</a>';
                        echo '</div>';
                    }
                    ?>
                </div>
                <div class="view-all">
                    <a href="/Frontend/category.php" class="btn-view-all">Xem tất cả sản phẩm</a>
                </div>
            </div>
        </section>

        <!-- Banner Phụ -->
        <section class="secondary-banner">
            <div class="banner-image">
                <img src="../images/secondary-banner.jpg" alt="Banner Phụ">
                <div class="banner-content">
                    <h2>Giảm Giá Lên Đến 50%</h2>
                    <p>Ưu đãi có hạn, nhanh tay mua sắm!</p>
                    <a href="/Frontend/category.php?type=sale" class="btn-cta">Mua ngay</a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
</body>
</html>