
<?php
session_start();

// Kiểm tra nếu có thông báo lỗi đăng nhập
if(isset($_SESSION['error_message'])) {
    echo '<div class="error">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); // Xóa thông báo lỗi sau khi đã hiển thị
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="../../css/login.css">

    <title>Nhóm 13 Login - Signup</title>
</head>

<body>
    
    <div class="container" id="container">
        <div class="form-container sign-up">
        <form action="../../action/signup_action.php" method="POST">
            <h1>Tạo tài khoản</h1>
            <input type="text" name="username" placeholder="Username">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <button type="submit">Đăng Ký</button>
        </form>

        </div>
        <div class="form-container sign-in">
            <form action="../../action/login_action.php" method="POST">
                <h1>Đăng Nhập</h1>
                <input type="text" name="txtTenDangNhap" placeholder="Tên Đăng Nhập">
                <input type="password"  name="txtMatKhau"  placeholder="Mật Khẩu">
                <a href="#">Quên mật khẩu</a>
                <button type="submit">Đăng Nhập</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Chào mừng bạn</h1>
                    <p>Đến với nhớm 13</p>
                    <button class="hidden" id="login">Đăng Nhập</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Chào mừng bạn</h1>
                    <p>Hãy đăng ký để có thể tham gia shop của chúng tôi</p>
                    <button class="hidden" id="register">Đăng Ký</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="../../action/login.js "></script>

</html>