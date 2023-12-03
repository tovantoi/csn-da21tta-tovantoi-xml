<!DOCTYPE html>
<html>

<head>
    <title>Chỉnh sửa Sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            background-color: #337ab7;
            color: white;
            padding: 10px;
        }

        form {
            margin: 10px;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
        }

        input[type="submit"] {
            background-color: #337ab7;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #235273;
        }
    </style>
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        if (isset($_GET['mssv'])) {
            $mssv = $_GET['mssv'];

            // Load student information from data.xml based on MSSV
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
    $mssv = isset($_GET['mssv']) ? $_GET['mssv'] : '';


    $full_name = $class_code = $address = $phone = $email = $major = $gender = $dob = $avatar = $ethnicity = $religion = '';
    $fatherFullName = $fatherOccupation = $fatherYearOfBirth = $motherFullName = $motherOccupation = $motherYearOfBirth = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['suasinhvien'])) {
            // Update student information in data.xml based on MSSV
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

                    // Save the updated XML
                    $xml->save('data.xml');
                    break;
                }
            }
        }
    }
    ?>

    <h1>Chỉnh sửa Sinh viên</h1>

    <form method="post" action="">
        <input type="text" name="mssv" value="<?php echo $mssv; ?>" required><br>
        <input type="text" name="full_name" placeholder="Họ và Tên" value="<?php echo $full_name; ?>" required><br>
        <label for="class_code">Chọn Lớp:</label>
        <select name="class_code" required>
            <?php
            // Load class information from malop.xml
            $xmlClass = simplexml_load_file('malop.xml');

            // Loop through each <class> element in 'malop.xml'
            foreach ($xmlClass->class as $class) {
                $class_id = $class->class_id;
                $class_name = $class->name;

                // Display option for user selection
                echo "<option value='$class_id' " . ($class_id == $class_code ? 'selected' : '') . ">$class_name</option>";
            }
            ?>
        </select><br>
        <input type="text" name="address" placeholder="Địa chỉ" value="<?php echo $address; ?>" required><br>
        <input type="text" name="phone" placeholder="Số điện thoại" value="<?php echo $phone; ?>" required><br>
        <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required><br>
        <input type="text" name="major" placeholder="Ngành học" value="<?php echo $major; ?>" required><br>
        <input type="text" name="gender" placeholder="Giới tính" value="<?php echo $gender; ?>" required><br>
        <input type="date" name="dob" placeholder="Ngày sinh" value="<?php echo $dob; ?>" required><br>
        <input type="file" name="avatar" placeholder="Ảnh đại diện" value="<?php echo $avatar; ?>" required><br>
        <input type="text" name="ethnicity" placeholder="Dân tộc" value="<?php echo $ethnicity; ?>" required><br>
        <input type="text" name="religion" placeholder="Tôn giáo" value="<?php echo $religion; ?>" required><br>

        <h3>Thông tin Phụ huynh</h3>
        <label for="father_full_name">Họ và tên bố:</label>
        <input type="text" name="father_full_name" value="<?php echo $fatherFullName; ?>" required><br>
        <label for="father_occupation">Nghề nghiệp bố:</label>
        <input type="text" name="father_occupation" value="<?php echo $fatherOccupation; ?>" required><br>
        <label for="father_year_of_birth">Năm sinh bố:</label>
        <input type="text" name="father_year_of_birth" value="<?php echo $fatherYearOfBirth; ?>" required><br>

        <label for="mother_full_name">Họ và tên mẹ:</label>
        <input type="text" name="mother_full_name" value="<?php echo $motherFullName; ?>" required><br>
        <label for="mother_occupation">Nghề nghiệp mẹ:</label>
        <input type="text" name="mother_occupation" value="<?php echo $motherOccupation; ?>" required><br>
        <label for="mother_year_of_birth">Năm sinh mẹ:</label>
        <input type="text" name="mother_year_of_birth" value="<?php echo $motherYearOfBirth; ?>" required><br>

        <input type="submit" name="suasinhvien" value="Lưu chỉnh sửa">
    </form>
</body>

</html>