<?php
require_once("header.php");
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
        function loadStudents()
        {
            $xml = new DOMDocument();
            $xml = simplexml_load_file('data.xml');
            return $xml;
        }

        function saveStudents($xml)
        {
            $xml->preserveWhiteSpace = false;
            $xml->formatOutput = true;
            $xml->loadXML($xml->asXML());
            $xml->save('data.xml');
        }

        function loadClasses()
        {
            $xml = simplexml_load_file('malop.xml');
            return $xml;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['mssv'])) {
                $mssv = $_GET['mssv'];

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
            }
        }

        // Thêm giá trị mặc định cho trường input
        $mssv = isset($_GET['mssv']) ? $_GET['mssv'] : '';
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
                <label for="" class="control-label">Chọn lớp:</label>
                <select class="form-control" name="class_code" required>
                    <?php
                    $xmlClass = loadClasses();

                    foreach ($xmlClass->class as $class) {
                        $class_id = $class->class_id;
                        $class_name = $class->name;

                        echo "<option value='$class_id'>$class_name</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <label for="mssv" class="control-label">Mã số sinh viên:</label>
                <input id="mssv" class="form-control" type="text" name="mssv" placeholder="MSSV" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Tên sinh viên:</label>
                <input $mssv class="form-control" type="text" name="full_name" placeholder="Tên sinh viên" required>
            </div>

            <div class="form-group">
                <label for="" class="control-label">Địa chỉ:</label>
                <input class="form-control" type="text" name="address" placeholder="địa chỉ sinh viên" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Số điện thoại:</label>
                <input class="form-control" type="text" name="phone" placeholder="Nhập số điện thoại" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Email:</label>
                <input class="form-control" type="text" name="email" placeholder="Nhập Email" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Ngành học:</label>
                <input class="form-control" type="text" name="major" placeholder="Nhập ngành học" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Giới tính:</label>
                <select class="form-control" name="gender" id="cars">
                    <option value="nam">Nam</option>
                    <option value="nu">Nữ</option>
                    <option value="khac">Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Ngày sinh:</label>
                <input class="form-control" type="date" name="dob" placeholder="Nhập ngày sinh" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Ảnh đại diện:</label>
                <input class="form-control" type="file" name="avatar" placeholder="thêm ảnh đại diện" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Dân tộc:</label>
                <select class="form-control" name="gender" id="cars">
                    <option value="nam">Kinh</option>
                    <option value="nu">Khmer</option>
                    <option value="khac">Hoa</option>
                    <option value="khac">Khác</option>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Tôn Giáo:</label>
                <input class="form-control" type="text" name="religion" placeholder="Nhập tôn giáo" required>
            </div>
            <h3>Thông tin Phụ huynh</h3>
            <div class="form-group">
                <label for="" class="control-label">Họ và tên bố:</label>
                <input class="form-control" type="text" name="father_full_name" placeholder="Nhập họ và tên bố" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Nghề nghiệp bố:</label>
                <input class="form-control" type="text" name="father_occupation" placeholder="Nhập nghề nghiệp bố" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Năm sinh bố:</label>
                <input class="form-control" type="text" name="father_year_of_birth" placeholder="Nhập năm sinh bố" required>
            </div>


            <div class="form-group">
                <label for="" class="control-label">Họ và tên mẹ:</label>
                <input class="form-control" type="text" name="mother_full_name" placeholder="Nhập họ và tên mẹ" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Nghề nghiệp mẹ:</label>
                <input class="form-control" type="text" name="mother_occupation" placeholder="Nhập nghề nghiệp mẹ" required>
            </div>
            <div class="form-group">
                <label for="" class="control-label">Năm sinh mẹ:</label>
                <input class="form-control" type="text" name="mother_year_of_birth" placeholder="Nhập năm sinh mẹ" required>
            </div>
            <br>
            <input class="btn btn-primary" type="submit" name="add_student" value="Cập nhật ">
        </form>
        <?php
        require_once("footer.php");
        ?>