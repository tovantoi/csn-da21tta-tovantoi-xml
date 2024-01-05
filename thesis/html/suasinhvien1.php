<?php

require_once("header.php");
$ma = $_SESSION['mssv'];
?>

<head>
    <title>Chỉnh sửa Sinh viên</title>
    <meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <?php

        include_once('function_list.php');
        $mssv = $full_name = $class_code = $address = $phone = $email = $major = $gender = $dob = $avatar = $ethnicity = $religion = $fatherFullName = $fatherOccupation = $fatherYearOfBirth = $motherFullName = $motherOccupation = $motherYearOfBirth = "";

        //lấy mã số sinh viên
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            if (isset($_GET['mssv'])) {
                $mssv = $_GET['mssv'];
            }
        } else {
            $mssv = $ma;
        }
        $xml = new DOMDocument();
        $xml->load('data.xml');
        $students = $xml->getElementsByTagName('student');

        $selectedStudent = null;

        foreach ($students as $student) {
            if ($student->getAttribute('mssv') == $mssv) {
                $selectedStudent = $student;
                break;
            }
        }

        if ($selectedStudent) {
            $full_name = $selectedStudent->getElementsByTagName('full_name')->item(0)->nodeValue;
            $class_code = $selectedStudent->getElementsByTagName('class_code')->item(0)->nodeValue;
            $address = $selectedStudent->getElementsByTagName('address')->item(0)->nodeValue;
            $phone = $selectedStudent->getElementsByTagName('phone')->item(0)->nodeValue;
            $email = $selectedStudent->getElementsByTagName('email')->item(0)->nodeValue;
            $major = $selectedStudent->getElementsByTagName('major')->item(0)->nodeValue;
            $gender = $selectedStudent->getElementsByTagName('gender')->item(0)->nodeValue;
            $dob = $selectedStudent->getElementsByTagName('dob')->item(0)->nodeValue;
            $avatar = $selectedStudent->getElementsByTagName('avatar')->item(0)->nodeValue;
            $ethnicity = $selectedStudent->getElementsByTagName('ethnicity')->item(0)->nodeValue;
            $religion = $selectedStudent->getElementsByTagName('religion')->item(0)->nodeValue;

            $fatherFullName = $selectedStudent->getElementsByTagName('father')->item(0)->getAttribute('full_name');
            $fatherOccupation = $selectedStudent->getElementsByTagName('father')->item(0)->getAttribute('occupation');
            $fatherYearOfBirth = $selectedStudent->getElementsByTagName('father')->item(0)->getAttribute('year_of_birth');

            $motherFullName = $selectedStudent->getElementsByTagName('mother')->item(0)->getAttribute('full_name');
            $motherOccupation = $selectedStudent->getElementsByTagName('mother')->item(0)->getAttribute('occupation');
            $motherYearOfBirth = $selectedStudent->getElementsByTagName('mother')->item(0)->getAttribute('year_of_birth');
        }

        $mssv = isset($_GET['mssv']) ? $_GET['mssv'] : $ma;
        $class_code = isset($class_code) ? $class_code : '';
        $full_name = isset($full_name) ? $full_name : '';
        $address = isset($address) ? $address : '';
        $phone = isset($phone) ? $phone : '';
        $email = isset($email) ? $email : '';
        $major = isset($major) ? $major : '';
        $gender = isset($gender) ? $gender : '';
        $dob = isset($dob) ? $dob : '';
        $avatar = isset($avatar) ? $avatar : '';
        $ethnicity = isset($ethnicity) ? $ethnicity : '';
        $religion = isset($religion) ? $religion : '';
        $fatherFullName = isset($fatherFullName) ? $fatherFullName : '';
        $fatherOccupation = isset($fatherOccupation) ? $fatherOccupation : '';
        $fatherYearOfBirth = isset($fatherYearOfBirth) ? $fatherYearOfBirth : '';
        $motherFullName = isset($motherFullName) ? $motherFullName : '';
        $motherOccupation = isset($motherOccupation) ? $motherOccupation : '';
        $motherYearOfBirth = isset($motherYearOfBirth) ? $motherYearOfBirth : '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['suasinhvien'])) {
                $xml = new DOMDocument();
                $xml->load('data.xml');
                $students = $xml->getElementsByTagName('student');

                foreach ($students as $student) {
                    if ($student->getAttribute('mssv') == $mssv) {
                        $student->getElementsByTagName('full_name')->item(0)->nodeValue = $_POST['full_name'];
                        $student->getElementsByTagName('class_code')->item(0)->nodeValue = $_POST['class_code'];
                        $student->getElementsByTagName('address')->item(0)->nodeValue = $_POST['address'];
                        $student->getElementsByTagName('phone')->item(0)->nodeValue = $_POST['phone'];
                        $student->getElementsByTagName('email')->item(0)->nodeValue = $_POST['email'];
                        $student->getElementsByTagName('major')->item(0)->nodeValue = $_POST['major'];
                        $student->getElementsByTagName('gender')->item(0)->nodeValue = $_POST['gender'];
                        $student->getElementsByTagName('dob')->item(0)->nodeValue = $_POST['dob'];
                        $student->getElementsByTagName('avatar')->item(0)->nodeValue = $_POST['avatar'];
                        $student->getElementsByTagName('ethnicity')->item(0)->nodeValue = $_POST['ethnicity'];
                        $student->getElementsByTagName('religion')->item(0)->nodeValue = $_POST['religion'];

                        $father = $student->getElementsByTagName('father')->item(0);
                        $father->setAttribute('full_name', $_POST['father_full_name']);
                        $father->setAttribute('occupation', $_POST['father_occupation']);
                        $father->setAttribute('year_of_birth', $_POST['father_year_of_birth']);

                        $mother = $student->getElementsByTagName('mother')->item(0);
                        $mother->setAttribute('full_name', $_POST['mother_full_name']);
                        $mother->setAttribute('occupation', $_POST['mother_occupation']);
                        $mother->setAttribute('year_of_birth', $_POST['mother_year_of_birth']);

                        $xml->save('data.xml');
                        break;
                    }
                }
            }
        }
        ?>

        <h1>Chỉnh sửa Sinh viên</h1>
        <form method="post" action="Xuly_sinhvien.php">
            <div class="form-group">
                <label for="" class="control-label">Ngành học:</label>
                <select class="form-control" name="major" required>
                    <?php
                    $xml = simplexml_load_file('nganhhoc.xml');
                    foreach ($xml->children() as $nganhhoc) {
                        echo "<option value='" . htmlspecialchars($nganhhoc) . "'>" . htmlspecialchars($nganhhoc) . " </option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Chọn lớp:</label>
                <select id="class_code" class="form-control" name="class_code" required>
                    <?php
                    $xml = simplexml_load_file('lop.xml');
                    foreach ($xml->class as $lop) {
                        $class_id = $lop->class_id;
                        $class_name = $lop->name;
                        $selected = isset($class_code) && $class_code == $class_id ? 'selected' : '';
                        echo "<option value='$class_id' $selected>$class_name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="mssv" class="control-label">Mã số sinh viên:</label>
                <input id="mssv" class="form-control" type="text" name="mssv" placeholder="MSSV" value="<?php echo htmlspecialchars($mssv); ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Tên sinh viên:</label>
                <input class="form-control" type="text" name="full_name" placeholder="Tên sinh viên" value="<?php echo htmlspecialchars($full_name); ?>" required>
            </div>

            <div class="form-group">
                <label for="" class="control-label">Địa chỉ:</label>
                <input class="form-control" type="text" name="address" placeholder="địa chỉ sinh viên" value="<?php echo htmlspecialchars($address); ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Số điện thoại:</label>
                <input class="form-control" type="text" name="phone" placeholder="Nhập số điện thoại" value="<?php echo htmlspecialchars($phone); ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Email:</label>
                <input class="form-control" type="text" name="email" placeholder="Nhập Email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Giới tính:</label>
                <select class="form-control" name="gender" id="cars">
                    <option value="nam" <?php if (isset($gender) && $gender === 'nam') echo 'selected'; ?>>Nam</option>
                    <option value="nu" <?php if (isset($gender) && $gender === 'nu') echo 'selected'; ?>>Nữ</option>
                    <option value="khac" <?php if (isset($gender) && $gender === 'khac') echo 'selected'; ?>>Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Ngày sinh:</label>
                <input class="form-control" type="date" name="dob" placeholder="Nhập ngày sinh" value="<?php echo htmlspecialchars($dob); ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Ảnh đại diện:</label>
                <input class="form-control" type="text" name="avatar" placeholder="thêm ảnh đại diện" value="<?php echo isset($avatar) ? htmlspecialchars($avatar) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Dân tộc:</label>
                <select class="form-control" name="ethnicity" id="cars">
                    <option value="nam" <?php if (isset($ethnicity) && $ethnicity === 'Kinh') echo 'selected'; ?>>Kinh</option>
                    <option value="nu" <?php if (isset($ethnicity) && $ethnicity === 'Khmer') echo 'selected'; ?>>Khmer</option>
                    <option value="khac" <?php if (isset($ethnicity) && $ethnicity === 'Hoa') echo 'selected'; ?>>Hoa</option>
                    <option value="khac" <?php if (isset($ethnicity) && $ethnicity === 'Khác') echo 'selected'; ?>>Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Tôn Giáo:</label>
                <input class="form-control" type="text" name="religion" placeholder="Nhập tôn giáo" value="<?php echo htmlspecialchars($religion); ?>" required>
            </div>

            <h3>Thông tin Phụ huynh</h3>
            <div class="form-group">
                <label for="" class="control-label">Họ và tên bố:</label>
                <input class="form-control" type="text" name="father_full_name" placeholder="Nhập họ và tên bố" value="<?php echo isset($_POST['father_full_name']) ? htmlspecialchars($_POST['father_full_name']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Nghề nghiệp bố:</label>
                <input class="form-control" type="text" name="father_occupation" placeholder="Nhập nghề nghiệp bố" value="<?php echo isset($_POST['father_occupation']) ? htmlspecialchars($_POST['father_full_name']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Năm sinh bố:</label>
                <input class="form-control" type="text" name="father_year_of_birth" placeholder="Nhập năm sinh bố" value="<?php echo isset($_POST['father_year_of_birth']) ? htmlspecialchars($_POST['father_full_name']) : ''; ?>" required>
            </div>


            <div class="form-group">
                <label for="" class="control-label">Họ và tên mẹ:</label>
                <input class="form-control" type="text" name="mother_full_name" placeholder="Nhập họ và tên mẹ" value="<?php echo isset($_POST['mother_full_name']) ? htmlspecialchars($_POST['father_full_name']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Nghề nghiệp mẹ:</label>
                <input class="form-control" type="text" name="mother_occupation" placeholder="Nhập nghề nghiệp mẹ" value="<?php echo isset($_POST['mother_occupation']) ? htmlspecialchars($_POST['father_full_name']) : ''; ?>" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Năm sinh mẹ:</label>
                <input class="form-control" type="text" name="mother_year_of_birth" placeholder="Nhập năm sinh mẹ" value="<?php echo isset($_POST['mother_year_of_birth']) ? htmlspecialchars($_POST['father_full_name']) : ''; ?>" required>
            </div>
            <br>
            <input class="btn btn-primary" type="submit" name="add_student" value="Cập nhật ">
            <a class="btn btn-primary" href="sinhvien.php">Quay lại</a>

        </form>
        <?php
        require_once("footer.php");
        ?>