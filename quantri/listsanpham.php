<?php require('includes/header.php'); ?>

<div class="container-fluid">
    <h3 class="mb-4">Tất cả sản phẩm</h3>

    <?php
    // Bao gồm file dbhelper.php
    require_once('../database/dbhelper.php');

    // Tạo kết nối
    $conn = createConnection();

    // Câu lệnh SQL
    $sql_str = "SELECT * FROM products ORDER BY id";

    // Thực thi và lấy kết quả
    $result = executeResult($conn, $sql_str);

    // Hiển thị danh sách sản phẩm trong bảng
    if ($result) {
        ?>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Giá</th>
                                <th>Mô tả</th>
                                <th>Hình ảnh</th>
                                <th>Operation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($result as $row) {
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td><?= number_format($row['price'], 0, ',', '.') ?> VNĐ</td>
                                <td><?= htmlspecialchars($row['description']) ?></td>
                                <td><img src="../images/<?= htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" width="100"></td>
                                <td>
                                    <a class="btn btn-warning" href="editsp.php?id=<?= $row['id'] ?>">Edit</a>
                                    <a class="btn btn-danger" href="deletesp.php?id=<?= $row['id'] ?>" onclick="return confirm('Bạn chắc chắn xóa mục này?');">Delete</a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo '<div class="alert alert-warning">Không có sản phẩm nào được tìm thấy.</div>';
    }

    // Đóng kết nối
    $conn->close();
    ?>
</div>


<style>

.btn-warning {
    background-color: #ffc107 !important; /* Màu vàng chuẩn của Bootstrap */
    color: #212529 !important; /* Màu chữ tối để dễ đọc */
    border-color: #ffc107 !important; /* Đường viền cùng màu */
}

/* Hiệu ứng hover cho nút Edit */
.btn-warning:hover {
    background-color: #e0a800 !important; /* Màu vàng đậm hơn khi hover */
    border-color: #e0a800 !important;
}
</style>

<?php require('includes/footer.php'); ?>