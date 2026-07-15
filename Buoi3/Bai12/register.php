<?php
// 1. Cấu hình kết nối Database
$host = "localhost";
$db_user = "root"; // Thay bằng user của bạn nếu khác
$db_pass = "";     // Thay bằng mật khẩu của bạn nếu có
$db_name = "web_db";

$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập font chữ tiếng Việt
$conn->set_charset("utf8mb4");

// 2. Kiểm tra xem dữ liệu có được POST lên không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Nhận và làm sạch dữ liệu đầu vào (tránh XSS cơ bản)
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Backend Validation (Bắt buộc phải có để phòng trường hợp user tắt Javascript)
    if (empty($username) || empty($email) || empty($password)) {
        die("Vui lòng điền đầy đủ thông tin!");
    }

    // 3. Kiểm tra xem Username hoặc Email đã tồn tại chưa (Sử dụng Prepared Statement chống SQL Injection)
    $check_stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $check_stmt->bind_param("ss", $username, $email);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        echo "<script>alert('Tài khoản hoặc Email đã tồn tại!'); window.history.back();</script>";
        $check_stmt->close();
        $conn->close();
        exit();
    }
    $check_stmt->close();

    // 4. Mã hóa mật khẩu bằng thuật toán BCRYPT (Bảo mật cao)
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // 5. Thêm người dùng mới vào Database
    $insert_stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $insert_stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($insert_stmt->execute()) {
        echo "<h3 style='color: green; text-align: center;'>Đăng ký thành công tài khoản: $username!</h3>";
        echo "<p style='text-align: center;'><a href='index.html'>Quay lại trang đăng ký</a></p>";
    } else {
        echo "Đã xảy ra lỗi: " . $insert_stmt->error;
    }

    $insert_stmt->close();
}

// Đóng kết nối
$conn->close();
?>