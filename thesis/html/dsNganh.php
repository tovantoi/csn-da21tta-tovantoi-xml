<?php
require_once("header.php");

// Function to load nganhhoc from XML file
function loadNganh()
{
    $xml = new DOMDocument();
    if (file_exists('nganhhoc.xml')) {
        $xml->load('nganhhoc.xml');
        return $xml;
    } else {
        return null;
    }
}

// Function to save nganhhoc to XML file
function saveNganh($xml)
{
    $xml->save('nganhhoc.xml');
}
?>
<a class="btn btn-primary" href="./addNganh.php">Thêm Ngành</a><br>
<div class="table-responsive-md">
    <table class="table table-hover">
        <tr>
            <th>Ngành học</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>

        <?php
        $xml = loadNganh();

        if ($xml) {
            $dsnganhhoc = $xml->getElementsByTagName('nganhhoc');

            foreach ($dsnganhhoc as $nganhhoc) {
                $nganh = $nganhhoc->nodeValue;

                echo "<tr>";
                echo "<td>$nganh</td>";
                echo "<td><a class='btn btn-success' href='suaNganh.php?class_id=$nganh'>Sửa</a></td>";
                echo "<td><a class='btn btn-danger' href='xoaNganh.php?class_id=$nganh'>Xóa</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>Không có ngành học nào.</td></tr>";
        }
        ?>
    </table>
</div>

<?php
require_once("footer.php");
?>