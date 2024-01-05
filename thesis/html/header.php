<?php
session_start();
if (!isset($_SESSION["name"])) {
    header("Location:index.php");
}
$masv = $_SESSION['name'];
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

        .dropbtn {
            background-color: #f1f1f1;
            color: black;
            padding: 10px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }

        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #ddd;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                            <li><a class="dropdown-item" href="./showuser.php">Danh sách người dùng</a></li>
                            <li><a class="dropdown-item" href="./dsclass.php">Danh sách lớp</a></li>
                            <li><a class="dropdown-item" href="./dsNganh.php">Danh sách Ngành</a></li>
                            <li><a class="dropdown-item" href="./sinhvien.php">Danh sách sinh viên</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#">Tra cứu thông tin</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./tracuulop.php">Sinh viên theo lớp</a></li>
                            <li><a class="dropdown-item" href="./tracuunganh.php">Sinh viên theo ngành</a></li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php?flag=1">Đăng xuất</a>
                    </li>
                    <li class="nav-item">
                        <?php

                        echo "<span class='nav-link'>Xin chào " . $_SESSION["name"] . "</span>";
                        ?>
                    </li>

                <?php } else { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="./suasinhvien.php?mssv=<?php echo $_SESSION["mssv"]; ?>">Cập nhật thông tin cá nhân</a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./xemsv.php?mssv=<?php echo $_SESSION["mssv"]; ?>">Xem chi tiết lý lịch trích ngang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./logout.php?flag=1">Đăng xuất</a>
                    </li>
                    <li class="nav-item">
                        <?php

                        echo "<span class='nav-link'>Xin chào " . $_SESSION["name"] . "</span>";
                        ?>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </nav>

    <div class="container mt-5">