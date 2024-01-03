<?php
include 'connect.php';

if (isset($_GET['oid'])) {
    $oid = $_GET['oid'];

    // Update order status
    $updateQuery = "UPDATE orders SET ostatus = 'đã xác nhận' WHERE oid = $oid";

    $result = mysqli_query($conn, $updateQuery);

    if ($result) {
        // Decrease quantity in product table
        $pid = $_GET['pid']; // Get the product ID associated with the order

        // Query to update product quantity
        $decreaseQuantityQuery = "UPDATE product SET pquantity = pquantity - 1 WHERE pid = $pid";

        $quantityResult = mysqli_query($conn, $decreaseQuantityQuery);

        if ($quantityResult) {
            header("Location: ../pages/admin/admin_ql_order.php");
            exit();
        } else {
            echo "Có lỗi xảy ra khi cập nhật số lượng sản phẩm.";
        }
    } else {
        echo "Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.";
    }
} else {
    echo "Không tìm thấy đơn hàng để xác nhận.";
}

mysqli_close($conn);
?>
