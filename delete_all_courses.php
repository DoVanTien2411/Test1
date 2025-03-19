<?php
session_start();
include('db_config.php');

// Kiểm tra xem sinh viên đã đăng nhập chưa
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php"); // Nếu chưa đăng nhập, chuyển đến trang đăng nhập
    exit();
}

$MaSV = $_SESSION['MaSV']; // Lấy mã sinh viên từ session

// Xóa tất cả đăng ký học phần của sinh viên
$query_delete_all = "DELETE FROM ChiTietDangKy WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = '$MaSV')";
$query_delete_dangky = "DELETE FROM DangKy WHERE MaSV = '$MaSV'";

if (mysqli_query($conn, $query_delete_all) && mysqli_query($conn, $query_delete_dangky)) {
    header("Location: register_list.php"); // Quay lại trang danh sách học phần đã đăng ký
} else {
    echo "Lỗi khi xóa tất cả đăng ký học phần!";
}
?>
