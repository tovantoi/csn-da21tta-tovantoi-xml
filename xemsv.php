<?php
require_once("header.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Student CV</title>
    <!-- <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
        }

        .card {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .card-body {
            padding: 30px;
        }

        .text {
            font-size: 18px;
        }

        .row {
            margin-top: 20px;
        }

        .col-md-4 {
            text-align: center;
        }

        .img-fluid {
            border-radius: 5%;
        }

        .col-md-8 {
            padding-left: 20px;
        }

        h2 {
            color: #007bff;
        }

        /* Thêm đoạn CSS này vào phần style của bạn */

        button {
            display: block;
            margin: 20px auto;
            padding: 15px 30px;
            font-size: 18px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #0056b3;
        }

        button:active {
            background-color: #0056b3;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transform: translateY(2px);
        }
    </style> -->
</head>


<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <?php
                $file = 'data.xml';

                if (file_exists($file)) {
                    $xml = simplexml_load_file($file);

                    if (isset($_GET['mssv'])) {
                        $selectedMSSV = $_GET['mssv'];
                        $selectedStudent = $xml->xpath("//student[@mssv='$selectedMSSV']");

                        if (!empty($selectedStudent)) {
                            $selectedStudent = $selectedStudent[0];
                ?>

                            <center>
                                <p><strong class="text">CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM <br>

                                        Độc lập - Tự do- Hạnh phúc</strong></p>
                            </center>
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="img/<?= $selectedStudent->avatar ?>" alt="anh dai dien" class="img-fluid" width='200' height='200'>
                                </div><br>
                                <div class="col-md-8">
                                    <br>
                                    <h2><?= $selectedStudent->full_name ?></h2>
                                    <p><strong>MSSV:</strong> <?= $selectedStudent['mssv'] ?></p>
                                    <p><strong>Lớp:</strong> <?= $selectedStudent->class_code ?></p>
                                    <p><strong>Địa chỉ:</strong> <?= $selectedStudent->address ?></p>
                                    <p><strong>Số điện thoại:</strong> <?= $selectedStudent->phone ?></p>
                                    <p><strong>Email:</strong> <?= $selectedStudent->email ?></p>
                                    <p><strong>Ngành học:</strong> <?= $selectedStudent->major ?></p>
                                    <p><strong>Giới tính:</strong> <?= $selectedStudent->gender ?></p>
                                    <p><strong>Ngày sinh:</strong> <?= $selectedStudent->dob ?></p>
                                    <p><strong>Dân tộc:</strong> <?= $selectedStudent->ethnicity ?></p>
                                    <p><strong>Tôn giáo:</strong> <?= $selectedStudent->religion ?></p>

                                    <!-- Parents information -->
                                    <h3 class="mt-4">Cha và Mẹ sinh viên</h3>
                                    <p><strong>Họ tên bố:</strong> <?= $selectedStudent->parents->father['full_name'] ?> </p>
                                    <p><strong>Nghề nghiệp bố:</strong><?= $selectedStudent->parents->father['occupation'] ?></p>
                                    <p><strong>Năm sinh bố:</strong><?= $selectedStudent->parents->father['year_of_birth'] ?></p>
                                    <p><strong>Họ tên mẹ:</strong> <?= $selectedStudent->parents->mother['full_name'] ?></p>
                                    <p><strong>Nghề nghiệp mẹ:</strong><?= $selectedStudent->parents->mother['occupation'] ?></p>
                                    <p><strong>Năm sinh mẹ:</strong><?= $selectedStudent->parents->mother['year_of_birth'] ?></p>
                                </div>
                            </div>
                <?php
                        } else {
                            echo '<p class="text-danger mt-3">Student with MSSV ' . $selectedMSSV . ' not found.</p>';
                        }
                    }
                } else {
                    echo 'XML file not found.';
                }
                ?>
            </div>
        </div>
    </div>
    <?php
    require_once("footer.php");
    ?>