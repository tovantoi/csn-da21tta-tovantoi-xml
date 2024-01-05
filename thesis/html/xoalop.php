<?php
require_once("header.php");
?>

<h1>Xóa Lớp</h1>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['class_id'])) {

    $class_id_to_delete = $_GET['class_id'];

    function loadClasse()
    {
        $xml = new DOMDocument();
        $xml->load('lop.xml');
        return $xml;
    }

    function saveClasse($xml)
    {
        $xml->save('lop.xml');
    }

    // Kiểm tra nếu người dùng đã xác nhận xóa
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        $xml = loadClasse();
        $classes = $xml->getElementsByTagName('class');

        foreach ($classes as $class) {
            $classIdElements = $class->getElementsByTagName('class_id');
            foreach ($classIdElements as $classIdElement) {
                $current_class_id = $classIdElement->nodeValue;

                if ($current_class_id == $class_id_to_delete) {
                    $class->parentNode->removeChild($class);
                    saveClasse($xml);
                    echo "<p>Sinh viên có mã lớp $class_id_to_delete đã được xóa thành công.</p>";
                    echo "<p><a href='dsclass.php'>Quay lại danh sách Sinh viên</a></p>";
                    exit();
                }
            }
        }


        echo "<p>Không có mã lớp $class_id_to_delete được tìm thấy để xóa.</p>";
        echo "<p><a href='dsclass.php'>Quay lại danh sách Sinh viên</a></p>";
    } else {

        echo "<p>Bạn có chắc chắn muốn xóa mã lớp $class_id_to_delete không?</p>";
        echo "<p><a href='xoalop.php?class_id=$class_id_to_delete&confirm=yes'>Có</a> ||| <a href='dsclass.php'>Không</a></p>";
    }
}
?>

<?php
require_once("footer.php");
?>