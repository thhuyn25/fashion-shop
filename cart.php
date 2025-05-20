if (isset($_GET['add'])) {
    $product_id = intval($_GET['add']);
    $user_id = 1; // Giả sử user_id = 1, cần xử lý đăng nhập sau
    mysqli_query($conn, "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)");
}