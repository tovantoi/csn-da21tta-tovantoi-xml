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
$xmlFilePath = 'sinhvien.xml';
// Hàm kiểm tra xem sinh viên có tồn tại hay không
function isStudentExists($xmlFilePath, $masv)
{
    $xml = simplexml_load_file($xmlFilePath);
    foreach ($xml->student as $st) {
        if ((string)$st['mssv'] == $masv) {
            return true;
        }
    }
    return false;
}

// Hàm thêm sinh vien mới
function addStudent($xmlFilePath, $masv, $tensv, $malop, $diachi, $sdt, $email, $nganhhoc, $gioitinh, $ngaysinh, $anhdaidien, $dantoc, $tongiao, $hotencha, $nghenghiepcha, $namsinhcha, $hotenme, $nghenghiepme, $namsinhme)
{
    $xml = simplexml_load_file($xmlFilePath);

    $newStudent = $xml->addChild('student');
    $newStudent->addAttribute('mssv', $masv);
    $newStudent->addChild('full_name', $tensv);
    $newStudent->addChild('class_code', $malop);
    $newStudent->addChild('address', $diachi);
    $newStudent->addChild('phone', $sdt);
    $newStudent->addChild('email', $email);
    $newStudent->addChild('major', $nganhhoc);
    $newStudent->addChild('gender', $gioitinh);
    $newStudent->addChild('dob', $ngaysinh);
    $newStudent->addChild('avatar', $anhdaidien);
    $newStudent->addChild('ethnicity', $dantoc);
    $newStudent->addChild('religion', $tongiao);
    $parents = $newStudent->addChild('parents');
    $father = $parents->addChild('father');
    $father->addAttribute('full_name', $hotencha);
    $father->addAttribute('occupation', $nghenghiepcha);
    $father->addAttribute('year_of_birth', $namsinhcha);
    $mother = $parents->addChild('mother');
    $mother->addAttribute('full_name', $hotenme);
    $mother->addAttribute('occupation', $nghenghiepme);
    $mother->addAttribute('year_of_birth', $namsinhme);


    // Định dạng xuống dòng và thụt đầu dòng
    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());

    // Lưu thay đổi vào tệp XML
    $dom->save($xmlFilePath);
}

// Hàm cập nhật thông tin Ngành
function updateStudent($xmlFilePath, $masv, $tensv, $malop, $diachi, $sdt, $email, $nganhhoc, $gioitinh, $ngaysinh, $anhdaidien, $dantoc, $tongiao, $hotencha, $nghenghiepcha, $namsinhcha, $hotenme, $nghenghiepme, $namsinhme)
{
    $xml = simplexml_load_file($xmlFilePath);

    // Tìm và cập nhật thông tin Sinh viên
    foreach ($xml->student as $student) {
        if ((string)$student['mssv'] === $masv) {
            $student->full_name = $tensv;
            $student->class_code = $malop;
            $student->address = $diachi;
            $student->phone = $sdt;
            $student->email = $email;
            $student->major = $nganhhoc;
            $student->gender = $gioitinh;
            $student->dob = $ngaysinh;
            $student->avatar = $anhdaidien;
            $student->ethnicity = $dantoc;
            $student->religion = $tongiao;

            $student->parents->father->attributes()->full_name = $hotencha;
            $student->parents->father->attributes()->occupation = $nghenghiepcha;
            $student->parents->father->attributes()->year_of_birth = $namsinhcha;

            $student->parents->mother->attributes()->full_name = $hotenme;
            $student->parents->mother->attributes()->occupation = $nghenghiepme;
            $student->parents->mother->attributes()->year_of_birth = $namsinhme;

            // Lưu thay đổi vào tệp XML
            $xml->asXML($xmlFilePath);

            // Kết thúc vòng lặp vì đã tìm thấy và cập nhật Sinh viên
            break;
        }
    }
}

// Hàm xóa Sinhvien
function deleteSinhvien($xmlFilePath, $masv)
{
    $xml = simplexml_load_file($xmlFilePath);
    $sinhvien = $xml->xpath("//sinhvien[@masv='$masv']");

    unset($sinhvien[0][0]);

    $xml->asXML($xmlFilePath);
}

