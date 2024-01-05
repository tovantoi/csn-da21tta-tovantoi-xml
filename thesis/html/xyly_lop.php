<?php
$xmlFilePath = 'lop.xml';
$xml = 'nganhhoc.xml';
// Hàm kiểm tra xem mã lớp có tồn tại hay không
function isClasseExists($xmlFilePath, $malop)
{
    $xml = simplexml_load_file($xmlFilePath);
    foreach ($xml->class as $cl) {
        if ((string)$cl['class_id'] == $malop) {
            return true;
        }
    }
    return false;
}

//Hàm thêm lớp mới
function addClasse($xmlFilePath, $malop, $tenlop)
{
    $xml = simplexml_load_file($xmlFilePath);

    $newClasse = $xml->addChild('class');
    $newClasse->addChild('class_id', $malop);
    $newClasse->addChild('name', $tenlop);

    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());

    // Lưu thay đổi vào tệp XML
    $dom->save($xmlFilePath);
}
// Hàm cập nhật thông tin lớp
function updateClasse($xmlFilePath, $malop, $tenlop)
{
    $xml = simplexml_load_file($xmlFilePath);

    foreach ($xml->class as $class) {
        if ((string)$class->class_id === $malop) {
            $class->name = $tenlop;

            // Lưu thay đổi vào tệp XML
            file_put_contents($xmlFilePath, $xml->asXML());

            return true; // Trả về true sau khi cập nhật thành công
        }
    }

    return false; // Trả về false nếu không tìm thấy lớp cần cập nhật
}
function updateNganh($xml, $nganhsua, $tenMoiNganh)
{
    $xml = simplexml_load_file($xml);

    foreach ($xml->nganhhoc as $nganh) {
        if ((string)$nganh === $nganhsua) {
            $nganh[0] = $tenMoiNganh;

            // Lưu thay đổi vào tệp XML
            $xml->asXML($xml);

            return true; // Trả về true sau khi cập nhật thành công
        }
    }

    return false; // Trả về false nếu không tìm thấy ngành cần cập nhật
}

//hàm xóa user


// Hàm xóa Sinhvien
function deleteSinhvien($xmlFilePath, $malop)
{
    $xml = simplexml_load_file($xmlFilePath);
    $sinhvien = $xml->xpath("//sinhvien[@masv='$malop']");

    if ($sinhvien) {
        // Sử dụng JavaScript để xác nhận xóa
        echo "<script>
            var confirmDelete = confirm('Bạn có chắc chắn muốn xóa sinh viên có mã số $malop không?');
            if (confirmDelete) {
                // Nếu người dùng nhấn OK, tiến hành xóa
                unset(\$sinhvien[0][0]);
                \$xml->asXML('$xmlFilePath');
                alert('Đã xóa sinh viên có mã số $malop.');
            } else {
                // Nếu người dùng nhấn Cancel, hủy bỏ
                alert('Đã hủy xóa.');
            }
            </script>";
    } else {
        echo "Không tìm thấy sinh viên có mã số $malop.";
    }
}

function myAlert($msg, $url)
{
    echo '<script language="javascript">alert("' . $msg . '");</script>';
    echo "<script>document.location = '$url'</script>";
}
if (isset($_POST["add_student"])) {
    $malop = $_POST["class_id"];
    $tenlop = $_POST["class_name"];


    if (isClasseExists($xmlFilePath, $malop)) {
        myAlert("Mã lớp đã tồn tại", "addclasses.php");
    } else {
        addClasse($xmlFilePath, $malop, $tenlop);
        echo "<script>alert('Mã lớp đã được thêm thành công!'); window.location.href='dsclass.php';</script>";
    }
    return "Sinh viên với mã số $malop đã được thêm thành công!";
}

if (isset($_POST["sbmhuy"])) {
    header("Location: addclasses.php");
}
if (isset($_POST["sbmcapnhat"])) {
    $malop = $_POST["class_id"];
    $tenlop = $_POST["class_name"];
    updateClasse($xmlFilePath, $malop, $tenlop);
    echo "<p><a href='suamalop.php?malop=$malop đã thêm thành công";
    header("Location: dsclass.php?success=true");
    exit;
}

if (isset($_GET["manganh"])) {
    $malop = $_GET["manganh"];
    deleteSinhvien($xmlFilePath, $malop);
    myAlert("Xóa thành công", "addclasses.php");
}
if (isset($_POST["capnhat"])) {
    $nganhsua = $_POST["nganhsua"];
    $tenMoiNganh = $_POST["tenmoinganh"]; // Đây là tên mới của ngành

    if (updateNganh($xml, $nganhsua, $tenMoiNganh)) {
        echo "<script>alert('Ngành học $nganhsua đã được sửa thành  $tenMoiNganh!'); window.location.href='dsNganh.php';</script>";
    } else {
        echo "<p>Không thể sửa thông tin ngành học";
    }
}
