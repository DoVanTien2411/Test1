<?php
session_start();
include('db_config.php');

// Kiểm tra xem sinh viên đã đăng nhập chưa
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php"); // Nếu chưa đăng nhập, chuyển đến trang đăng nhập
    exit();
}

$MaSV = $_SESSION['MaSV']; // Lấy mã sinh viên từ session

// Lấy danh sách học phần mà sinh viên đã đăng ký
$query = "SELECT HocPhan.MaHP, HocPhan.TenHP, HocPhan.SoTinChi 
          FROM HocPhan 
          JOIN ChiTietDangKy ON HocPhan.MaHP = ChiTietDangKy.MaHP
          JOIN DangKy ON ChiTietDangKy.MaDK = DangKy.MaDK
          WHERE DangKy.MaSV = '$MaSV'";
$result = mysqli_query($conn, $query);

// Lấy tổng số học phần và tín chỉ
$query_count = "SELECT COUNT(*) AS total_courses, SUM(HocPhan.SoTinChi) AS total_credits
                FROM HocPhan 
                JOIN ChiTietDangKy ON HocPhan.MaHP = ChiTietDangKy.MaHP
                JOIN DangKy ON ChiTietDangKy.MaDK = DangKy.MaDK
                WHERE DangKy.MaSV = '$MaSV'";
$result_count = mysqli_query($conn, $query_count);
$row_count = mysqli_fetch_assoc($result_count);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin học phần đã đăng ký</title>
    <!-- Liên kết đến Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h1 class="mt-5">Đăng Ký Học Phần</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Mã học phần</th>
                    <th>Tên học phần</th>
                    <th>Số tín chỉ</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row['MaHP']; ?></td>
                        <td><?php echo $row['TenHP']; ?></td>
                        <td><?php echo $row['SoTinChi']; ?></td>
                        <td>
                            <a href="delete_course.php?MaHP=<?php echo $row['MaHP']; ?>" class="btn btn-danger btn-sm">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <div>
            <p>Số học phần đã đăng ký: <?php echo $row_count['total_courses']; ?></p>
            <p>Tổng số tín chỉ: <?php echo $row_count['total_credits']; ?></p>
        </div>
        <a href="index.php" class="btn btn-primary">Quay lại danh sách học phần</a>
    </div>
</body>
</html>
