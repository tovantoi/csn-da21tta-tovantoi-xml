<?php
require_once("header.php");
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <?php
            if (isset($_GET['mssv'])) {
                $selectedMSSV = $_GET['mssv'];
                $file = 'sinhvien.xml';

                if (file_exists($file)) {
                    $xml = simplexml_load_file($file);
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
                                <img src="./img/<?= $selectedStudent->avatar ?>" alt="anh dai dien" class="img-fluid" width='200' height='200'>
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
            <a class="btn btn-primary" href="sinhvien.php">Quay lại</a>
        </div>
    </div>
</div>
<?php
require_once("footer.php");
?>