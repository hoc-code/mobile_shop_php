<?php
session_start();
include('connect.php');

if (isset($_GET['code'])) {
    $productCode = $_GET['code'];
    $escapedProductCode = $conn->real_escape_string($productCode);

    $deleteQuery = "DELETE FROM cart WHERE code = '$escapedProductCode'";
    $deleteResult = $conn->query($deleteQuery);

    if ($deleteResult) {
        echo "<script>alert('Sản phẩm đã được xóa khỏi giỏ hàng.');</script>";
        header("Location: ../pages/dashboard/cart.php");
        exit();
    } else {
        echo "<script>alert('Không thể xóa sản phẩm khỏi giỏ hàng. Vui lòng thử lại sau.'); window.history.back();</script>";
        header("Location: ../pages/dashboard/cart.php");
        exit();
    }
} else {
    echo "Mã sản phẩm không được cung cấp";
}

$conn->close();
?>
