// Bài 5: Xóa sinh viên

<?php
// Nạp file kết nối cơ sở dữ liệu
require 'connect.php';
// Kiểm tra xem có truyền mã sinh viên qua URL hay không
if (isset($_GET['id'])) {
    // Chuẩn bị câu lệnh xóa theo id
    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    // Thực thi câu lệnh với id nhận từ tham số GET
    $stmt->execute([$_GET['id']]);
}
// Chuyển hướng về trang danh sách sau khi xóa
header("Location: list_student.php");
// Kết thúc chương trình
exit;
?>