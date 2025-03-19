<?php
session_start();
include('db_config.php');

// Lấy mã sinh viên từ session
$MaSV = $_SESSION['MaSV'];

// Lấy danh sách học phần mà sinh viên đã đăng ký
$query = "SELECT HocPhan.MaHP, HocPhan.TenHP, HocPhan.SoTinChi
          FROM HocPhan 
          JOIN ChiTietDangKy ON HocPhan.MaHP = ChiTietDangKy.MaHP
          JOIN DangKy ON ChiTietDangKy.MaDK = DangKy.MaDK
          WHERE DangKy.MaSV = '$MaSV'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Đăng Ký</title>
    <!-- Liên kết đến Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h1 class="mt-5">Thông Tin Đăng Ký</h1>
        <p>Thông tin học phần đã lưu thành công!</p>
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
                            <a href="delete_course.php?MaHP=<?php echo $row['MaHP']; ?>" class="btn btn-success">Xóa</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="delete_all_course.php" class="btn btn-primary">Xóa tất cả học phần</a>
        <a href="index.php" class="btn btn-primary">Quay lại danh sách học phần</a>
    </div>
</body>
</html>
