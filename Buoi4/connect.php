// Bài 1: Kết nối cơ sở dữ liệu
<?php
// Chuỗi DSN để kết nối tới MySQL và dùng bộ mã utf8
$dsn = "mysql:host=localhost;dbname=labdb;charset=utf8";
// Tên đăng nhập mặc định của MySQL
$username = "root";
// Mật khẩu MySQL, để trống trong môi trường local
$password = "";
// Bắt đầu khối thử kết nối
try {
    // Tạo đối tượng PDO để làm việc với cơ sở dữ liệu
    $conn = new PDO($dsn, $username, $password);
    // Thiết lập chế độ báo lỗi dưới dạng ngoại lệ
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // In ra thông báo khi kết nối thành công
    echo "Kết nối thành công!";
// Bắt lỗi nếu quá trình kết nối thất bại
} catch (PDOException $e) {
    // In ra thông báo lỗi kết nối kèm nội dung chi tiết
    echo "Kết nối thất bại: " . $e->getMessage();
}
?>