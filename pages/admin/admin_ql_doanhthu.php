
<?php
session_start();

// Kiểm tra xem phiên làm việc đã được khởi tạo chưa
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
!
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin_side_bar.css">
    <link rel="stylesheet" href="admin_ql_orders.css">
    <title>Doanh Thu</title>
</head>
<body>
    <nav class="nav1">
           <!-- <a href="admin.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a> -->
           <a href="admin_ql_member.php"><i class="fa fa-user" aria-hidden="true"></i>Khách hàng</a>
            <a href="admin_ql_sanpham.php"><i class="fa-solid fa-box"></i>Sản phẩm</a>
            <a href="admin_ql_order.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đơn đặt</a>
            <a href="admin_ql_doanhthu.php"><i class="fa fa-line-chart" aria-hidden="true"></i>Doanh thu</a>
            <a href="admin_ql_thongke.php"><i class="fa-solid fa-chart-simple"></i>Thống Kê</a>
            <a href="../../pages/dashboard/logout.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i>Đăng xuất</a>
    </nav>

        <?php
        include '../connect.php';

        // Lấy dữ liệu từ bảng orders với điều kiện ostatus là 'đã xác nhận' và tổng tiền theo ngày, tháng và năm
        $sql = "SELECT DATE_FORMAT(odate, '%Y-%m-%d') AS ngay, SUM(ototal) AS tong_doanh_thu
                FROM orders
                WHERE ostatus = 'đã xác nhận'
                GROUP BY DATE_FORMAT(odate, '%Y-%m-%d')";

        $result = mysqli_query($conn, $sql);

        // Khởi tạo mảng để lưu trữ dữ liệu từ cơ sở dữ liệu
        $doanhThuData = array();

        if ($result && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Thêm dữ liệu vào mảng
                $doanhThuData[] = $row;
            }
        }

        mysqli_close($conn);
        ?>

        <div class="main">
            <h1 class="centered">Biểu đồ Doanh thu theo ngày trong các đơn hàng đã xác nhận</h1>

            <!-- Thêm thẻ canvas cho biểu đồ cột -->
            <canvas id="doanhThuCanvas" style="width: 95%; height: 80%;"></canvas>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
            <script>
                var doanhThuData = <?php echo json_encode($doanhThuData); ?>;
                var ngayLabels = doanhThuData.map(item => item.ngay);
                var tongDoanhThuData = doanhThuData.map(item => item.tong_doanh_thu);

                var doanhThuCanvas = document.getElementById('doanhThuCanvas').getContext('2d');
                new Chart(doanhThuCanvas, {
                    type: 'bar', // Loại biểu đồ cột
                    data: {
                        labels: ngayLabels,
                        datasets: [{
                            label: 'Doanh thu',
                            data: tongDoanhThuData,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)', // Màu nền của cột
                            borderColor: 'rgba(54, 162, 235, 1)', // Màu viền của cột
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true // Bắt đầu từ trục y là 0
                            }
                        },
                        responsive: false,
                        maintainAspectRatio: true
                    }
                });
            </script>
            
        </div>
</body>
</html>