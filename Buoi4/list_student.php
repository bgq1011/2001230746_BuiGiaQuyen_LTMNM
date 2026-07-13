// Bài 3, 7 và 11: Hiển thị danh sách, tìm kiếm, phân trang và sắp xếp
<?php
// Nạp file kết nối cơ sở dữ liệu
require 'connect.php';
// Lấy từ khóa tìm kiếm từ URL, nếu không có thì dùng chuỗi rỗng
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
// Số bản ghi hiển thị trên một trang
$limit = 5;
// Xác định trang hiện tại, mặc định là trang 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] :
    1;
// Tính vị trí bắt đầu của dữ liệu theo trang
$offset = ($page - 1) * $limit;
// Câu lệnh đếm tổng số sinh viên theo từ khóa
$sqlCount = "SELECT COUNT(*) FROM students WHERE name LIKE :keyword";
// Chuẩn bị câu lệnh đếm
$stmtCount = $conn->prepare($sqlCount);
// Gán giá trị cho tham số tìm kiếm
$stmtCount->execute([':keyword' => "%$keyword%"]);
// Lấy tổng số bản ghi tìm được
$totalRecords = $stmtCount->fetchColumn();
// Tính tổng số trang cần hiển thị
$totalPages = ceil($totalRecords / $limit);
// Lấy cột sắp xếp từ URL, mặc định là id
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id';

// Danh sách cột được phép sắp xếp để tránh lỗi và đảm bảo an toàn
$allowedSort = ['id', 'name', 'email'];

// Nếu cột sắp xếp không hợp lệ thì quay về id
if (!in_array($sort, $allowedSort)) {
    $sort = 'id';
}
// Câu lệnh lấy dữ liệu sinh viên theo từ khóa, sắp xếp và phân trang
$sql = "SELECT * FROM students
WHERE name LIKE :keyword
ORDER BY $sort ASC
LIMIT :limit OFFSET :offset";
// Chuẩn bị truy vấn lấy danh sách sinh viên
$stmt = $conn->prepare($sql);
// Gán giá trị cho từ khóa tìm kiếm
$stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
// Gán số lượng bản ghi cho mỗi trang
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);

// Gán vị trí bắt đầu lấy dữ liệu
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
// Thực thi truy vấn
$stmt->execute();
// Lấy toàn bộ kết quả dưới dạng mảng
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html>

<head>
    <!-- Khai báo bộ mã ký tự -->
    <meta charset="UTF-8">
    <!-- Tiêu đề trang danh sách -->
    <title>Danh sách sinh viên</title>
    <!-- Nạp Bootstrap từ CDN để tạo giao diện -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css
" rel="stylesheet">
</head>

<body class="container mt-4">
    <!-- Tiêu đề khu vực danh sách -->
    <h2>Danh sách sinh viên</h2>
    <!-- Form tìm kiếm -->
    <!-- Form tìm kiếm và sắp xếp dữ liệu -->
    <form method="get" class="row mb-3">
        <!-- Ô nhập từ khóa tìm kiếm -->
        <div class="col-md-4">
            <input type="text" name="keyword" value="<?=

                                                        htmlspecialchars($keyword) ?>"

                class="form-control" placeholder="Nhập tên cần tìm">
        </div>
        <!-- Danh sách chọn cột sắp xếp -->
        <div class="col-md-3">
            <select name="sort" class="form-select" onchange="this.form.submit()">
                <!-- Sắp xếp theo mã sinh viên -->
                <option value="id" <?= $sort == 'id' ? 'selected' : '' ?>>
                    Theo ID
                </option>

                <!-- Sắp xếp theo tên sinh viên -->
                <option value="name" <?= $sort == 'name' ? 'selected' : '' ?>>
                    Theo tên
                </option>

                <!-- Sắp xếp theo email sinh viên -->
                <option value="email" <?= $sort == 'email' ? 'selected' : '' ?>>
                    Theo Email
                </option>
            </select>
        </div>
        <!-- Nút thực hiện tìm kiếm -->
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </form>
    <!-- Liên kết sang trang thêm sinh viên -->
    <form method="get" class="row mb-3">
        <div class="col-md-5">
            <td><a href="add_student.php" onclick>Thêm sinh viên</a></td>
        </div>
    </form>

    <!-- Bảng hiển thị dữ liệu -->
    <!-- Bảng danh sách sinh viên -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <!-- Cột thứ tự -->
                <th>#</th>
                <!-- Cột họ tên -->
                <th>Họ và tên</th>
                <!-- Cột email -->
                <th>Email</th>
                <!-- Cột số điện thoại -->
                <th>Số điện thoại</th>
                <!-- Cột ngày sinh -->
                <th>Ngày sinh</th>
                <!-- Cột thao tác -->
                <th>Chức năng</th>

            </tr>
        </thead>
        <tbody>
            <!-- Kiểm tra xem có dữ liệu sinh viên hay không -->
            <?php if ($students): ?>
                <!-- Duyệt từng sinh viên trong danh sách -->
                <?php foreach ($students as $index => $row): ?>

                    <tr>
                        <!-- Số thứ tự theo trang hiện tại -->
                        <td><?= $offset + $index + 1 ?></td>
                        <!-- Hiển thị họ tên -->
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <!-- Hiển thị email -->
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <!-- Hiển thị số điện thoại -->
                        <td><?= htmlspecialchars($row['phone']) ?></td>
                        <!-- Hiển thị ngày sinh -->
                        <td><?= htmlspecialchars($row['dateofbirth']) ?></td>
                        <!-- Liên kết xóa và sửa -->
                        <td><a href="delete_student.php?id=<?= $row['id'] ?>" onclick="return confirm('Xóa?')">Xóa</a>
                        <br><a href="edit_student.php?id=<?= $row['id'] ?>">Sửa</a></br>
                    </td>
                  
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- Thông báo khi không có dữ liệu -->
                <tr>
                    <td colspan="5" class="text-center">Không có dữ liệu</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <!-- Phân trang -->
    <!-- Khu vực điều hướng trang -->
    <nav>
        <ul class="pagination">
            <!-- Nút quay về trang đầu và trang trước -->
            <?php if ($page > 1): ?>
                <li class="page-item"><a class="page-link"
                        href="?keyword=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&page=1">
                        Đầu
                    </a></li>

                <li class="page-item"><a class="page-link"
                        href="?keyword=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&page=<?= $page - 1 ?>">
                        Trước
                    </a></li>

            <?php endif; ?>
            <!-- Hiển thị số trang theo vòng lặp -->
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link"
                        href="?keyword=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&page=<?= $i ?>">
                        <?= $i ?>
                    </a>
                </li>
            <?php endfor; ?>
            <!-- Nút sang trang sau và trang cuối -->
            <?php if ($page < $totalPages): ?>
                <li class="page-item"><a class="page-link"
                        href="?keyword=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&page=<?= $page + 1 ?>">
                        Sau
                    </a></li>

                <li class="page-item"><a class="page-link"
                        href="?keyword=<?= urlencode($keyword) ?>&sort=<?= $sort ?>&page=<?= $totalPages ?>">
                        Cuối
                    </a></li>

            <?php endif; ?>
        </ul>
    </nav>
</body>

</html>