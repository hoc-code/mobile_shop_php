<?php
// Gọi tệp connect.php để thiết lập kết nối
require_once 'connect.php';

// Tiếp tục với xử lý comment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu comment từ form
    // Xác định pname và mid từ dữ liệu POST
$pname = $_POST['pname']; // Giá trị pname từ form
$mid = $_POST['mid']; // Giá trị mid từ form

// Truy vấn để lấy pid từ pname
$sql_pid = "SELECT pid FROM product WHERE pname = '$pname'";
$result = $conn->query($sql_pid);

if ($result->num_rows > 0) {
    // Lấy pid từ kết quả truy vấn
    $row = $result->fetch_assoc();
    $pid = $row['pid'];

    // Tiếp tục với xử lý comment
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Lấy dữ liệu comment từ form
        $comment = $_POST['comment']; // Dữ liệu comment từ form

        // Kiểm tra xem mid có tồn tại trong bảng member hay không
        $check_mid_query = "SELECT mid FROM member WHERE mid = '$mid'";
        $check_mid_result = $conn->query($check_mid_query);

        if ($check_mid_result->num_rows > 0) {
            // Nếu mid hợp lệ, thực hiện truy vấn INSERT vào bảng comment
            $sql_insert_comment = "INSERT INTO comment (mid, pid, content, comdate, comstatus) VALUES ('$mid', '$pid', '$comment', NOW(), 1)";
            
            if ($conn->query($sql_insert_comment) === TRUE) {
                echo "Comment đã được thêm thành công!";
                // Trả lại trang product_detail.php với các tham số pname và mid
                $pname = $_POST['pname'];
                $mid = $_POST['mid'];
                header("Location: ../pages/detail/product_detail.php?pname=$pname&mid=$mid");
                exit(); // Đảm bảo không có mã HTML hoặc câu lệnh nào chạy sau header
            } else {
                echo "Lỗi khi thêm comment: " . $conn->error;
            }
        } else {
            echo "Giá trị mid không hợp lệ!";
        }
    }
} else {
    echo "Không tìm thấy sản phẩm.";
}

}

// Đóng kết nối
$conn->close();
?>
