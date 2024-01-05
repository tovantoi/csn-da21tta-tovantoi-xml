<?php
require_once("header.php");
?>
<h1>Thêm Mã Lớp</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['class_id']) && isset($_POST['class_name'])) {
    $class_id = $_POST['class_id'];
    $class_name = $_POST['class_name'];

    $xml = new DOMDocument();
    $xml->load('lop.xml');

    // Tạo phần tử 'class'
    $new_class = $xml->createElement('class');

    // Tạo phần tử 'class_id' và 'name' và gán giá trị từ form
    $class_id_element = $xml->createElement('class_id', $class_id);
    $class_name_element = $xml->createElement('name', $class_name);

    // Thêm các phần tử vào phần tử 'class'
    $new_class->appendChild($class_id_element);
    $new_class->appendChild($class_name_element);

    // Thêm phần tử 'class' vào phần tử 'classes' trong tệp XML
    $classes = $xml->getElementsByTagName('classes')->item(0);
    $classes->appendChild($new_class);

    $dom = new DOMDocument('1.0');
    $dom->preserveWhiteSpace = false;
    $dom->formatOutput = true;
    $xml->save('lop.xml');

    // Lưu tệp XML sau khi thêm

} else {
    echo '
    <form action="xyly_lop.php" method="post">
    <div class="form-group">
        <label for="class_id" class="control-label">Mã lớp:</label>
        <input id="class_id" class="form-control" type="text" name="class_id" placeholder="nhập mã lớp" required>
    </div>
    <div class="form-group">
        <label for="class_name" class="control-label">Tên lớp:</label>
        <input id="class_name" class="form-control" type="text" name="class_name" placeholder="nhập tên lớp" required>
    </div>
        <br>
    <input class="btn btn-primary" type="submit" name="add_student" value="Thêm">
    <a class="btn btn-primary" href="dsclass.php">Quay lại</a>
    </form>';
}
?>


<?php
require_once("footer.php");
?>