<?php
require_once("header.php");
?>
<?php
$xml = simplexml_load_file('users.xml');
$mssv = isset($_POST['mssv']) ? $_POST['mssv'] : ''; // Khởi tạo $mssv, nếu không tồn tại thì gán giá trị rỗng

if ($xml) {
    echo "<h2>Thông tin người dùng</h2>";
    echo "<a class = 'btn btn-primary' href='addUser.php?mssv=$mssv'>Thêm mới</a>";
    echo '<div class="table-responsive-md">';
    echo '<table class="table table-hover">';
    echo '<tr><th>ID</th><th>MSSV</th><th>Họ và Tên</th><th>Tên tài khoản</th><th>Số điện thoại</th><th>Email</th><th>Sửa</th><th>Xóa</th></tr>';

    foreach ($xml->user as $user) {
        if ((int)$user->role === 1) {
            $id = $user->attributes()->id;
            $mssv = $user->mssv;
            $fullname = $user->fullname;
            $username = $user->username;
            $phone = $user->phone;
            $email = $user->email;

            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$mssv</td>";
            echo "<td>$fullname</td>";
            echo "<td>$username</td>";
            echo "<td>$phone</td>";
            echo "<td>$email</td>";
            echo "<td><a class='btn btn-success' href='suaUser.php?mssv=$mssv'>Sửa</a></td>";
            echo "<td><a class='btn btn-danger' href='xoaUser.php?mssv=$mssv' onclick='return confirm(\"Bạn có chắc chắn muốn xóa không?\")'>Xóa</a></td>";
            echo "</tr>";
        }
    }

    echo "</table></div>";
} else {
    echo "Không thể đọc file XML.";
}
?>

    <?php
    require_once("footer.php");
    ?>