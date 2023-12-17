<?php
//require '../../vendor/autoload.php'; // Đường dẫn đến autoload.php của Composer

// Đường dẫn đến tài liệu XML
//$xmlFilePath = '../../QuanlyXML/Nganh.xml';
$xmlFilePath = 'data.xml';
// Hàm kiểm tra xem Ngành có tồn tại hay không
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
function updateStudent($xmlFilePath, $masv, $tensv)
{
    $xml = simplexml_load_file($xmlFilePath);
    // Tìm và cập nhật thông tin Ngành
    foreach ($xml->student as $student) {
        if ((string)$student['manganh'] === $masv) {
            // Cập nhật Ngành
            $student->tennganh = $tensv;

            // Lưu thay đổi vào tệp XML
            $xml->asXML($xmlFilePath);

            // Kết thúc vòng lặp vì đã tìm thấy và cập nhật Ngành
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

    $masv = $_POST["mssv"];
    $tensv = $_POST["full_name"];
    $malop = $_POST["major"];
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

    if (isStudentExists($xmlFilePath, $masv)) {
        myAlert("Mã sinh viên đã tồn tại", "themsinhvien.php");
    } else {
        addStudent($xmlFilePath, $masv, $tensv, $malop, $diachi, $sdt, $email, $nganhhoc, $gioitinh, $ngaysinh, $anhdaidien, $dantoc, $tongiao, $hotencha, $nghenghiepcha, $namsinhcha, $hotenme, $nghenghiepme, $namsinhme);
        header("Location: themsinhvien.php");
    }
}
if (isset($_POST["sbmhuy"])) {
    header("Location: themsinhvien.php");
}
if (isset($_POST["sbmcapnhat"])) {
    $manganh = $_POST["txtmanganh"];
    $tennganh = $_POST["txttennganh"];
    updateStudent($xmlFilePath, $manganh, $tennganh);
    header("Location: themsinhvien.php");
}
if (isset($_GET["manganh"])) {
    $ma = $_GET["manganh"];
    deleteSinhvien($xmlFilePath, $ma);
    myAlert("Xóa thành công", "themsinhvien.php");
}
