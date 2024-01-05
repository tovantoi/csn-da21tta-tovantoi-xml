<?php
require_once("header.php");
?>
<?php
// Tìm thông tin lớp cần chỉnh sửa từ tệp XML
$xml = simplexml_load_file('lop.xml');
$class_id_to_edit = isset($_GET['class_id']) ? $_GET['class_id'] : '';
$class_to_edit = null;

// Lặp qua danh sách lớp để tìm lớp cần chỉnh sửa
foreach ($xml->class as $class) {
    if ((string)$class->class_id == $class_id_to_edit) {
        $class_to_edit = $class;
        break;
    }
}

if (!$class_to_edit) {
    echo "Không tìm thấy thông tin lớp cần chỉnh sửa.";
    exit;
}

// Gán thông tin lớp vào các biến để hiển thị lại trong form
$class_id = (string)$class_to_edit->class_id;
$class_name = (string)$class_to_edit->name;
?>

<h1>Chỉnh sửa thông tin lớp</h1>
<form method="POST" action="xyly_lop.php">
    <div class="form-group">
        <label for="class_id">Mã lớp:</label>
        <input id="class_id" type="text" name="class_id" value="<?php echo htmlspecialchars($class_id); ?>" required>
    </div><br>
    <div class="form-group">
        <label for="class_name">Tên lớp:</label>
        <input id="class_name" type="text" name="class_name" value="<?php echo htmlspecialchars($class_name); ?>" required>
    </div><br>
    <input class="btn btn-primary" type="submit" name="sbmcapnhat" value="Cập nhật ">
    <a class="btn btn-primary" href="dsclass.php">Quay lại</a>

    <script>
        // Kiểm tra nếu URL chứa thông tin về việc cập nhật thành công
        const urlParams = new URLSearchParams(window.location.search);
        const successParam = urlParams.get('success');

        // Nếu có thông tin về thành công, hiển thị thông báo
        if (successParam === 'true') {
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: 'Dữ liệu đã được cập nhật thành công!'
            });
        }
    </script>
</form>
<?php
require_once("footer.php");
?>