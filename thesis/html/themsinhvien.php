<?php
require_once("header.php");
?>
<?php
function loadStudents()
{
    $xml = new DOMDocument();
    $xml = simplexml_load_file('sinhvien.xml');
    // $xml->load('sinhvien.xml');

    return $xml;
}

function saveStudents($xml)
{
    $xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;
    $xml->loadXML($xml->asXML());
    $xml->save('sinhvien.xml');
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add_student'])) {
        $xml = loadStudents();
        $root = $xml->documentElement;
        $student = $xml->createElement('student');

        $student->setAttribute('mssv', $_POST['mssv']);

        $full_name = $xml->createElement('full_name', $_POST['full_name']);
        $class_code = $xml->createElement('class_code', $_POST['class_code']);

        // Thêm dữ liệu từ file XML thứ 2 vào file XML chính

        $address = $xml->createElement('address', $_POST['address']);
        $phone = $xml->createElement('phone', $_POST['phone']);
        $email = $xml->createElement('email', $_POST['email']);
        $major = $xml->createElement('major', $_POST['major']);
        $gender = $xml->createElement('gender', $_POST['gender']);
        $dob = $xml->createElement('dob', $_POST['dob']);
        $avatar = $xml->createElement('avatar', $_POST['avatar']);
        $ethnicity = $xml->createElement('ethnicity', $_POST['ethnicity']);
        $religion = $xml->createElement('religion', $_POST['religion']);

        $student->appendChild($full_name);
        $student->appendChild($class_code);
        $student->appendChild($address);
        $student->appendChild($phone);
        $student->appendChild($email);
        $student->appendChild($major);
        $student->appendChild($gender);
        $student->appendChild($dob);
        $student->appendChild($avatar);
        $student->appendChild($ethnicity);
        $student->appendChild($religion);

        $parents = $xml->createElement('parents');
        $father = $xml->createElement('father');
        $father->setAttribute('full_name', $_POST['father_full_name']);
        $father->setAttribute('occupation', $_POST['father_occupation']);
        $father->setAttribute('year_of_birth', $_POST['father_year_of_birth']);
        $mother = $xml->createElement('mother');
        $mother->setAttribute('full_name', $_POST['mother_full_name']);
        $mother->setAttribute('occupation', $_POST['mother_occupation']);
        $mother->setAttribute('year_of_birth', $_POST['mother_year_of_birth']);

        $parents->appendChild($father);
        $parents->appendChild($mother);

        $student->appendChild($parents);

        $root->appendChild($student);

        saveStudents($xml);
    }
}
?>
<style>
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
<h1>Thêm mới một sinh viên</h1>
<form method="post" action="Xuly_sinhvien.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="" class="control-label">Ngành học:</label>
        <select class="form-control" name="major" required>
            <?php
            $xml = simplexml_load_file('nganhhoc.xml');
            foreach ($xml->children() as $nganhhoc) {
                echo "<option value='" . htmlspecialchars($nganhhoc) . "'>" . htmlspecialchars($nganhhoc) . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="class_code" class="control-label">Chọn lớp:</label>
        <select id="class_code" class="form-control" name="class_code" required>
            <?php
            $xml = simplexml_load_file('lop.xml');
            foreach ($xml->class as $lop) {
                $class_id = $lop->class_id;
                $class_name = $lop->name;
                echo "<option value='$class_name'>$class_id</option>";
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
        <input class="form-control" type="text" name="full_name" placeholder="Tên sinh viên" required>
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
        <input class="form-control" type="text" name="ethnicity" placeholder="nhập dân tộc" required>
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
    <input class="btn btn-primary" type="submit" name="add_student" value="Thêm mới">
    <a class="btn btn-primary" href="sinhvien.php">Quay lại</a>
</form>
<?php
require_once("footer.php");
?>