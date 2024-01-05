<?php
require_once("header.php");
?>
<?php
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

function loadClasse()
{
  $xml = simplexml_load_file('lop.xml');
  return $xml;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['add_student'])) {
    $xml = loadStudents();
    $root = $xml->documentElement;
    $student = $xml->createElement('student');

    $student->setAttribute('mssv', $_POST['mssv']);

    $full_name = $xml->createElement('full_name', $_POST['full_name']);
    $class_code = $xml->createElement('class_code', $_POST['class_code']);

    // Thêm dữ liệu từ file XML thứ 2 vào file XML chính

    $address = $xml->createElement('address', $_POST['address']);
    $phone = $xml->createElement('phone', $_POST['phone']);
    $email = $xml->createElement('email', $_POST['email']);
    $major = $xml->createElement('major', $_POST['major']);
    $gender = $xml->createElement('gender', $_POST['gender']);
    $dob = $xml->createElement('dob', $_POST['dob']);
    $avatar = $xml->createElement('avatar', $_POST['avatar']);
    $ethnicity = $xml->createElement('ethnicity', $_POST['ethnicity']);
    $religion = $xml->createElement('religion', $_POST['religion']);

    $student->appendChild($full_name);
    $student->appendChild($class_code);
    $student->appendChild($address);
    $student->appendChild($phone);
    $student->appendChild($email);
    $student->appendChild($major);
    $student->appendChild($gender);
    $student->appendChild($dob);
    $student->appendChild($avatar);
    $student->appendChild($ethnicity);
    $student->appendChild($religion);

    $parents = $xml->createElement('parents');
    $father = $xml->createElement('father');
    $father->setAttribute('full_name', $_POST['father_full_name']);
    $father->setAttribute('occupation', $_POST['father_occupation']);
    $father->setAttribute('year_of_birth', $_POST['father_year_of_birth']);
    $mother = $xml->createElement('mother');
    $mother->setAttribute('full_name', $_POST['mother_full_name']);
    $mother->setAttribute('occupation', $_POST['mother_occupation']);
    $mother->setAttribute('year_of_birth', $_POST['mother_year_of_birth']);

    $parents->appendChild($father);
    $parents->appendChild($mother);

    $student->appendChild($parents);

    $root->appendChild($student);

    saveStudents($xml);
  } elseif (isset($_POST['suasinhvien'])) {
    $xml = loadStudents();
    $mssv = $_POST['mssv'];
    $students = $xml->getElementsByTagName('student');
    foreach ($students as $student) {
      if ($student->getAttribute('mssv') == $mssv) {
        $student->getElementsByTagName('full_name')->item(0)->nodeValue = $_POST['full_name'];
        $student->getElementsByTagName('class_code')->item(0)->nodeValue = $_POST['class_code'];
        $student->getElementsByTagName('address')->item(0)->nodeValue = $_POST['address'];
        $student->getElementsByTagName('phone')->item(0)->nodeValue = $_POST['phone'];
        $student->getElementsByTagName('email')->item(0)->nodeValue = $_POST['email'];
        $student->getElementsByTagName('major')->item(0)->nodeValue = $_POST['major'];
        $student->getElementsByTagName('gender')->item(0)->nodeValue = $_POST['gender'];
        $student->getElementsByTagName('dob')->item(0)->nodeValue = $_POST['dob'];
        $student->getElementsByTagName('avatar')->item(0)->nodeValue = $_POST['avatar'];
        $student->getElementsByTagName('ethnicity')->item(0)->nodeValue = $_POST['ethnicity'];
        $student->getElementsByTagName('religion')->item(0)->nodeValue = $_POST['religion'];

        $father = $student->getElementsByTagName('father')->item(0);
        $father->setAttribute('full_name', $_POST['father_full_name']);
        $father->setAttribute('occupation', $_POST['father_occupation']);
        $father->setAttribute('year_of_birth', $_POST['father_year_of_birth']);

        $mother = $student->getElementsByTagName('mother')->item(0);
        $mother->setAttribute('full_name', $_POST['mother_full_name']);
        $mother->setAttribute('occupation', $_POST['mother_occupation']);
        $mother->setAttribute('year_of_birth', $_POST['mother_year_of_birth']);

        saveStudents($xml);
        break;
      }
    }
  } elseif (isset($_POST['xoasinhvien'])) {
    $xml = loadStudents();
    $mssv = $_POST['mssv'];
    $students = $xml->getElementsByTagName('student');
    foreach ($students as $student) {
      if ($student->getAttribute('mssv') == $mssv) {
        $student->parentNode->removeChild($student);

        saveStudents($xml);
        break;
      }
    }
  }
}
?>


<a class="btn btn-primary" href="./themsinhvien.php">Thêm Sinh Viên</a>
<div class="table-responsive-md">
  <table class="table table-hover">
    <tr>
      <th>MSSV</th>
      <th>Họ và Tên</th>
      <th>Lớp - Mã</th>
      <th>Địa chỉ</th>
      <th>Số điện thoại</th>
      <!--<th>Email</th>
      <th>Ngành học</th>-->
      <th>Giới tính</th>
      <th>Ngày sinh</th>
      <!--<th>Ảnh đại diện</th>-->
      <th>Sửa</th>
      <th>Xóa</th>
      <th>Chi tiết</th>
    </tr>
    <?php
    $xml = loadStudents();
    $students = $xml->getElementsByTagName('student');
    foreach ($students as $student) {
      $mssv = $student->getAttribute('mssv');
      $full_name = $student->getElementsByTagName('full_name')->item(0)->nodeValue;
      $class_code = $student->getElementsByTagName('class_code')->item(0)->nodeValue;
      $address = $student->getElementsByTagName('address')->item(0)->nodeValue;
      $phone = $student->getElementsByTagName('phone')->item(0)->nodeValue;
      $email = $student->getElementsByTagName('email')->item(0)->nodeValue;
      $major = $student->getElementsByTagName('major')->item(0)->nodeValue;
      $gender = $student->getElementsByTagName('gender')->item(0)->nodeValue;
      $dob = $student->getElementsByTagName('dob')->item(0)->nodeValue;
      $avatar = $student->getElementsByTagName('avatar')->item(0)->nodeValue;


      echo "<tr>";
      echo "<td>$mssv</td>";
      echo "<td>$full_name</td>";
      echo "<td>$class_code</td>";
      echo "<td>$address</td>";
      echo "<td>$phone</td>";
      //echo "<td>$email</td>";
      // echo "<td>$major</td>";
      echo "<td>$gender</td>";
      echo "<td>$dob</td>";
      // echo "<td><img src='img/" . $avatar . "' alt ='anh dai dien' class='img-fluid'></td>";
      echo "<td><a class = 'btn btn-success' href='suasinhvien.php?mssv=$mssv'>Sửa</a></td>";
      echo "<td><a class = 'btn btn-danger' href='xoasinhvien.php?mssv=$mssv'>Xóa</a></td>";
      echo "<td><a class = 'btn btn-primary' href='xemsv.php?mssv=$mssv'>Xem</a></td>";
      echo "</tr>";
    }
    ?>
  </table>
</div>

<?php
require_once("footer.php");
?>