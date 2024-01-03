<?php
session_start();

if (isset($_SESSION['login']) && isset($_SESSION['TenDangNhap1'])) {
    // Kiểm tra xem người dùng đã đăng nhập với vai trò admin chưa
    if ($_SESSION['login'] === true) {
        // Đã đăng nhập với vai trò admin, cho phép truy cập vào trang admin
        $username = $_SESSION['TenDangNhap1'];
        // Hiển thị nội dung của trang admin ở đây
    } else {
        // Không có quyền truy cập, chuyển hướng về trang đăng nhập
        header("Location: ../../pages/dashboard/login.php");
        exit();
    }
} else {
    // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
    header("Location: ../../pages/dashboard/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin_side_bar.css">
    <link rel="stylesheet" href="admin_ql_orders.css">
    <title>Orders</title>
</head>
<body>
<nav class="nav1">
            <!-- <a href="admin.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a> -->
            <a href="admin_ql_member.php"><i class="fa fa-user" aria-hidden="true"></i>Khách hàng</a>
            <a href="admin_ql_sanpham.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Sản phẩm</a>
            <a href="admin_ql_order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đơn đặt</a>
            <a href="admin_ql_doanhthu.php"><i class="fa fa-line-chart" aria-hidden="true"></i>Doanh thu</a>
            <a href="admin_ql_thongke.php"><i class="fa-solid fa-chart-simple"></i>Thống Kê</a>
            <a href="../../pages/dashboard/logout.php"><i class="fa-solid fa-right-from-bracket"></i>Đăng xuất</a>
    </nav>
    <div class="content">
    <h1 align=center style="color: #fff;
    background-color: #fa3131;
    padding: 10px;
    border-radius: 10px 10px 0 0;">Đơn Hàng</h1>
    <div class="real_orders">
    <h2>Các đơn hàng đã đặt</h2>
    <?php
        include '../connect.php';
        $sql = "SELECT orders.quantity, orders.oid, orders.odate, orders.ototal, orders.ostatus, 
        product.pname, product.pimage, product.pid, member.mname
        FROM orders
        JOIN product ON orders.pid = product.pid
        JOIN member ON orders.mid = member.mid
        WHERE (orders.ostatus = 'chờ xác nhận')";


        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $total = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $oid = $row["oid"];
                $odate = $row["odate"];
                $ototal = $row["ototal"];
                $ostatus = $row["ostatus"];
                $productName = $row["pname"];
                $productImage = $row["pimage"];
                $quantity = $row['quantity'];
                $username = $row['mname'];
                $pid = $row['pid'];
                // Display product details
                
            ?>
                <div class='real_order'>
                <img src='../assets/images1/<?php echo $productImage; ?>' alt='Product: <?php echo $productName; ?>'>
                    <div class='real_order_info'>
                        <div class='real_order_name'>ID Đơn hàng: <?php echo $oid; ?></div>
                        <div class='real_order_date'>Ngày đặt hàng: <?php echo $odate; ?></div>
                        <div class='real_order_product_name'>Tên sản phẩm: <?php echo $productName; ?></div>
                        <div class='real_order_product_name'>Tên người mua: <?php echo $username; ?></div>
                        <div class='real_order_product_quantity'>Số lượng: <?php echo $quantity; ?></div>
                        <div class='real_order_total_money'>Tổng tiền: <?php echo number_format($ototal, 0, ',', '.') ?> đ</div>
                        <div class='real_order_status'>Trạng thái: <span class="status" data-status="<?php echo $ostatus; ?>"><?php echo $ostatus; ?></span></div>
                        <div class='real_order_button'>
                            <a href='../../action/confirm_order_action.php?oid=<?php echo $oid; ?>&pid=<?php echo $pid; ?>' class='confirm_button' style="background-color:#22e508">Xác nhận</a>
                            <a href='../../action/cancel_order_action.php?oid=<?php echo $oid; ?>' class='cancel_button'>Hủy</a>
                            
                        </div>
                    </div>
                </div>
                
                <?php
                // Sum up total amount for all orders
                $total += $ototal;
            }
            // Display the total amount for all orders
            // echo "<div class='real_order_total'><p>Tổng tiền của tất cả đơn hàng: " . number_format($total, 0, ',', '.') . " đ</p></div>";
        } else {
            // Display a message if there are no orders
            echo "Không có đơn hàng nào";
        }

        mysqli_close($conn);
        ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var statusElements = document.querySelectorAll('.status');

                statusElements.forEach(function(statusElement) {
                    var ostatus = statusElement.dataset.status;

                    if (ostatus === "chờ xác nhận") {
                        statusElement.style.color = "yellow";
                    } else if (ostatus === "đã xác nhận") {
                        statusElement.style.color = "green";
                    }
                });
            });
        </script>
        
    </div>  

    <div class="confirmed_orders">
        <h2>Các đơn hàng đã xác nhận</h2>
        <?php
        include '../connect.php';

        $confirmedOrdersQuery  = "SELECT orders.quantity, orders.oid, orders.odate, orders.ototal, orders.ostatus, product.pname, product.pimage, member.mname
        FROM orders
        JOIN product ON orders.pid = product.pid
        JOIN member ON orders.mid = member.mid
                        WHERE orders.ostatus = 'đã xác nhận' ";


        $confirmedOrdersResult = mysqli_query($conn, $confirmedOrdersQuery);

        if ($confirmedOrdersResult && mysqli_num_rows($confirmedOrdersResult) > 0) {
            while ($row = mysqli_fetch_assoc($confirmedOrdersResult)) {
                $oid = $row["oid"];
                $odate = $row["odate"];
                $ototal = $row["ototal"];
                $ostatus = $row["ostatus"];
                $productName = $row["pname"];
                $productImage = $row["pimage"];
                $quantity = $row['quantity'];
                $username = $row['mname'];
                // Display confirmed order details
                ?>
                <div class='confirmed_order'>
                    <img src='../assets/images1/<?php echo $productImage; ?>' alt='Product: <?php echo $productName; ?>'>
                    <div class='confirmed_order_info'>
                        <div class='confirmed_order_name'>ID Đơn hàng: <?php echo $oid; ?></div>
                        <div class='confirmed_order_date'>Ngày đặt hàng: <?php echo $odate; ?></div>
                        <div class='confirmed_order_product_name'>Tên sản phẩm: <?php echo $productName; ?></div>
                        <div class='real_order_product_name'>Tên người mua: <?php echo $username; ?></div>

                        <div class='confirmed_order_product_quantity'>Số lượng: <?php echo $quantity; ?></div>
                        <div class='confirmed_order_total_money'>Tổng tiền: <?php echo number_format($ototal, 0, ',', '.') ?> đ</div>
                        <div class='confirmed_order_status'>Trạng thái: <?php echo $ostatus; ?></div>
                    </div>
                </div>
        <?php
            }
        } else {
            // Display a message if there are no confirmed orders
            echo "Không có đơn hàng đã xác nhận";
        }

        mysqli_close($conn);
        ?>
    </div>


    <div class="cancel_orders">
    <h2>Các đơn hàng đã hủy</h2>
        <?php
        include '../connect.php';

        $canceledOrdersQuery = "SELECT orders.quantity, orders.oid, orders.odate, orders.ototal, orders.ostatus, product.pname, product.pimage, member.mname
        FROM orders
        JOIN product ON orders.pid = product.pid
        JOIN member ON orders.mid = member.mid
                                where orders.ostatus = 'đã hủy'";

        $canceledOrdersResult = mysqli_query($conn, $canceledOrdersQuery);

        if ($canceledOrdersResult && mysqli_num_rows($canceledOrdersResult) > 0) {
            while ($row = mysqli_fetch_assoc($canceledOrdersResult)) {
                $oid = $row["oid"];
                $odate = $row["odate"];
                $ototal = $row["ototal"];
                $ostatus = $row["ostatus"];
                $productName = $row["pname"];
                $productImage = $row["pimage"];
                $quantity = $row['quantity'];
                $username = $row['mname'];
                // Display canceled order details
                ?>
                <div class='cancel_order'>
                <img src='../assets/images1/<?php echo $productImage; ?>' alt='Product: <?php echo $productName; ?>'>
                    <div class='cancel_order_info'>
                        <div class='cancel_order_name'>ID Đơn hàng: <?php echo $oid; ?></div>
                        <div class='cancel_order_date'>Ngày đặt hàng: <?php echo $odate; ?></div>
                            <div class='cancel_order_product_name'>Tên sản phẩm: <?php echo $productName; ?></div>
                            <div class='real_order_product_name'>Tên người mua: <?php echo $username; ?></div>

                            <div class='cancel_order_product_quantity'>Số lượng: <?php echo $quantity; ?></div>
                            <div class='cancel_order_total_money'>Tổng tiền: <?php echo number_format($ototal, 0, ',', '.') ?> đ</div>
                            <div class='cancel_order_status'>Trạng thái: <?php echo $ostatus; ?></div>
                    </div>
                </div>
                <?php
            }
        } else {
            // Display a message if there are no canceled orders
            echo "Không có đơn hàng đã hủy";
        }

        mysqli_close($conn);
        ?>
</div>

    </div>
</body>
</html>