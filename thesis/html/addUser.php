<?php
require_once("header.php");
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['mssv']) && isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['role'])) {
    $id = $_POST['id']; // Lấy giá trị ID từ form
    $mssv = $_POST['mssv'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $xml = simplexml_load_file('users.xml');

    if ($xml) {
        $user = $xml->addChild('user');
        $user->addAttribute('id', $id); // Sử dụng giá trị ID từ form
        $user->addChild('mssv', htmlspecialchars($mssv));
        $user->addChild('fullname', htmlspecialchars($fullname));
        $user->addChild('username', htmlspecialchars($username));
        $user->addChild('password', htmlspecialchars($password)); // Remember: Encrypt password before storing in production!
        $user->addChild('phone', htmlspecialchars($phone));
        $user->addChild('email', htmlspecialchars($email));
        $user->addChild('role', htmlspecialchars($role));

        $dom = new DOMDocument('1.0');
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;

        $xml->asXML('users.xml');
        echo "<script>alert('Người dùng mới với mã số $mssv đã được thêm thành công!'); window.location.href='showuser.php';</script>";
    } else {
        echo "Không thể đọc file XML.";
    }
}
?>

<form method="post" action="">
    <div class="form-group">
        <label for="id" class="control-label">ID:</label>
        <input class="form-control" type="text" name="id" id="id" placeholder="Nhập id người dùng" required><br>
    </div>
    <div class="form-group">
        <label for="mssv" class="control-label">MSSV:</label>
        <input class="form-control" type="text" name="mssv" id="mssv" placeholder="Nhập mã số sinh viên người dùng" required><br>
    </div>
    <div class="form-group">
        <label for="fullname" class="control-label">Họ và Tên:</label>
        <input class="form-control" type="text" name="fullname" id="fullname" placeholder="Nhập tên đầy đủ của người dùng" required><br>
    </div>
    <div class="form-group">
        <label for="username" class="control-label">Tên tài khoản:</label>
        <input class="form-control" type="text" name="username" id="username" placeholder="Nhập tên tài khoản người dùng" required><br>
    </div>
    <div class="form-group">
        <label for="password" class="control-label">Mật khẩu:</label>
        <input class="form-control" type="password" name="password" id="password" placeholder="Nhập mật khẩu người dùng" required><br>
    </div>
    <div class="form-group">
        <label for="phone" class="control-label">Số điện thoại:</label>
        <input class="form-control" type="text" name="phone" id="phone" placeholder="Nhập số điện thoại người dùng" required><br>
    </div>
    <div class="form-group">
        <label for="email" class="control-label">Email:</label>
        <input class="form-control" type="email" name="email" id="email" placeholder="Nhập email người dùng" required><br>
    </div>
    <div class="form-group">
        <label for="role" class="control-label">Vai trò:</label>
        <input class="form-control" type="text" name="role" id="role" placeholder="Nhập quyền cho người dùng" required><br>
    </div><br>
    <input class="btn btn-primary" type="submit" value="Thêm mới">
    <a class="btn btn-primary" href="showuser.php">Quay lại</a>
</form>
<?php
require_once("footer.php");
?>