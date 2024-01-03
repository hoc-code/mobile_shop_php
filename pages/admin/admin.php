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



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="admin_side_bar.css">
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        // Load Chart.js library
        google.charts.load('current', { packages: ['corechart'] });
    </script>

    <title>Home</title>
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

    <div class="main">
        <h1 class="centered">Biểu đồ Doanh thu theo tháng trong năm</h1>

        <!-- Thêm thẻ canvas cho biểu đồ Doanh thu -->
        <canvas id="doanhThuCanvas" style="width: 40%; height: 40%; "></canvas>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
        <script>
            // Lấy dữ liệu từ PHP và chuyển thành biến JavaScript
            var doanhThuData = <?php echo json_encode($doanhThuData); ?>;

            // Vẽ biểu đồ Doanh thu
            google.charts.setOnLoadCallback(drawChart);
            
            function drawChart() {
                var doanhThuCanvas = document.getElementById('doanhThuCanvas').getContext('2d');
                new Chart(doanhThuCanvas, {
                    type: 'pie', // Thay đổi loại biểu đồ thành biểu đồ tròn (pie)
                    data: {
                        labels: doanhThuData.map(item => "Tháng " + item.Thang),
                        datasets: [{
                            label: 'Doanh thu',
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255, 99, 132, 1)'
                            ],
                            borderWidth: 1,
                            data: doanhThuData.map(item => item.TongDoanhThu)
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false
                    }
                });
            }
        </script>
    </div>
</body>
</html>
