<?php
require_once("header.php");
?>
<style>
    /* CSS cho Modal */
    .modal {
        display: none;
        /* Mặc định ẩn Modal */
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
        /* Màu nền với độ trong suốt */
    }

    .modal:hover {
        background-color: rgba(0, 0, 0, 0.6);
        /* Đổi màu khi di chuột vào */
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }

    .btn {
        margin: 5px;
        padding: 8px 12px;
        border: none;
        cursor: pointer;
    }

    .confirm-btn {
        background-color: #4CAF50;
        color: white;
    }

    .cancel-btn {
        background-color: #f44336;
        color: white;
    }
</style>
</head>

<body>

    <!-- Modal xác nhận xóa -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <p>Bạn có chắc chắn muốn xóa ngành học này?</p>
            <button class="btn confirm-btn" id="confirmBtn">Xác nhận</button>
            <button class="btn cancel-btn" id="cancelBtn">Hủy</button>
        </div>
    </div>

    <script>
        // Hiển thị Modal khi người dùng nhấn để xóa
        function confirmDelete(classId) {
            var modal = document.getElementById("confirmationModal");
            modal.style.display = "block";


            var confirmBtn = document.getElementById("confirmBtn");
            confirmBtn.onclick = function() {
                window.location = "dsNganh.php?class_id=" + classId;
                modal.style.display = "none";
                alert("Đã xóa thành công");
            };

            var cancelBtn = document.getElementById("cancelBtn");
            cancelBtn.onclick = function() {
                window.location = "dsNganh.php?class_id=" + classId;
                modal.style.display = "none";
            };
        }
    </script>
    <?php
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

    function saveNganh($xml)
    {
        $xml->save('nganhhoc.xml');
    }

    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['class_id'])) {
        $nganh_to_delete = $_GET['class_id'];

        $xml = loadNganh();

        if ($xml) {
            $root = $xml->documentElement;
            $dsnganhhoc = $xml->getElementsByTagName('nganhhoc');

            foreach ($dsnganhhoc as $nganhhoc) {
                if ($nganhhoc->nodeValue == $nganh_to_delete) {
                    $root->removeChild($nganhhoc);
                    saveNganh($xml);
                    echo "<script>confirmDelete('$nganh_to_delete');</script>";
                    break;
                }
            }
        } else {
            echo "<p>Không thể tải dữ liệu ngành học.</p>";
        }
    } else {
        echo "<p>Không có ID ngành học được cung cấp để xóa.</p>";
    }
    ?>
    <?php
    require_once("footer.php");
    ?>