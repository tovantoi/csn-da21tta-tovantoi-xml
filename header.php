<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("Location:index2.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Quản lý thông tin sinh viên</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .fakeimg {
            height: 200px;
            background: #aaa;
        }
    </style>
</head>

<body>

    <div class="p-5 bg-primary text-white text-center">
        <h1>QUẢN LÝ THÔNG TIN SINH VIÊN</h1>
        <p>Cung cấp một số thông tin về đề tài và người thực hiện</p>
    </div>

    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="./quantri.php">Trang chủ</a>
                </li>
                <?php if ($_SESSION["role"] === "2") { ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Quản lý dữ liệu</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Danh sách người dùng</a></li>
                            <li><a class="dropdown-item" href="#">Danh sách lớp</a></li>
                            <li><a class="dropdown-item" href="sinhvien.php">Danh sách sinh viên</a></li>
                            <!--<li><a class="dropdown-item" href="#">Link 3</a></li>-->
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./suasinhvien.php">Cập nhật thông tin cá nhân</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php?flag=1">Đăng xuất</a>
                    </li>
                <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="./suasinhvien.php">Cập nhật thông tin cá nhân</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href='xemsv.php?mssv=$mssv'>Xem chi tiết lý lịch trích ngang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php?flag=1">Đăng xuất</a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </nav>

    <div class="container mt-5">