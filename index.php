<!DOCTYPE html>
<html>

<head>
  <title>Quản lý Sinh viên</title>
</head>

<body>
  <h1>Quản lý Sinh viên</h1>

  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }

    h1 {
      background-color: #337ab7;
      color: white;
      padding: 10px;
    }

    h2 {
      color: #337ab7;
    }

    table {
      width: 100%;
      border-collapse: collapse;
    }

    table,
    th,
    td {
      border: 1px solid #ccc;
    }

    th,
    td {
      padding: 10px;
      text-align: left;
    }

    th {
      background-color: #337ab7;
      color: white;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    form {
      margin: 10px;
    }

    input[type="text"],
    input[type="email"] {
      width: 100%;
      padding: 5px;
      margin: 5px 0;
    }

    input[type="submit"] {
      background-color: #337ab7;
      color: white;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #235273;
    }
  </style>

  <?php
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

  function loadClasses()
  {
    $xml = simplexml_load_file('malop.xml');
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

  <h2>Danh Sách Sinh viên</h2>
  <table border="1">
    <tr>
      <th>MSSV</th>
      <th>Họ và Tên</th>
      <th>Lớp</th>
      <th>Địa chỉ</th>
      <th>Số điện thoại</th>
      <th>Email</th>
      <th>Ngành học</th>
      <th>Giới tính</th>
      <th>Ngày sinh</th>
      <th>Ảnh đại diện</th>
      <th>Dân tộc</th>
      <th>Tôn giáo</th>
      <th>Họ và tên bố</th>
      <th>Nghề nghiệp bố</th>
      <th>Năm sinh bố</th>
      <th>Họ và tên mẹ</th>
      <th>Nghề nghiệp mẹ</th>
      <th>Năm sinh mẹ</th>
      <th>Thao tác</th>
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
      $ethnicity = $student->getElementsByTagName('ethnicity')->item(0)->nodeValue;
      $religion = $student->getElementsByTagName('religion')->item(0)->nodeValue;

      $fatherFullName = $student->getElementsByTagName('father')->item(0)->getAttribute('full_name');
      $fatherOccupation = $student->getElementsByTagName('father')->item(0)->getAttribute('occupation');
      $fatherYearOfBirth = $student->getElementsByTagName('father')->item(0)->getAttribute('year_of_birth');

      $motherFullName = $student->getElementsByTagName('mother')->item(0)->getAttribute('full_name');
      $motherOccupation = $student->getElementsByTagName('mother')->item(0)->getAttribute('occupation');
      $motherYearOfBirth = $student->getElementsByTagName('mother')->item(0)->getAttribute('year_of_birth');

      echo "<tr>";
      echo "<td>$mssv</td>";
      echo "<td>$full_name</td>";
      echo "<td>$class_code</td>";
      echo "<td>$address</td>";
      echo "<td>$phone</td>";
      echo "<td>$email</td>";
      echo "<td>$major</td>";
      echo "<td>$gender</td>";
      echo "<td>$dob</td>";
      echo "<td>$avatar</td>";
      echo "<td>$ethnicity</td>";
      echo "<td>$religion</td>";
      echo "<td>$fatherFullName</td>";
      echo "<td>$fatherOccupation</td>";
      echo "<td>$fatherYearOfBirth</td>";
      echo "<td>$motherFullName</td>";
      echo "<td>$motherOccupation</td>";
      echo "<td>$motherYearOfBirth</td>";
      echo "<td><a href='suasinhvien.php?mssv=$mssv'>Sửa</a> | <a href='xoasinhvien.php?mssv=$mssv'>Xóa</a></td>";
      echo "</tr>";
    }
    ?>
  </table>

  <h2>Thêm Sinh viên</h2>
  <form method="post" action="">
    <input type="text" name="mssv" placeholder="MSSV" required><br>
    <input type="text" name="full_name" placeholder="Họ và Tên" required><br>
    <label for="class_code">Chọn Lớp:</label>
    <select name="class_code" required>
      <?php
      // Load class information from malop.xml
      $xmlClass = loadClasses();

      // Loop through each <class> element in 'malop.xml'
      foreach ($xmlClass->class as $class) {
        $class_id = $class->class_id;
        $class_name = $class->name;

        // Display option for user selection
        echo "<option value='$class_id'>$class_name</option>";
      }
      ?>
    </select>
    <input type="text" name="address" placeholder="Địa chỉ" required><br>
    <input type="text" name="phone" placeholder="Số điện thoại" required><br>
    <input type="email" name="email" placeholder="Email" required><br>
    <input type="text" name="major" placeholder="Ngành học" required><br>
    <input type="text" name="gender" placeholder="Giới tính" required><br>
    <input type="date" name="dob" placeholder="Ngày sinh" required><br>
    <input type="file" name="avatar" placeholder="Ảnh đại diện" required><br>
    <input type="text" name="ethnicity" placeholder="Dân tộc" required><br>
    <input type="text" name="religion" placeholder="Tôn giáo" required><br>

    <h3>Thông tin Phụ huynh</h3>
    <label for="father_full_name">Họ và tên bố:</label>
    <input type="text" name="father_full_name" required><br>
    <label for="father_occupation">Nghề nghiệp bố:</label>
    <input type="text" name="father_occupation" required><br>
    <label for="father_year_of_birth">Năm sinh bố:</label>
    <input type="text" name="father_year_of_birth" required><br>

    <label for="mother_full_name">Họ và tên mẹ:</label>
    <input type="text" name="mother_full_name" required><br>
    <label for="mother_occupation">Nghề nghiệp mẹ:</label>
    <input type="text" name="mother_occupation" required><br>
    <label for="mother_year_of_birth">Năm sinh mẹ:</label>
    <input type="text" name="mother_year_of_birth" required><br>

    <input type="submit" name="add_student" value="Thêm">
  </form>
</body>

</html>