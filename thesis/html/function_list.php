<?php
function loadStudents()
{
    $xml = new DOMDocument();
    $xml = simplexml_load_file('data.xml');
    return $xml;
}

function saveStudents($xml)
{
    $xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;
    $xml->loadXML($xml->asXML());
    $xml->save('data.xml');
}

function loadClasse()
{
    $xml = simplexml_load_file('lop.xml');
    return $xml;
}
// Hàm để cập nhật thông tin sinh viên
function updateStudentInfo($xmlFilePath, $studentData)
{
    $xml = simplexml_load_file($xmlFilePath);

    foreach ($xml->student as $student) {
        if ((string)$student['mssv'] === $studentData['mssv']) {
            // Cập nhật thông tin sinh viên
            $student->full_name = $studentData['full_name'];
            $student->class_code = $studentData['class_code'];
            $student->address = $studentData['address'];
            $student->phone = $studentData['phone'];
            $student->email = $studentData['email'];
            $student->major = $studentData['major'];
            $student->gender = $studentData['gender'];
            $student->dob = $studentData['dob'];
            $student->avatar = $studentData['avatar'];
            $student->ethnicity = $studentData['ethnicity'];
            $student->religion = $studentData['religion'];

            $student->parents->father->attributes()->full_name = $studentData['father_full_name'];
            $student->parents->father->attributes()->occupation = $studentData['father_occupation'];
            $student->parents->father->attributes()->year_of_birth = $studentData['father_year_of_birth'];

            $student->parents->mother->attributes()->full_name = $studentData['mother_full_name'];
            $student->parents->mother->attributes()->occupation = $studentData['mother_occupation'];
            $student->parents->mother->attributes()->year_of_birth = $studentData['mother_year_of_birth'];

            break;
        }
    }

    $xml->asXML($xmlFilePath); // Lưu thay đổi vào file XML
}
