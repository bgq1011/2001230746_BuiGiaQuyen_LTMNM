// Bài 6: Cập nhật thông tin sinh viên
<?php
// Nạp file kết nối cơ sở dữ liệu
require 'connect.php';
// Nếu có id trên URL thì lấy dữ liệu sinh viên tương ứng
if (isset($_GET['id'])) {
    // Chuẩn bị câu lệnh truy vấn theo id
    $stmt = $conn->prepare("SELECT * FROM students WHERE id=?");
    // Thực thi truy vấn với id nhận từ URL
    $stmt->execute([$_GET['id']]);
    // Lấy một bản ghi sinh viên dưới dạng mảng kết hợp
    $student = $stmt->fetch(PDO::FETCH_ASSOC);
}
// Kiểm tra nếu form đã được gửi lên bằng POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Chuẩn bị câu lệnh cập nhật thông tin sinh viên
    $stmt = $conn->prepare("UPDATE students SET name=?, email=?, phone=?, dateofbirth=?
WHERE id=?");
    // Thực thi câu lệnh cập nhật với dữ liệu từ form
    $stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['dateofbirth'],
        $_POST['id'],
    ]);
    // Chuyển hướng về danh sách sau khi cập nhật thành công
    header("Location: list_student.php");
    // Dừng chương trình
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Khai báo bộ mã ký tự -->
    <meta charset="UTF-8">
    <!-- Thiết lập hiển thị phù hợp với thiết bị di động -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Tiêu đề trang -->
    <title>Document</title>
</head>
<body>
    <!-- Biểu mẫu cập nhật sinh viên -->
    <form method="post">
    <!-- Truyền id sinh viên đang sửa -->
    <input type="hidden" name="id" value="<?= $student['id'] ?>">
    <!-- Ô nhập họ tên -->
    <label>Họ tên:</label> <input type="text" name="name" value="<?=
                                                                    $student['name'] ?>"><br>
    <!-- Ô nhập email -->
    <label>Email:</label> <input type="email" name="email" value="<?=
                                                                    $student['email'] ?>"><br>

    <!-- Ô nhập số điện thoại -->
    <label>SĐT:</label> <input type="text" name="phone" value="<?=
                                                                $student['phone'] ?>"><br>
    <!-- Ô chọn ngày sinh -->
    <label>Ngày sinh:</label>
    <input type="date" name="dateofbirth"
        value="<?= $student['dateofbirth'] ?>"><br>
    <!-- Nút gửi biểu mẫu cập nhật -->
    <button type="submit">Cập nhật</button>
</form>
</body>
</html>