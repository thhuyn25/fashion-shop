<?php
// Lấy id từ URL
$delid = $_GET['id'];

// Kết nối CSDL
require_once('../database/dbhelper.php');

// Tạo kết nối
$conn = createConnection();

// Câu lệnh SQL (sửa lỗi cú pháp: bỏ * trong DELETE)
$sql_str = "DELETE FROM products WHERE id=$delid";

// Thực thi câu lệnh trực tiếp với mysqli_query
if (mysqli_query($conn, $sql_str)) {
    // Nếu xóa thành công, chuyển hướng
    header("location:listsanpham.php");
} else {
    // Nếu thất bại, vẫn chuyển hướng (giữ nguyên logic gốc không xử lý lỗi)
    header("location:listsanpham.php");
}

// Đóng kết nối (tùy chọn, nếu dbhelper.php không tự đóng)
$conn->close();