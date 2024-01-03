<?php
session_start();
require_once("../pages/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["txtTenDangNhap"];
    $password = $_POST["txtMatKhau"];

    // Xử lý chuỗi để tránh tấn công SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Query kiểm tra thông tin đăng nhập trong bảng admin
    $admin_login_query = "SELECT * FROM admin WHERE Username = '$username' AND password = '$password'";
    $admin_login_result = mysqli_query($conn, $admin_login_query);

    // Query kiểm tra thông tin đăng nhập trong bảng member
    $member_login_query = "SELECT * FROM member WHERE Username = '$username' AND password = '$password'";
    $member_login_result = mysqli_query($conn, $member_login_query);

    if (!$admin_login_result || !$member_login_result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    // Kiểm tra thông tin đăng nhập có khớp với bảng admin
    if (mysqli_num_rows($admin_login_result) == 1) {
        // Đăng nhập thành công vào bảng admin
        $_SESSION["login"] = true;
        $_SESSION["TenDangNhap1"] = $username; // Lưu tên đăng nhập, có thể sửa đổi theo cột thích hợp

        header("Location: ../pages/admin/admin_ql_member.php");
        exit();
    }
    // Kiểm tra thông tin đăng nhập có khớp với bảng member
    elseif (mysqli_num_rows($member_login_result) == 1) {
        // Đăng nhập thành công vào bảng member
        $_SESSION["login"] = true;
        $_SESSION["TenDangNhap1"] = $username; // Lưu tên đăng nhập, có thể sửa đổi theo cột thích hợp
        header("Location: ../pages/dashboard/home.php");
        exit();
    } else {
        // Đăng nhập thất bại, đặt thông báo lỗi và quay lại trang đăng nhập với thông báo cảnh báo
        $_SESSION["error_message"] = "Thông tin đăng nhập không đúng";
        echo '<script type="text/javascript">
                alert("Thông tin đăng nhập không đúng. Vui lòng kiểm tra lại!");
                window.location.href = "../pages/dashboard/login.php";
              </script>';
        exit();
    }
} else {
    // Nếu không phải là phương thức POST (truy cập trang trực tiếp), quay lại trang đăng nhập
    header("Location: login.php");
    exit();
}
?>
