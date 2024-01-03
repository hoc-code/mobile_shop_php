<?php
session_start();
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['comid'])) {
        $comid = $_GET['comid'];
        $receivedPname = $_GET['pname'];

        // Thực hiện cập nhật trạng thái comstatus từ 1 thành 0 để xóa mềm comment
        $updateQuery = "UPDATE comment SET comstatus = 0 WHERE comid = $comid";
        if ($conn->query($updateQuery) === TRUE) {
            echo "Comment đã được xóa thành công.";
            // Redirect đến product_detail.php với tham số pname như trước
            $pname = ''; // Thay thế bằng giá trị pname tương ứnga
            header('Location: ../pages/detail/product_detail.php?pname=' . $receivedPname);
            exit();
        } else {
            echo "Lỗi khi xóa comment: " . $conn->error;
        }
    } else {
        echo "Thiếu thông tin để xóa comment.";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
?>
