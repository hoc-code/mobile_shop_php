<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $odate = date("Y-m-d H:i:s");
    $ototal = $_POST['sellPrice'];
    $ostatus = "chờ xác nhận";
    $mid = $_POST['mid'];
    $pid = $_POST['pid'];
    $quantity = $_POST['finalQuantity'];
    $sellPrice = $_POST['sellPrice'];
    $paymentmethod = $_POST['paymentmethod'];

    // Kiểm tra xem pid có tồn tại trong bảng product hay không
    $sql_check_pid = "SELECT pid FROM product WHERE pid = '$pid'";
    $result_check_pid = $conn->query($sql_check_pid);

    if ($result_check_pid->num_rows > 0) {
        $sql_orders = "INSERT INTO orders (odate, ototal, ostatus, mid, pid, quantity, paymentmethod) 
        VALUES ('$odate', '$ototal', '$ostatus', '$mid', '$pid', '$quantity', '$paymentmethod')";
        
        if ($conn->query($sql_orders) !== TRUE) {
            echo "Error: " . $sql_orders . "<br>" . $conn->error;
        } else {
            // Thêm thành công, xử lý tiếp hoặc điều hướng người dùng đến trang khác
            $conn->close();
            header("Location: ../pages/dashboard/history.php");
            exit();
        }
    } else {
        echo "Không tìm thấy pid trong bảng product.";
    }
}
?>
