<?php
require_once("header.php");
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nganhhoc']) && isset($_POST['new_nganhhoc'])) {
    $nganhhoc_to_edit = $_POST['nganhhoc'];
    $new_nganhhoc_name = $_POST['new_nganhhoc'];

    $xml = new DOMDocument();
    $xml->load('nganhhoc.xml');

    $nganhhoc_elements = $xml->getElementsByTagName('nganhhoc');
    foreach ($nganhhoc_elements as $nganhhoc) {
        if ($nganhhoc->nodeValue === $nganhhoc_to_edit) {
            $nganhhoc->nodeValue = $new_nganhhoc_name;
            break;
        }
    }

    $xml->save('nganhhoc.xml');
    echo "<p>Tên ngành học đã được cập nhật thành công.</p>";
}
?>

<form method="post" action="xuly_Nganh.php">
    <div class="form-group">
        <label for="nganhsua" class="control-label">Chọn ngành cần sửa:</label>
        <select class="form-control" name="nganhsua" required>
            <?php
            $xml = simplexml_load_file('nganhhoc.xml');
            foreach ($xml->nganhhoc as $nganh) {
                echo "<option value='" . htmlspecialchars($nganh) . "'>" . htmlspecialchars($nganh) . "</option>";
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="new_nganhhoc" class="control-label">Nhập tên mới cho ngành học:</label>
        <input class="form-control" type="text" name="new_nganhhoc" placeholder="Nhập tên mới" required>
    </div>
    <br>
    <input class="btn btn-primary" type="submit" name="capnhat" value="Cập nhật ">
    <a class="btn btn-primary" href="dsNganh.php">Quay lại</a>
</form>

<?php
require_once("footer.php");
?>