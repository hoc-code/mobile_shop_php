<?php
session_start();
include 'connect.php';

if (isset($_GET['pname'])) {
    $receivedPname = $_GET['pname'];
    $escapedPname = $conn->real_escape_string($receivedPname);

    // Kiểm tra người dùng đã đăng nhập hay chưa
    if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
        $username = $_SESSION['TenDangNhap1'];

        // Lấy mid của người dùng đăng nhập
        $query = "SELECT mid FROM member WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $userID = $row['mid'];

            // Lấy mã sản phẩm tiếp theo cho giỏ hàng
            $maxCodeQuery = "SELECT MAX(code) AS maxCode FROM cart";
            $maxCodeResult = $conn->query($maxCodeQuery);

            if ($maxCodeResult && $maxCodeResult->num_rows > 0) {
                $row = $maxCodeResult->fetch_assoc();
                $currentMaxCode = intval($row['maxCode']);
                $newCode = $currentMaxCode + 1;

                // Lấy thông tin sản phẩm từ cơ sở dữ liệu
                $productInfoQuery = "SELECT p.pprice, IFNULL(se.discount_percentage, 0) AS discount_percentage, p.pimage 
                                     FROM product p
                                     LEFT JOIN sale s ON p.pid = s.pid
                                     LEFT JOIN season se ON s.seasonid = se.seasonid
                                     WHERE p.pname = ?";
                $productInfoStmt = $conn->prepare($productInfoQuery);
                $productInfoStmt->bind_param("s", $escapedPname);
                $productInfoStmt->execute();
                $productInfoResult = $productInfoStmt->get_result();

                if ($productInfoResult->num_rows > 0) {
                    $row = $productInfoResult->fetch_assoc();
                    $productName = $escapedPname;
                    $productPrice = $row['pprice'];
                    $discountPercentage = $row['discount_percentage'];
                    $productImage = $row['pimage'];

                    $productNewPrice = ($discountPercentage > 0) ? $productPrice * (1 - ($discountPercentage / 100)) : $productPrice;
                    $productOldPrice = $productPrice;

                    // Thêm sản phẩm vào giỏ hàng
                    $insertQuery = "INSERT INTO cart (code, pname, pnewprice, poldprice, pimage, mid) 
                                    VALUES (?, ?, ?, ?, ?, ?)";
                    $insertStmt = $conn->prepare($insertQuery);
                    $insertStmt->bind_param("isddsi", $newCode, $productName, $productNewPrice, $productOldPrice, $productImage, $userID);
                    $insertStmt->execute();

                    if ($insertStmt->affected_rows > 0) {
                        // Thêm sản phẩm thành công
                        header("Location: ../pages/dashboard/cart.php");
                        exit();
                    } else {
                        // Xử lý khi thêm sản phẩm không thành công
                        $_SESSION["error_message"] = "Không thể thêm sản phẩm vào giỏ hàng. Vui lòng thử lại sau.";
                        header("Location: ../pages/dashboard/cart.php");
                        exit();
                    }
                } else {
                    $_SESSION["error_message"] = "Không có thông tin sản phẩm";
                    header("Location: ../pages/dashboard/cart.php");
                    exit();
                }
            } else {
                $_SESSION["error_message"] = "Không thể lấy mã sản phẩm. Vui lòng thử lại sau.";
                header("Location: ../pages/dashboard/cart.php");
                exit();
            }
        } else {
            $_SESSION["error_message"] = "Không tìm thấy người dùng.";
            header("Location: ../dashboard/login.php");
            exit();
        }
    } else {
        $_SESSION["error_message"] = "Thông tin đăng nhập bị sai. Vui lòng kiểm tra lại!";
        header("Location: ../dashboard/login.php");
        exit();
    }
} else {
    $_SESSION["error_message"] = "Product name not provided";
    header("Location: ../pages/dashboard/cart.php");
    exit();
}

?>
