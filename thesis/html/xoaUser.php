<?php
$xmlFilePath = 'users.xml';
function deleteUser($xmlFilePath, $mssv)
{
    $xml = simplexml_load_file($xmlFilePath);
    $users = $xml->xpath("//user[mssv='$mssv']");

    if (!empty($users)) {
        unset($users[0][0]); // Xóa người dùng đầu tiên được tìm thấy với MSSV tương ứng

        $xml->asXML($xmlFilePath);
    }
}

if (isset($_GET["mssv"])) {
    $mssv = $_GET["mssv"];
    $xmlFilePath = "users.xml"; // Đường dẫn đến tệp users.xml
    deleteUser($xmlFilePath, $mssv);
    // Gọi hàm để thông báo thành công và chuyển hướng tới trang khác nếu cần
    echo "<p>Người dùng có mã số $mssv đã được xóa thành công.</p>";
    echo "<p><a href='showuser.php'>Quay lại danh sách người dùng</a></p>"; // Thay đổi showuser.php bằng trang bạn muốn chuyển hướng đến
}
