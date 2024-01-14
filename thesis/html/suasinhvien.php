<?php

require_once("header.php");
//lấy mã số sinh viên
$masv = "";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['mssv'])) {
        $masv = $_GET['mssv'];
    }
}

?>


<?php

include_once('function_list.php');
$full_name = $class_code = $address = $phone = $email = $major = $gender = $dob = $avatar = $ethnicity = $religion = $fatherFullName = $fatherOccupation = $fatherYearOfBirth = $motherFullName = $motherOccupation = $motherYearOfBirth = "";
//Đọc dữ liệu từ file sinhvien.xml
$xml = new DOMDocument();
$xml->load('sinhvien.xml');
$students = $xml->getElementsByTagName('student');

$selectedStudent = null;

foreach ($students as $student) {
    if ($student->getAttribute('mssv') === $masv) {
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
// echo "Fullname: " . var_dump($class_code);
?>

<h1>Chỉnh sửa Sinh viên</h1>
<form method="post" action="Xuly_sinhvien.php">
    <div class="form-group">
        <label for="" class="control-label">Ngành học:</label>
        <select class="form-control" name="major" required>
            <?php
            $xml = simplexml_load_file('nganhhoc.xml');
            foreach ($xml->children() as $nganhhoc) {
                $selected = (isset($major) && htmlspecialchars($nganhhoc) === $major) ? "selected" : "";
                echo "<option value='" . htmlspecialchars($nganhhoc) . "'" . $selected . ">" . htmlspecialchars($nganhhoc) . " </option>";
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
                if (strcmp($class_id, $class_code) == 0) {
                    echo "<option value='" . $class_name . "'selected >" . $class_id . "</option>";
                } else {
                    echo "<option value='" . $class_name . "'>" . $class_id . "</option>";
                }
            }
            ?>
        </select>

    </div>

    <div class="form-group">
        <label for="mssv" class="control-label">Mã số sinh viên:</label>
        <input id="mssv" class="form-control" type="text" name="mssv" placeholder="MSSV" value="<?php echo htmlspecialchars($masv); ?>" required>
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
        <select class="form-control" name="gender" id="gender" required>
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
        <label for="avatar" class="control-label">Ảnh đại diện:</label>
        <img src="img/<?php echo isset($avatar) ? htmlspecialchars($avatar) : ''; ?>" alt="Ảnh đại diện">
    </div>
    <div class="form-group">
        <label for="" class="control-label">Dân tộc:</label>
        <select class="form-control" name="ethnicity" id="ethnicity" required>
            <option value="Kinh" <?php if (isset($ethnicity) && $ethnicity === 'Kinh') echo 'selected'; ?>>Kinh</option>
            <option value="Khmer" <?php if (isset($ethnicity) && $ethnicity === 'Khmer') echo 'selected'; ?>>Khmer</option>
            <option value="Hoa" <?php if (isset($ethnicity) && $ethnicity === 'Hoa') echo 'selected'; ?>>Hoa</option>
            <option value="Khác" <?php if (isset($ethnicity) && $ethnicity === 'Khác') echo 'selected'; ?>>Khác</option>
        </select>
    </div>
    <div class="form-group">
        <label for="" class="control-label">Tôn Giáo:</label>
        <input class="form-control" type="text" name="religion" placeholder="Nhập tôn giáo" value="<?php echo htmlspecialchars($religion); ?>" required>
    </div>

    <h3>Thông tin Phụ huynh</h3>
    <div class="form-group">
        <label for="" class="control-label">Họ và tên bố:</label>
        <input class="form-control" type="text" name="father_full_name" placeholder="Nhập họ và tên bố" value="<?php echo htmlspecialchars($fatherFullName); ?>" required>
    </div>
    <div class="form-group">
        <label for="" class="control-label">Nghề nghiệp bố:</label>
        <input class="form-control" type="text" name="father_occupation" placeholder="Nhập nghề nghiệp bố" value="<?php echo htmlspecialchars($fatherOccupation); ?>" required>
    </div>
    <div class="form-group">
        <label for="" class="control-label">Năm sinh bố:</label>
        <input class="form-control" type="text" name="father_year_of_birth" placeholder="Nhập năm sinh bố" value="<?php echo htmlspecialchars($fatherYearOfBirth); ?>" required>
    </div>

    <div class="form-group">
        <label for="" class="control-label">Họ và tên mẹ:</label>
        <input class="form-control" type="text" name="mother_full_name" placeholder="Nhập họ và tên mẹ" value="<?php echo htmlspecialchars($motherFullName); ?>" required>
    </div>
    <div class="form-group">
        <label for="" class="control-label">Nghề nghiệp mẹ:</label>
        <input class="form-control" type="text" name="mother_occupation" placeholder="Nhập nghề nghiệp mẹ" value="<?php echo htmlspecialchars($motherOccupation); ?>" required>
    </div>
    <div class="form-group">
        <label for="" class="control-label">Năm sinh mẹ:</label>
        <input class="form-control" type="text" name="mother_year_of_birth" placeholder="Nhập năm sinh mẹ" value="<?php echo htmlspecialchars($motherYearOfBirth); ?>" required>
    </div>

    <br>
    <input class="btn btn-primary" type="submit" name="sbmcapnhat" value="Cập nhật" onclick="showAlert(event)">
    <a class="btn btn-primary" href="sinhvien.php">Quay lại</a>
</form>
<?php
require_once("footer.php");
?>