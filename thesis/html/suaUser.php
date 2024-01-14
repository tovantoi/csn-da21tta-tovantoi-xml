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
$id = $mssv = $fullname = $username = $password = $phone = $email = $role = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['mssv']) && isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['role'])) {
    $id = $_POST['id'];
    $mssv = $_POST['mssv'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    $xml = simplexml_load_file('users.xml');

    if ($xml) {
        $userFound = false;

        foreach ($xml->user as $user) {
            if ($user->attributes()['id'] == $id) {
                $userFound = true;
                $user->mssv = htmlspecialchars($mssv);
                $user->fullname = htmlspecialchars($fullname);
                $user->username = htmlspecialchars($username);
                $user->password = htmlspecialchars($password);
                $user->phone = htmlspecialchars($phone);
                $user->email = htmlspecialchars($email);
                $user->role = htmlspecialchars($role);

                $xml->asXML('users.xml');
                echo "<p>Thông tin người dùng đã được cập nhật thành công.</p>";
                break;
            }
        }

        if (!$userFound) {
            echo "<p>Không tìm thấy người dùng với ID: $id</p>";
        }
    } else {
        echo "Không thể đọc file XML.";
    }
}

?>
<form method="post" action="">
    <div class="form-group">
        <label for="id" class="control-label">ID người dùng cần sửa:</label>
        <input id="id" class="form-control" type="text" name="id" placeholder="id" value="<?php echo htmlspecialchars($id); ?>" required><br>
    </div>
    <?php echo "Giá trị của \$id: " . htmlspecialchars($id); ?>

    <div class="form-group">
        <label for="mssv" class="control-label">MSSV:</label>
        <input id="mssv" class="form-control" type="text" name="mssv" placeholder="mssv" value="<?php echo htmlspecialchars($mssv); ?>" required><br>
    </div>
    <div class="form-group">
        <label for="fullname" class="control-label">Họ và Tên:</label>
        <input id="fullname" class="form-control" type="text" name="fullname" placeholder="họ và tên" value="<?php echo htmlspecialchars($fullname); ?>" required><br>
    </div>
    <div class="form-group">
        <label for="username" class="control-label">Tên tài khoản:</label>
        <input id="username" class="form-control" type="text" name="username" placeholder="tên tài khoản" value="<?php echo htmlspecialchars($username); ?>" required><br>
    </div>
    <div class="form-group">
        <label for="password" class="control-label">Mật khẩu:</label>
        <input id="password" class="form-control" type="text" name="password" placeholder="mật khẩu" value="<?php echo htmlspecialchars($password); ?>" required><br>
    </div>
    <div class="form-group">
        <label for="phone" class="control-label">Số điện thoại:</label>
        <input id="phone" class="form-control" type="text" name="phone" placeholder="số điện thoại" value="<?php echo htmlspecialchars($phone); ?>" required><br>
    </div>

    <div class="form-group">
        <label for="email" class="control-label">Email:</label>
        <input id="email" class="form-control" type="text" name="email" placeholder="email" value="<?php echo htmlspecialchars($email); ?>" required><br>
    </div>

    <div class="form-group">
        <label for="role" class="control-label">Vai trò:</label>
        <input id="role" class="form-control" type="number" name="role" placeholder="role" value="<?php echo htmlspecialchars($role); ?>" required><br>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" name="" value="Cập nhật thông tin ">
    <a class="btn btn-primary" href="showuser.php">Quay lại</a>
</form>
<?php
require_once("footer.php");
?>