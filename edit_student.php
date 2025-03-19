<?php
include('db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $Hinh = $_FILES['Hinh']['name'];
    $MaNganh = $_POST['MaNganh'];

    // Upload ảnh
    if ($Hinh) {
        move_uploaded_file($_FILES['Hinh']['tmp_name'], 'images/' . $Hinh);
    } else {
        // Nếu không chọn ảnh mới, giữ lại ảnh cũ
        $Hinh = $_POST['OldHinh'];
    }

    $query = "UPDATE SinhVien SET HoTen = '$HoTen', GioiTinh = '$GioiTinh', NgaySinh = '$NgaySinh', Hinh = '$Hinh', MaNganh = '$MaNganh' WHERE MaSV = '$MaSV'";

    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    // Lấy dữ liệu sinh viên cần sửa
    $MaSV = $_GET['MaSV'];
    $query = "SELECT * FROM SinhVien WHERE MaSV = '$MaSV'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sinh viên</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Sửa thông tin sinh viên</h1>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="MaSV" value="<?php echo $row['MaSV']; ?>">
            <input type="hidden" name="OldHinh" value="<?php echo $row['Hinh']; ?>">
            <div class="form-group">
                <label for="HoTen">Họ tên</label>
                <input type="text" class="form-control" id="HoTen" name="HoTen" value="<?php echo $row['HoTen']; ?>" required>
            </div>
            <div class="form-group">
                <label for="GioiTinh">Giới tính</label>
                <select class="form-control" id="GioiTinh" name="GioiTinh">
                    <option value="Nam" <?php if ($row['GioiTinh'] == 'Nam') echo 'selected'; ?>>Nam</option>
                    <option value="Nữ" <?php if ($row['GioiTinh'] == 'Nữ') echo 'selected'; ?>>Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="NgaySinh">Ngày sinh</label>
                <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" value="<?php echo $row['NgaySinh']; ?>" required>
            </div>
            <div class="form-group">
                <label for="Hinh">Ảnh</label>
                <input type="file" class="form-control" id="Hinh" name="Hinh">
                <img src="images/<?php echo $row['Hinh']; ?>" alt="Hình ảnh sinh viên" width="100" class="mt-2">
            </div>
            <div class="form-group">
                <label for="MaNganh">Mã ngành</label>
                <input type="text" class="form-control" id="MaNganh" name="MaNganh" value="<?php echo $row['MaNganh']; ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Lưu</button>
        </form>
    </div>
</body>
</html>
