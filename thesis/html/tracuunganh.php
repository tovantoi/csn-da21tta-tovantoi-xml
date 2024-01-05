<?php
require_once("header.php");
$masv = "";
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['mssv'])) {
        $masv = $_GET['mssv'];
    }
}
?>
<h2>Tra cứu Sinh viên</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
        <label for="query" class="control-label">Nhập tên ngành học: </label>
        <input id="query" class="form-control" type="text" name="query" placeholder="Nhập mã lớp cần tìm" required>
    </div><br>
    <input class="btn btn-primary" type="submit" name="submit" value="Tra cứu">
    <a class="btn btn-primary" href="quantri.php">Quay lại</a>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = $_POST['query'];
    $xml = simplexml_load_file('sinhvien.xml');

    if ($xml !== false) {
        $found_students = array();
        foreach ($xml->student as $student) {
            if (strpos(strtolower($student->major), strtolower($query)) !== false) {
                $found_students[] = $student;
            }
        }

        if (!empty($found_students)) {
            echo "<h3>Danh sách sinh viên ngành $query:</h3>";
            echo "<div class='table-responsive-md'>";
            echo "<table class='table table-hover'>";
            echo "<tr><th>MSSV</th><th>Họ và tên</th><th>Lớp</th><th>Địa chỉ</th><th>SĐT</th><th>Giới tính</th><th>Ngày sinh</th><th>Chi tiết</th></tr>";

            foreach ($found_students as $student) {
                echo "<tr>";
                echo "<td>" . $student->attributes()->mssv . "</td>";
                echo "<td>" . $student->full_name . "</td>";
                echo "<td>" . $student->class_code . "</td>";
                echo "<td>" . $student->address . "</td>";
                echo "<td>" . $student->phone . "</td>";
                echo "<td>" . $student->gender . "</td>";
                echo "<td>" . $student->dob . "</td>";
                echo "<td><a class='btn btn-primary' href='xemsv.php?mssv=" . $student->attributes()->mssv . "'>Xem</a></td>";
                echo "</tr>";
            }

            echo "</table>";
            echo "</div>";
        } else {
            echo "Không tìm thấy sinh viên trong ngành $query.";
        }
    } else {
        echo "Không thể đọc tệp XML.";
    }
}
?>
<?php
require_once("footer.php");
?>