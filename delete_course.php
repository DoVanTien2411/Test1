<?php
session_start();
include('db_config.php');

// Kiểm tra xem sinh viên đã đăng nhập chưa
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php"); // Nếu chưa đăng nhập, chuyển đến trang đăng nhập
    exit();
}

$MaSV = $_SESSION['MaSV']; // Lấy mã sinh viên từ session

if (isset($_GET['MaHP'])) {
    $MaHP = $_GET['MaHP'];

    // Xóa học phần đăng ký của sinh viên
    $query_delete = "DELETE FROM ChiTietDangKy WHERE MaHP = '$MaHP' AND MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = '$MaSV')";

    if (mysqli_query($conn, $query_delete)) {
        header("Location: register_list.php"); // Quay lại trang danh sách học phần đã đăng ký
    } else {
        echo "Lỗi khi xóa học phần!";
    }
}
?>
