<!-- Biểu mẫu thêm sinh viên mới -->
<form method="post">
    <!-- Nhập họ tên sinh viên -->
    <label>Họ tên:</label> <input type="text" name="name" required><br>
    <!-- Nhập email sinh viên -->
    <label>Email:</label> <input type="email" name="email" required><br>
    <!-- Nhập số điện thoại sinh viên -->
    <label>SĐT:</label> <input type="text" name="phone"><br>
    <!-- Chọn ngày sinh sinh viên -->
    <label>Ngày sinh:</label> <input type="date" name="dateofbirth" required><br>
    <!-- Nút gửi dữ liệu để thêm mới -->
    <button type="submit">Thêm</button>
</form>

<?php
// Nạp file kết nối cơ sở dữ liệu
require 'connect.php';
// Kiểm tra xem form đã được gửi bằng phương thức POST hay chưa
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Chuẩn bị câu lệnh thêm dữ liệu vào bảng students
    $stmt = $conn->prepare("INSERT INTO students (name, email, phone, dateofbirth) VALUES
(?, ?, ?, ?)");
    // Thực thi câu lệnh với dữ liệu nhận từ form
    $stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['dateofbirth']]);
    // Thông báo thêm thành công
    echo "Thêm thành công!";
    // Chuyển hướng về trang danh sách sinh viên
    header("Location: list_student.php");
    // Dừng chương trình sau khi chuyển hướng
    exit();
}
?>