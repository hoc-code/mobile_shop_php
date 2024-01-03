<?php
session_start();
require_once("../pages/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Xử lý chuỗi để tránh tấn công SQL Injection
    $username = mysqli_real_escape_string($conn, $username);
    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    // Kiểm tra xem email có đúng định dạng của Gmail hay không
    if (!preg_match('/^[a-zA-Z0-9._%+-]+@gmail\.com$/', $email)) {
        $_SESSION["registration_error"] = "Email không đúng định dạng Gmail.";
        echo '<script type="text/javascript">
                alert("Email không đúng định dạng Gmail!");
                window.location.href = "../pages/dashboard/login.php";
              </script>';
        exit();
    }

    // Kiểm tra xem tên người dùng hoặc email đã tồn tại trong CSDL
    $check_query = "SELECT * FROM member WHERE username = '$username' OR memail = '$email'";
    $check_result = mysqli_query($conn, $check_query);

    if (!$check_result) {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION["registration_error"] = "username hoặc Email đã tồn tại.";
        echo '<script type="text/javascript">
                alert("Tên người dùng hoặc Email đã tồn tại!");
                window.location.href = "../pages/dashboard/login.php";
              </script>';
        exit();
    } else {
        $insert_query = "INSERT INTO member (username, memail, password) VALUES ('$username', '$email', '$password')";
        $insert_result = mysqli_query($conn, $insert_query);

        if (!$insert_result) {
            die("Lỗi truy vấn: " . mysqli_error($conn));
        }

        echo '<script type="text/javascript">
                alert("Đăng ký thành công!");
                window.location.href = "../pages/dashboard/login.php";
              </script>';
        exit();
    }
}
?>
