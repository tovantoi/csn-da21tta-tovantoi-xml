<!-- xoasinhvien.php -->

<!DOCTYPE html>
<html>

<head>
    <title>Xóa Sinh viên</title>
</head>

<body>
    <h1>Xóa Sinh viên</h1>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['mssv'])) {
        $mssv_to_delete = $_GET['mssv'];

        // Function to load students from XML file
        function loadStudents()
        {
            $xml = new DOMDocument();
            $xml->load('data.xml');
            return $xml;
        }

        // Function to save students to XML file
        function saveStudents($xml)
        {
            $xml->save('data.xml');
        }

        $xml = loadStudents();
        $students = $xml->getElementsByTagName('student');

        foreach ($students as $student) {
            if ($student->getAttribute('mssv') == $mssv_to_delete) {
                $student->parentNode->removeChild($student);

                saveStudents($xml);

                echo "<p>Sinh viên có MSSV $mssv_to_delete đã được xóa thành công.</p>";
                echo "<p><a href='index.php'>Quay lại danh sách Sinh viên</a></p>";

                break;
            }
        }
    } else {
        echo "<p>Không có MSSV được cung cấp để xóa.</p>";
    }
    ?>
</body>

</html>