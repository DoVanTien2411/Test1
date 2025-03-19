<?php
include('db_config.php');

// Lấy danh sách sinh viên
$query = "SELECT * FROM SinhVien";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Sinh Viên</title>
    <!-- Liên kết đến Bootstrap CSS -->
     <!-- Liên kết đến Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .table th, .table td {
            vertical-align: middle;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .container {
            padding-top: 30px;
        }
        .btn-action {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <!-- Thanh công cụ (Navbar) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="index.php">Trang Chủ</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Đăng Nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Danh Sách Sinh Viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register_course.php">Đăng Ký Học Phần</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="indexHP.php">Danh Sách Học Phần</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Danh Sách Sinh Viên</h1>
        <!-- Nút thêm sinh viên -->
        <a href="add_student.php" class="btn btn-primary mb-3">Thêm Sinh Viên</a>

        <!-- Bảng danh sách sinh viên -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>MaSV</th>
                        <th>Họ Tên</th>
                        <th>Giới Tính</th>
                        <th>Ngày Sinh</th>
                        <th>Ngành Học</th>
                        <th>Ảnh</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row['MaSV']; ?></td>
                            <td><?php echo $row['HoTen']; ?></td>
                            <td><?php echo $row['GioiTinh']; ?></td>
                            <td><?php echo $row['NgaySinh']; ?></td>
                            <td><?php echo $row['MaNganh']; ?></td>
                            <td><img src="images/<?php echo $row['Hinh']; ?>" alt="Hình ảnh" width="100"></td>
                            <td>
                                <!-- Nút Sửa -->
                                <a href="edit_student.php?MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-warning btn-sm btn-action">Sửa</a>

                                <!-- Nút Xóa -->
                                <a href="delete_student.php?MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-danger btn-sm btn-action">Xóa</a>

                                <!-- Nút Chi tiết -->
                                <a href="student_detail.php?MaSV=<?php echo $row['MaSV']; ?>" class="btn btn-info btn-sm btn-action">Chi Tiết</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Liên kết đến Bootstrap JS và jQuery -->
    <script src="
