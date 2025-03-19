<?php
include('db_config.php');

// Lấy danh sách học phần
$query = "SELECT * FROM HocPhan";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách học phần</title>
    <!-- Liên kết đến Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h1 class="mt-5">Danh sách học phần</h1>
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
                            <a href="register_course.php?MaHP=<?php echo $row['MaHP']; ?>" class="btn btn-success">Đăng Ký</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
