<?php
require_once("header.php");
?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['new_nganhhoc'])) {
    $new_nganhhoc_name = $_POST['new_nganhhoc'];

    $xml = new DOMDocument();
    $xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;

    if (file_exists('nganhhoc.xml')) {
        $xml->load('nganhhoc.xml');
        $nganhhoc_list = $xml->getElementsByTagName('dsnganhhoc')->item(0);
    } else {
        $root = $xml->createElement('dsnganhhoc');
        $xml->appendChild($root);
        $nganhhoc_list = $root;
    }

    $new_nganhhoc = $xml->createElement('nganhhoc', htmlspecialchars($new_nganhhoc_name));
    $nganhhoc_list->appendChild($new_nganhhoc);

    $xml->save('nganhhoc.xml');
    echo "<script>alert('Ngành học $new_nganhhoc_name đã được thêm thành công!'); window.location.href='dsNganh.php';</script>";
    exit();
}
?>

<form method="post" action="">
    <div class="form-group">
        <label for="new_nganhhoc" class="control-label">Nhập tên ngành học mới:</label>
        <input class="form-control" type="text" name="new_nganhhoc" placeholder="Nhập tên ngành" required>
    </div><br>
    <input class="btn btn-primary" type="submit" name="add_student" value="Thêm mới ">
    <a class="btn btn-primary" href="dsNganh.php">Quay lại</a>
</form>
<?php
require_once("footer.php");
?>