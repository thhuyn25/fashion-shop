<?php
require_once('../database/dbhelper.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $image = '';

    // Xử lý upload ảnh
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../images/";
        // Tạo thư mục nếu chưa tồn tại
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $image = basename($_FILES['image']['name']);
        } else {
            echo "Lỗi khi tải ảnh lên.";
            exit();
        }
    } else {
        echo "Không có ảnh được tải lên.";
        exit();
    }

    // Thêm sản phẩm vào cơ sở dữ liệu
    $conn = createConnection();
    $sql = "INSERT INTO products (name, price, description, image, category_id) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdssi", $name, $price, $description, $image, $category_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Chuyển hướng về trang danh sách
    header("Location: listsanpham.php");
    exit();
}
?>