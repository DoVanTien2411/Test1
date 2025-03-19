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
    move_uploaded_file($_FILES['Hinh']['tmp_name'], 'images/' . $Hinh);

    $query = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh)
              VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$Hinh', '$MaNganh')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: index.php");
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sinh viên</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Thêm sinh viên</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="MaSV">Mã sinh viên</label>
                <input type="text" class="form-control" id="MaSV" name="MaSV" required>
            </div>
            <div class="form-group">
                <label for="HoTen">Họ tên</label>
                <input type="text" class="form-control" id="HoTen" name="HoTen" required>
            </div>
            <div class="form-group">
                <label for="GioiTinh">Giới tính</label>
                <select class="form-control" id="GioiTinh" name="GioiTinh">
                    <option value="Nam">Nam</option>
                    <option value="Nữ">Nữ</option>
                </select>
            </div>
            <div class="form-group">
                <label for="NgaySinh">Ngày sinh</label>
                <input type="date" class="form-control" id="NgaySinh" name="NgaySinh" required>
            </div>
            <div class="form-group">
                <label for="Hinh">Ảnh</label>
                <input type="file" class="form-control" id="Hinh" name="Hinh" required>
            </div>
            <div class="form-group">
                <label for="MaNganh">Mã ngành</label>
                <input type="text" class="form-control" id="MaNganh" name="MaNganh" required>
            </div>
            <button type="submit" class="btn btn-success">Thêm</button>
        </form>
    </div>
</body>
</html>
