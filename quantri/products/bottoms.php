<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../includes/header.php');
?>

<div class="container-fluid">
    <h3 class="mb-4">Tất cả sản phẩm</h3>

    <?php
    // Bao gồm file dbhelper.php
    require_once('../../database/dbhelper.php');

    // Tạo kết nối
    $conn = createConnection();
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }

    // Câu lệnh SQL
    $sql_str = "SELECT * FROM products WHERE category_id = 2 ORDER BY name";

    // Thực thi và lấy kết quả
    $result = executeResult($conn, $sql_str);
    if ($result === false) {
        echo "Lỗi truy vấn: " . $conn->error;
    } else {
        if ($result && !empty($result)) {
            ?>
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Danh sách sản phẩm Bottoms</h6>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result as $row) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                    echo "<td>" . number_format($row['price'], 0, ',', '.') . " VNĐ</td>";
                                    echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                                    $imagePath = '../../images/' . htmlspecialchars($row['image']);
                                    echo "<td><img src='$imagePath' alt='" . htmlspecialchars($row['name']) . "' width='100' onerror='this.src=\"../../images/default.jpg\";'></td>";
                                    echo "</tr>";
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
    }

    // Đóng kết nối
    $conn->close();
    ?>
</div>

<?php require('../includes/footer.php'); ?>