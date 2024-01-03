<?php
session_start(); // Bắt đầu sử dụng Session

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
    include 'connect.php';

    $userId = $_POST['user_id'];
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $email = $_POST['email'];

    // Kiểm tra số điện thoại có chứa chính xác 10 chữ số
    if (preg_match('/^\d{10}$/', $phone) && preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $email)) {
        $sql = "UPDATE member SET username='$username', mname='$fullname', mphone='$phone', madd='$address', memail='$email' WHERE mid=$userId";

        if (mysqli_query($conn, $sql)) {
            // Cập nhật thành công, lưu thông tin vào Session và chuyển hướng về trang thành viên
            $_SESSION['username'] = $username;
            $_SESSION['fullname'] = $fullname;
            $_SESSION['phone'] = $phone;
            $_SESSION['address'] = $address;
            $_SESSION['email'] = $email;

            mysqli_close($conn);
            echo '<script>alert("Cập nhật thành công!"); window.location.href="../pages/member/member.php";</script>';
            exit();
        } else {
            echo '<script>alert("Lỗi khi cập nhật thông tin: ' . mysqli_error($conn) . '");window.location.href="../pages/member/member.php";</script>';
        }
    } else {
        echo '<script>alert("Số điện thoại không hợp lệ hoặc email không đúng định dạng Gmail!");window.location.href="../pages/member/member.php";</script>';
    }
}
?>
