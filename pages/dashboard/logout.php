<?php
// Bắt đầu phiên làm việc
session_start();

// Hủy phiên làm việc
session_unset();
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập hoặc trang chính của bạn sau khi đăng xuất
header("Location: login.php"); // Đổi "login.php" thành trang mà bạn muốn người dùng được chuyển hướng sau khi đăng xuất
exit();
?>
