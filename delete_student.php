<?php
include('db_config.php');

if (isset($_GET['MaSV'])) {
    $MaSV = $_GET['MaSV'];

    // Xóa các đăng ký học phần liên quan đến sinh viên này
    $query1 = "DELETE FROM ChiTietDangKy WHERE MaDK IN (SELECT MaDK FROM DangKy WHERE MaSV = '$MaSV')";
    mysqli_query($conn, $query1);

    // Xóa các thông tin đăng ký
    $query2 = "DELETE FROM DangKy WHERE MaSV = '$MaSV'";

    // Xóa sinh viên
    $query3 = "DELETE FROM SinhVien WHERE MaSV = '$MaSV'";

    if (mysqli_query($conn, $query3)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $query3 . "<br>" . mysqli_error($conn);
    }
}
?>
