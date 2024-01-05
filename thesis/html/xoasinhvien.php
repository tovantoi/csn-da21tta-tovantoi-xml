<?php
require_once("header.php");
?>
<h1>Xóa Sinh viên</h1>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['mssv'])) {
    $mssv_to_delete = $_GET['mssv'];

    // Function to load students from XML file
    function loadStudents()
    {
        $xml = new DOMDocument();
        $xml->load('sinhvien.xml');
        return $xml;
    }

    // Function to save students to XML file
    function saveStudents($xml)
    {
        $xml->save('sinhvien.xml');
    }

    // Check if user confirmed deletion
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'yes') {
        $xml = loadStudents();
        $students = $xml->getElementsByTagName('student');

        foreach ($students as $student) {
            if ($student->getAttribute('mssv') == $mssv_to_delete) {
                $student->parentNode->removeChild($student);

                saveStudents($xml);

                echo "<p>Sinh viên có MSSV $mssv_to_delete đã được xóa thành công.</p>";
                echo "<p><a href='sinhvien.php'>Quay lại danh sách Sinh viên</a></p>";

                break;
            }
        }
    } else {
        // Display confirmation dialog
        echo "<p>Bạn có chắc chắn muốn xóa sinh viên có MSSV $mssv_to_delete không?</p>";
        echo "<p><a href='xoasinhvien.php?mssv=$mssv_to_delete&confirm=yes'>Có</a> | <a href='sinhvien.php'>Không</a></p>";
    }
} else {
    echo "<p>Không có MSSV được cung cấp để xóa.</p>";
}
?>
<?php
require_once("footer.php");
?>