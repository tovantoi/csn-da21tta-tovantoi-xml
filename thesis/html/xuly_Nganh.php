<?php
$xmlFilePath = 'nganhhoc.xml';

// Hàm kiểm tra xem ngành học có tồn tại hay không
function isNganhExists($xmlFilePath, $tennganh)
{
    $xml = simplexml_load_file($xmlFilePath);
    foreach ($xml->nganhhoc as $nganh) {
        if ((string)$nganh == $tennganh) {
            return true;
        }
    }
    return false;
}

// Hàm thêm ngành học mới
function addNganh($xmlFilePath, $tennganh)
{
    $xml = simplexml_load_file($xmlFilePath);

    $newNganh = $xml->addChild('nganhhoc', $tennganh);

    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $dom->loadXML($xml->asXML());

    // Lưu thay đổi vào tệp XML
    $dom->save($xmlFilePath);
}

// Hàm cập nhật thông tin ngành học
function updateNganh($xmlFilePath, $nganhsua, $tenMoiNganh)
{
    $xml = simplexml_load_file($xmlFilePath);

    foreach ($xml->nganhhoc as $nganh) {
        if ((string)$nganh === $nganhsua) {
            $nganh[0] = $tenMoiNganh;

            // Lưu thay đổi vào tệp XML
            $xml->asXML($xmlFilePath);

            return true; // Trả về true sau khi cập nhật thành công
        }
    }

    return false; // Trả về false nếu không tìm thấy ngành cần cập nhật
}
// Hàm xóa ngành học
function deleteNganh($xmlFilePath, $tennganh)
{
    $xml = simplexml_load_file($xmlFilePath);
    $xpathExpression = "//nganhhoc[text()='$tennganh']";
    $nganh = $xml->xpath($xpathExpression);

    if ($nganh) {
        // Xác nhận xóa ngành
        unset($nganh[0][0]);
        $xml->asXML($xmlFilePath);
        return true;
    } else {
        return false;
    }
}

function myAlert($msg, $url)
{
    echo '<script language="javascript">alert("' . $msg . '");</script>';
    echo "<script>document.location = '$url'</script>";
}
if (isset($_POST["addnganh"])) {
    $tennganh = $_POST["nganh"];

    if (isNganhExists($xmlFilePath, $tennganh)) {
        myAlert("Mã lớp đã tồn tại", "addNganh.php");
    } else {
        // Thêm ngành mới
        addNganh($xmlFilePath, $tennganh);
        header("Location: addNganh.php");
    }
    return "Ngành $tennganh đã được thêm thành công!";
}


if (isset($_POST["sbmhuy"])) {
    header("Location: addclasses.php");
}
if (isset($_POST["capnhat"])) {
    $nganhsua = $_POST["nganhsua"];
    $tenMoiNganh = $_POST["new_nganhhoc"];

    if (updateNganh('nganhhoc.xml', $nganhsua, $tenMoiNganh)) {
        echo "<p>Đã sửa thông tin ngành học thành công</p>";
        header("Location: dsNganh.php?success=true");
        exit;
    } else {
        echo "<p>Không thể sửa thông tin ngành học</p>";
    }
}

if (isset($_POST["xoanganh"])) {
    $tennganh = $_POST["tennganh"];
    deleteNganh($xmlFilePath, $tennganh);
    // Thực hiện hành động sau khi xóa
}
