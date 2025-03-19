<?php
session_start();
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $MaSV = $_POST['MaSV'];

    // Kiểm tra mã sinh viên có tồn tại trong database không
    $query = "SELECT * FROM SinhVien WHERE MaSV = '$MaSV'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Nếu sinh viên tồn tại, lưu mã sinh viên vào session
        $_SESSION['MaSV'] = $MaSV;
        header("Location: index.php"); // Chuyển hướng đến trang danh sách học phần
    } else {
        echo "Mã sinh viên không tồn tại!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
    <!-- Liên kết đến Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>
    <div class="container">
        <h1 class="mt-5">Đăng Nhập</h1>
        <form method="POST">
            <div class="form-group">
                <label for="MaSV">Mã sinh viên</label>
                <input type="text" class="form-control" id="MaSV" name="MaSV" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng Nhập</button>
        </form>
    </div>
</body>
</html>
