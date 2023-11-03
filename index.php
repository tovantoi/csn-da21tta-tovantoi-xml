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
        $xml->load('timhieu.xml');
        return $xml;
    }

    // Function to save students to XML file
    function saveStudents($xml)
    {
        $xml->save('timhieu.xml');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['add_student'])) {
            $xml = loadStudents();
            $root = $xml->documentElement;
            $student = $xml->createElement('student');
            $id = $xml->createElement('id', $_POST['id']);
            $name = $xml->createElement('name', $_POST['name']);
            $email = $xml->createElement('email', $_POST['email']);
            $major = $xml->createElement('major', $_POST['major']);
            $student->appendChild($id);
            $student->appendChild($name);
            $student->appendChild($email);
            $student->appendChild($major);
            $root->appendChild($student);
            saveStudents($xml);
        } elseif (isset($_POST['suasinvien'])) {
            $xml = loadStudents();
            $id = $_POST['id'];
            $students = $xml->getElementsByTagName('student');
            foreach ($students as $student) {
                if ($student->getElementsByTagName('id')->item(0)->nodeValue == $id) {
                    $student->getElementsByTagName('name')->item(0)->nodeValue = $_POST['name'];
                    $student->getElementsByTagName('email')->item(0)->nodeValue = $_POST['email'];
                    $student->getElementsByTagName('major')->item(0)->nodeValue = $_POST['major'];
                    saveStudents($xml);
                    break;
                }
            }
        } elseif (isset($_POST['xoáinhvien'])) {
            $xml = loadStudents();
            $id = $_POST['id'];
            $students = $xml->getElementsByTagName('student');
            foreach ($students as $student) {
                if ($student->getElementsByTagName('id')->item(0)->nodeValue == $id) {
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
            <th>ID</th>
            <th>Tên</th>
            <th>Email</th>
            <th>Ngành học</th>
            <th>Thao tác</th>
        </tr>
        <?php
        $xml = loadStudents();
        $students = $xml->getElementsByTagName('student');
        foreach ($students as $student) {
            $id = $student->getElementsByTagName('id')->item(0)->nodeValue;
            $name = $student->getElementsByTagName('name')->item(0)->nodeValue;
            $email = $student->getElementsByTagName('email')->item(0)->nodeValue;
            $major = $student->getElementsByTagName('major')->item(0)->nodeValue;
            echo "<tr>";
            echo "<td>$id</td>";
            echo "<td>$name</td>";
            echo "<td>$email</td>";
            echo "<td>$major</td>";
            echo "<td><a href='suasinvien.php?id=$id'>Sửa</a> | <a href='xoáinhvien.php?id=$id'>Xóa</a></td>";
            echo "</tr>";
        }
        ?>
    </table>

    <h2>Thêm Sinh viên</h2>
    <form method="post" action="">
        <input type="text" name="id" placeholder="ID" required><br>
        <input type="text" name="name" placeholder="Tên" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="major" placeholder="Ngành học" required><br>
        <input type="submit" name="add_student" value="Thêm">
    </form>
</body>

</html>