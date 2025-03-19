<?php
session_start();
include('db_config.php');

// Kiểm tra xem sinh viên đã đăng nhập chưa
if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php"); // Nếu chưa đăng nhập, chuyển đến trang đăng nhập
    exit();
}

$MaSV = $_SESSION['MaSV']; // Mã sinh viên từ session

// Lấy thông tin sinh viên
$query_sinhvien = "SELECT * FROM SinhVien WHERE MaSV = '$MaSV'";
$result_sinhvien = mysqli_query($conn, $query_sinhvien);
$row_sinhvien = mysqli_fetch_assoc($result_sinhvien);

// Khởi tạo biến selected_courses
$selected_courses = array();
$total_credits = 0; // Tổng số tín chỉ

// Xử lý khi form đăng ký được gửi đi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $selected_courses = isset($_POST['courses']) ? $_POST['courses'] : array(); // Gán giá trị từ form

    if (!empty($selected_courses)) {
        // Thêm đăng ký vào bảng DangKy
        $NgayDK = date('Y-m-d'); // Ngày đăng ký
        $query_dangky = "INSERT INTO DangKy (MaSV, NgayDK) VALUES ('$MaSV', '$NgayDK')";
        if (mysqli_query($conn, $query_dangky)) {
            $MaDK = mysqli_insert_id($conn); // Lấy MaDK vừa tạo

            // Thêm chi tiết đăng ký vào bảng ChiTietDangKy và tính tổng số tín chỉ
            foreach ($selected_courses as $MaHP) {
                // Cập nhật số lượng dự kiến trong bảng HocPhan
                $query_update = "UPDATE HocPhan SET SoLuongDuKien = SoLuongDuKien - 1 WHERE MaHP = '$MaHP'";
                mysqli_query($conn, $query_update);

                // Thêm vào bảng ChiTietDangKy
                $query_chitiet = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ('$MaDK', '$MaHP')";
                mysqli_query($conn, $query_chitiet);

                // Lấy số tín chỉ của học phần và cộng vào tổng số tín chỉ
                $query_credits = "SELECT SoTinChi FROM HocPhan WHERE MaHP = '$MaHP'";
                $result_credits = mysqli_query($conn, $query_credits);
                $row_credits = mysqli_fetch_assoc($result_credits);
                $total_credits += $row_credits['SoTinChi'];
            }

            // Chuyển đến thông báo đăng ký thành công
            header("Location: register_success.php");
        } else {
            echo "Lỗi khi đăng ký học phần!";
        }
    } else {
        echo "Vui lòng chọn ít nhất một học phần để đăng ký.";
    }
} else {
    // Lấy danh sách học phần
    $query = "SELECT * FROM HocPhan";
    $result = mysqli_query($conn, $query);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Ký Học Phần</title>
    <!-- Liên kết đến Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h1 class="mt-5">Đăng Ký Học Phần</h1>
        <form method="POST">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>Mã học phần</th>
                    <th>Tên học phần</th>
                    <th>Số tín chỉ</th>
                    <th>Số lượng dự kiến</th>
                    <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            
                            <td><?php echo $row['MaHP']; ?></td>
                            <td><?php echo $row['TenHP']; ?></td>
                            <td><?php echo $row['SoTinChi']; ?></td>
                            <td><?php echo $row['SoLuongDuKien']; ?></td> <!-- Hiển thị số lượng dự kiến -->
                            <td><input type="checkbox" name="courses[]" value="<?php echo $row['MaHP']; ?>"></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div>
                <h3>Thông tin Đăng ký</h3>
                <p>Mã số sinh viên: <?php echo $row_sinhvien['MaSV']; ?></p>
                <p>Họ tên sinh viên: <?php echo $row_sinhvien['HoTen']; ?></p>
                <p>Ngày sinh: <?php echo $row_sinhvien['NgaySinh']; ?></p>
                <p>Ngành học: <?php echo $row_sinhvien['MaNganh']; ?></p>
                <p>Ngày đăng ký: <?php echo date('m/d/Y'); ?></p>
            </div>

            <button type="submit" class="btn btn-primary">Xác nhận</button>
        </form>
    </div>
</body>
</html>
