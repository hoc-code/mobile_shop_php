<?php
include 'connect.php';

if(isset($_GET['oid'])) {
    $orderId = $_GET['oid'];

    // Update the order status to 'đã hủy'
    $updateSql = "UPDATE orders SET ostatus = 'đã hủy' WHERE oid = $orderId";
    
    if (mysqli_query($conn, $updateSql)) {
        mysqli_close($conn);
        echo '<script>alert("Đơn hàng đã được hủy thành công.");</script>';
        header('Location: ../pages/dashboard/history.php');
        exit; // Stop further execution
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Không có thông tin đơn hàng để hủy.";
}
?>
