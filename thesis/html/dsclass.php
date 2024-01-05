<?php
require_once("header.php");
?>

<?php
// Function to load students from XML file
function loadClass()
{
    $xml = new DOMDocument();
    $xml->load('lop.xml');
    return $xml;
}

// Function to save students to XML file
function saveClass($xml)
{
    $xml->save('lop.xml');
}
?>
<div class="table-responsive-md">
    <table class="table table-hover">
        <tr>
            <th>Mã Lớp</th>
            <th>Tên lớp</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>

        <a class="btn btn-primary" href="./addclasses.php">Thêm Lớp</a><br>
        <?php
        $xml = loadClass();
        $classes = $xml->getElementsByTagName('class');
        foreach ($classes as $class) {
            $class_id = $class->getElementsByTagName('class_id')->item(0)->nodeValue;
            $name = $class->getElementsByTagName('name')->item(0)->nodeValue;

            echo "<tr>";
            echo "<td>$class_id</td>";
            echo "<td>$name</td>";
            echo "<td><a class = 'btn btn-success' href='suamalop.php?class_id=$class_id'>Sửa</a></td>";
            echo "<td><a class = 'btn btn-danger' href='xoalop.php?class_id=$class_id'>Xóa</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
</div>



<?php
require_once("footer.php");
?>