<?php
session_start();

// Kiểm tra phiên làm việc đã được khởi tạo chưa và xác thực quyền truy cập
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

include '../connect.php';

// Truy vấn lấy thông tin Top 5 sản phẩm bán nhiều nhất
$query_top_sold_products = "SELECT p.pid, p.pname, p.pimage, SUM(o.quantity) AS total_sold
                            FROM orders o
                            INNER JOIN product p ON o.pid = p.pid
                            WHERE o.ostatus = 'đã xác nhận'
                            GROUP BY p.pid
                            ORDER BY total_sold DESC
                            LIMIT 5";

$result_top_sold_products = mysqli_query($conn, $query_top_sold_products);

// Truy vấn lấy thông tin về sản phẩm đạt doanh thu cao nhất
$query_top_revenue_product = "SELECT p.pid, p.pname, p.pimage, SUM(o.ototal) AS total_revenue
                              FROM orders o
                              INNER JOIN product p ON o.pid = p.pid
                              WHERE o.ostatus = 'đã xác nhận'
                              GROUP BY p.pid
                              ORDER BY total_revenue DESC
                              LIMIT 5";

$result_top_revenue_product = mysqli_query($conn, $query_top_revenue_product);

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
    <link rel="stylesheet" href="admin_ql_member.css">
    <title>Thống Kê</title>
    <style>
        div table tr td{
            height:20px;
            width:70px;
            text-align: center;
        }
        div table tr td img{
            object-fit: contain;
        }
        .title_day_month_year_right{
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            margin: 20px 0 10px 0;
        }
        .title_day_month_year_right input{
            width: 100px;
            border-radius: 10px;
        }

        .title_day_month_year_right select{
            width: 100px;
            height: 32px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <nav class="nav1">
            <!-- <a href="admin.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a> -->
            <a href="admin_ql_member.php"><i class="fa fa-user" aria-hidden="true"></i>Khách hàng</a>
            <a href="admin_ql_sanpham.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Sản phẩm</a>
            <a href="admin_ql_order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đơn đặt</a>
            <a href="admin_ql_doanhthu.php"><i class="fa fa-line-chart" aria-hidden="true"></i>Doanh thu</a>
            <a href="admin_ql_thongke.php"><i class="fa-solid fa-chart-simple"></i>Thống Kê</a>
            <a href="../../pages/dashboard/logout.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đăng xuất</a>
    </nav>

    <div class="main">
        <div class="best_seller">
            <h1 align="center" style="color: #fff;
            background-color: #fa3131;
            padding: 10px;
            border-radius: 10px 10px 0 0;">Thông tin sản phẩm</h1>

            <h2>Top 5 sản phẩm bán nhiều nhất:</h2>
            <table border="1">
                <tr>
                    <th>ID Sản phẩm</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Tổng số lượng bán</th>
                </tr>
                <?php
                if ($result_top_sold_products && mysqli_num_rows($result_top_sold_products) > 0) {
                    while ($row = mysqli_fetch_assoc($result_top_sold_products)) {
                        echo "<tr>";
                        echo "<td>" . $row['pid'] . "</td>";
                        echo "<td>" . $row['pname'] . "</td>";
                        echo "<td><img src=\"../assets/images1/{$row['pimage']}\" alt=\"điện thoại {$row['pname']}\" style=\"width: 100px; height: 100px;\"></td>";
                        echo "<td>" . $row['total_sold'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Không có dữ liệu sản phẩm bán nhiều nhất.</td></tr>";
                }
                ?>
            </table>
        </div>
        <div class="most_price">
            <h2>Sản phẩm đạt doanh thu cao nhất:</h2>
            <?php
                if ($result_top_revenue_product && mysqli_num_rows($result_top_revenue_product) > 0) {
                    ?>
                    <table border="1">
                        <thead>
                            <tr>
                                
                                <th>ID sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Hình ảnh</th>
                                <th>Tổng doanh thu</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $row_top_revenue_product = mysqli_fetch_assoc($result_top_revenue_product);
                        $product_id = $row_top_revenue_product['pid'];
                        $product_name = $row_top_revenue_product['pname'];
                        $product_image = $row_top_revenue_product['pimage'];
                        $total_revenue = $row_top_revenue_product['total_revenue'];

                        echo "<tr>";
                        echo "<td>$product_id</td>";
                        echo "<td>$product_name</td>";
                        echo "<td><img src=\"../assets/images1/{$product_image}\" alt=\"điện thoại {$product_name}\" style=\"width: 100px; height: 100px;\"></td>";
                        echo "<td>$total_revenue</td>";
                        echo "</tr>";
                        ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo "<p>Không có dữ liệu sản phẩm đạt doanh thu cao nhất.</p>";
                }
                ?>
        </div>
        <div class="hot_care">
        <?php
            include '../connect.php';

            $sql = "SELECT p.pname, p.pimage, COUNT(c.comid) AS total_comments
                    FROM product p
                    LEFT JOIN comment c ON p.pid = c.pid
                    GROUP BY p.pname, p.pimage
                    ORDER BY total_comments DESC
                    LIMIT 5";

            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                ?>
                <h2>Top 5 sản phẩm được quan tâm nhiều nhất:</h2>
                <table border="1">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Hình ảnh</th>
                            <th>Tổng số lượng bình luận</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['pname']}</td>";
                        echo "<td><img src=\"../assets/images1/{$row['pimage']}\" alt=\"điện thoại {$row['pname']}\" style=\"width: 100px; height: 100px;\"></td>";
                        echo "<td>{$row['total_comments']}</td>";
                        echo "</tr>";
                    }
                    ?>
                    </tbody>
                </table>
                <?php
            } else {
                echo "<p>Không có dữ liệu sản phẩm hoặc bình luận.</p>";
            }

            mysqli_close($conn);
            ?>


        </div>
        <div class="top_cate_sell">
            <?php
                include '../connect.php';

                $sql = "SELECT c.cname, 
               SUM(o.ototal) AS total_revenue, 
               SUM(o.quantity) AS total_quantity
                FROM orders o
                INNER JOIN product p ON o.pid = p.pid
                INNER JOIN categories c ON p.cid = c.cid
                WHERE o.ostatus = 'đã xác nhận'
                GROUP BY c.cname
                ORDER BY total_revenue DESC
                LIMIT 5";

                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    ?>
                    <h2>Top 5 loại điện thoại bán được doanh thu cao nhất:</h2>
                    <table border="1">
                        <thead>
                            <tr>
                                <th>Tên loại điện thoại</th>
                                <th>Tổng doanh thu</th>
                                <th>Tổng số lượng bán</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['cname']}</td>";
                            echo "<td>{$row['total_revenue']}</td>";
                            echo "<td>{$row['total_quantity']}</td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                } else {
                    echo "<p>Không có dữ liệu.</p>";
                }

                mysqli_close($conn);
            ?>
        </div>
        <div class="day_month_year">
        
        <div class="title_day_month_year">
        <form class="title_day_month_year_right" method="POST">
            <label for="selectedOption"></label>
            <select id="selectedOption" name="selectedOption">
                <option value="daily" <?php if (isset($selectedOption) && $selectedOption === 'daily') echo 'selected'; ?>>Theo ngày</option>
                <option value="monthly" <?php if (isset($selectedOption) && $selectedOption === 'monthly'); ?>>Theo tháng</option>
                <option value="yearly" <?php if (isset($selectedOption) && $selectedOption === 'yearly'); ?>>Theo năm</option>
            </select>
            <input type="submit" name="submit" value="Thực hiện">
        </form>
    </div>
            <?php
            include '../connect.php';
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $selectedOption = $_POST['selectedOption'];
                
                switch ($selectedOption) {
                    case 'daily':
                        $sql = "SELECT DATE(odate) AS ngay, SUM(ototal) AS total_daily_revenue
                                FROM orders
                                WHERE ostatus = 'đã xác nhận'
                                GROUP BY DATE(odate)";
                        $title = "Doanh thu theo ngày";
                        break;

                    case 'monthly':
                        $sql = "SELECT DATE_FORMAT(odate, '%Y-%m') AS thang, SUM(ototal) AS total_monthly_revenue
                                FROM orders
                                WHERE ostatus = 'đã xác nhận'
                                GROUP BY DATE_FORMAT(odate, '%Y-%m')";
                        $title = "Doanh thu theo tháng";
                        break;

                    case 'yearly':
                        $sql = "SELECT YEAR(odate) AS nam, SUM(ototal) AS total_yearly_revenue
                                FROM orders
                                WHERE ostatus = 'đã xác nhận'
                                GROUP BY YEAR(odate)";
                        $title = "Doanh thu theo năm";
                        break;

                    default:
                        echo "Lựa chọn không hợp lệ";
                        break;
                }

                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                    ?>
                    <h2><?= $title ?></h2>
                    
                    <table style="margin: 0 0 50px 0;" border="1">
                        <thead>
                            <?php if ($selectedOption === 'daily') : ?>
                                <tr>
                                    <th>Ngày</th>
                                    <th>Tổng doanh thu</th>
                                </tr>
                            <?php elseif ($selectedOption === 'monthly') : ?>
                                <tr>
                                    <th>Tháng</th>
                                    <th>Tổng doanh thu</th>
                                </tr>
                            <?php elseif ($selectedOption === 'yearly') : ?>
                                <tr>
                                    <th>Năm</th>
                                    <th>Tổng doanh thu</th>
                                </tr>
                            <?php endif; ?>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                                <tr>
                                    <?php if ($selectedOption === 'daily') : ?>
                                        <td><?= $row['ngay'] ?></td>
                                        <td><?= $row['total_daily_revenue'] ?></td>
                                    <?php elseif ($selectedOption === 'monthly') : ?>
                                        <td><?= $row['thang'] ?></td>
                                        <td><?= $row['total_monthly_revenue'] ?></td>
                                    <?php elseif ($selectedOption === 'yearly') : ?>
                                        <td><?= $row['nam'] ?></td>
                                        <td><?= $row['total_yearly_revenue'] ?></td>
                                    <?php endif; ?>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php
                } else {
                    echo "<p>Không có dữ liệu doanh thu.</p>";
                }
                mysqli_close($conn);
            }
            ?>
        </div>
    </div>
</body>
</html>
