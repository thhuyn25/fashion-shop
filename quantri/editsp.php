<?php
// Lấy id từ URL
$editid = isset($_GET['id']) ? $_GET['id'] : 0;

// Kết nối CSDL
require_once('../database/dbhelper.php');

// Tạo kết nối
$conn = createConnection();

// Lấy thông tin sản phẩm hiện tại để hiển thị trong form
$sql_select = "SELECT * FROM products WHERE id=$editid";
$result = executeResult($conn, $sql_select);
$product = $result ? $result[0] : null;

if (!$product) {
    // Nếu không tìm thấy sản phẩm, chuyển hướng về trang danh sách
    header("location:listsanpham.php");
    exit;
}

// Xử lý form khi submit (cập nhật sản phẩm)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = floatval($_POST['price']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Xử lý upload hình ảnh
    $image = $product['image']; // Giữ hình ảnh cũ nếu không upload mới
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "../images/";
        $image_name = time() . "_" . basename($_FILES['image']['name']);
        $target_file = $target_dir . $image_name;

        // Kiểm tra loại file (chỉ cho phép hình ảnh)
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($imageFileType, $allowed_types)) {
            // Di chuyển file upload vào thư mục
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                $image = $image_name; // Cập nhật tên file mới
            }
        }
    }

    // Câu lệnh SQL để cập nhật
    $sql_update = "UPDATE products SET name='$name', price=$price, description='$description', image='$image' WHERE id=$editid";

    // Thực thi câu lệnh bằng mysqli_query
    if (mysqli_query($conn, $sql_update)) {
        // Nếu cập nhật thành công, chuyển hướng
        header("location:listsanpham.php");
    } else {
        // Nếu thất bại, vẫn chuyển hướng (giữ logic giống deletesp.php)
        header("location:listsanpham.php");
    }

    // Đóng kết nối
    $conn->close();
    exit;
}
?>

<?php require('includes/header.php'); ?>

<div class="container-fluid">
    <h3 class="mb-4">Chỉnh sửa sản phẩm</h3>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Tên sản phẩm</label>
                    <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
                </div>
                <div class="form-group">
                    <label>Giá</label>
                    <input type="number" class="form-control" name="price" value="<?= $product['price'] ?>" required>
                </div>
                <div class="form-group">
                    <label>Mô tả</label>
                    <textarea class="form-control" name="description"><?= htmlspecialchars($product['description']) ?></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Hình ảnh:</label>
                    <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                    <small>Hình ảnh hiện tại: <img src="../images/<?= htmlspecialchars($product['image']) ?>" width="100" alt="Current Image"></small>
                </div>
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a href="listsanpham.php" class="btn btn-secondary">Hủy</a>
            </form>
        </div>
    </div>
</div>

<?php require('includes/footer.php'); ?>