function myAlert($msg, $url)
{
    echo '<script language="javascript">alert("' . $msg . '");</script>';
    echo "<script>document.location = '$url'</script>";
}

if (isset($_POST["add_student"])) {
    $xml = simplexml_load_file($xmlFilePath);

    $masv = $_POST["mssv"];
    $tensv = $_POST["full_name"];
    $malop = $_POST["class_code"];
    $diachi = $_POST["address"];
    $sdt = $_POST["phone"];
    $email = $_POST["email"];
    $nganhhoc = $_POST["major"];
    $gioitinh = $_POST["gender"];
    $ngaysinh = $_POST["dob"];
    $dantoc = $_POST["ethnicity"];
    $tongiao = $_POST["religion"];
    $hotencha = $_POST["father_full_name"];
    $nghenghiepcha = $_POST["father_occupation"];
    $namsinhcha = $_POST["father_year_of_birth"];
    $hotenme = $_POST["mother_full_name"];
    $nghenghiepme = $_POST["mother_occupation"];
    $namsinhme = $_POST["mother_year_of_birth"];
    //Upload file
    $anhdaidien = $_FILES["avatar"]["name"];

    $target_dir = "img/";
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    $uploadOk = 1;
    $target_width = 200;
    $target_height = 200;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    if (isset($_POST["add_student"])) {
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["avatar"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    if (isStudentExists($xmlFilePath, $masv)) {
        myAlert("Mã sinh viên đã tồn tại", "themsinhvien.php");
    } else {
        addStudent($xmlFilePath, $masv, $tensv, $malop, $diachi, $sdt, $email, $nganhhoc, $gioitinh, $ngaysinh, $anhdaidien, $dantoc, $tongiao, $hotencha, $nghenghiepcha, $namsinhcha, $hotenme, $nghenghiepme, $namsinhme);


        echo "<script>alert('Sinh viên với mã số $masv đã được thêm thành công!'); window.location.href='sinhvien.php';</script>";
    }
}
if (isset($_POST["sbmcapnhat"])) {
    $masv = $_POST["mssv"];
    $tensv = $_POST["full_name"];
    $malop = $_POST["class_code"];
    $diachi = $_POST["address"];
    $sdt = $_POST["phone"];
    $email = $_POST["email"];
    $nganhhoc = $_POST["major"];
    $gioitinh = $_POST["gender"];
    $ngaysinh = $_POST["dob"];
    $anhdaidien = $_POST["avatar"];
    $dantoc = $_POST["ethnicity"];
    $tongiao = $_POST["religion"];
    $hotencha = $_POST["father_full_name"];
    $nghenghiepcha = $_POST["father_occupation"];
    $namsinhcha = $_POST["father_year_of_birth"];
    $hotenme = $_POST["mother_full_name"];
    $nghenghiepme = $_POST["mother_occupation"];
    $namsinhme = $_POST["mother_year_of_birth"];

    updateStudent(
        $xmlFilePath,
        $masv,
        $tensv,
        $malop,
        $diachi,
        $sdt,
        $email,
        $nganhhoc,
        $gioitinh,
        $ngaysinh,
        $anhdaidien,
        $dantoc,
        $tongiao,
        $hotencha,
        $nghenghiepcha,
        $namsinhcha,
        $hotenme,
        $nghenghiepme,
        $namsinhme
    );
    if ($_SESSION["role"] === "1") {
        // Hiển thị thông báo và chuyển hướng sử dụng JavaScript
        echo '<script>
    alert("Bạn đã cập nhật thành công!");
    window.location.href = "xemsv.php?mssv=' . $_SESSION["mssv"] . '";
  </script>';
        exit();
    } else {
        echo '<script>
        alert("Bạn đã cập nhật thành công!");
        window.location.href = "sinhvien.php?mssv=' . $_SESSION["mssv"] . '";
    </script>';
    }
}


if (isset($_GET["manganh"])) {
    $ma = $_GET["manganh"];
    deleteSinhvien($xmlFilePath, $ma);
    myAlert("Xóa thành công", "themsinhvien.php");
}
?>
<?php
require_once("footer.php");
?>