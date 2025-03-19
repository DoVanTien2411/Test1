<?php
include('db_config.php');
$MaSV = $_GET['MaSV'];
$query = "SELECT * FROM SinhVien WHERE MaSV = '$MaSV'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sinh viên</title>
    <!-- Liên kết đến Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h1 class="mt-5">Thông tin chi tiết sinh viên</h1>
        <table class="table table-bordered">
            <tr>
                <th>Mã sinh viên</th>
                <td><?php echo $row['MaSV']; ?></td>
            </tr>
            <tr>
                <th>Họ tên</th>
                <td><?php echo $row['HoTen']; ?></td>
            </tr>
            <tr>
                <th>Giới tính</th>
                <td><?php echo $row['GioiTinh']; ?></td>
            </tr>
            <tr>
                <th>Ngày sinh</th>
                <td><?php echo $row['NgaySinh']; ?></td>
            </tr>
            <tr>
                <th>Ảnh</th>
                <td><img src="images/<?php echo $row['Hinh']; ?>" alt="Hình ảnh" width="100"></td>
            </tr>
        </table>
    </div>
</body>
</html>
