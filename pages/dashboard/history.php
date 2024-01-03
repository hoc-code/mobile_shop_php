<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/find.css">
    <link rel="stylesheet" href="../../css/home.css">
    <link rel="stylesheet" href="../../css/cart.css">
    <link rel="stylesheet" href="../../css/orders.css">
    <title>Nhom 13 -History</title>
</head>
<?php
    session_start();
    include '../connect.php'; // Đảm bảo đường dẫn đến file connect.php là chính xác

    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        $_SESSION["error_message"] = "Thông tin đăng nhập bị sai. Vui lòng kiểm tra lại!";
        header("Location: ../dashboard/login.php");
        exit();
    }

    $username = $_SESSION['TenDangNhap1'];
    // Thực hiện truy vấn để lấy ID của người dùng dựa trên tên đăng nhập
    $sql = "SELECT mid FROM member WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userID = $row['mid'];
        // Truy vấn để lấy các sản phẩm từ giỏ hàng tương ứng với mid
        $cartQuery = "SELECT * FROM cart WHERE mid = '$userID'";
        echo "ID của người dùng đăng nhập là: " . $userID;
        $result_products = mysqli_query($conn, $cartQuery);
    } else {
        echo "Không tìm thấy người dùng.";
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<body>
<div class="header__height"></div>
            <div class="header__background">
                <div class="header grid wide">
                    <div class="row">
                        <!-- Logo Icon -->
                        <div class="header__logo__wrapper">
                            <div class="header__logo">
                            </div>
                            <span class="header__logo__line__1st"></span>
                            <span class="header__logo__line__2nd"></span>
                            <span class="header__logo__line__3rd"></span>
                        </div>
                        <!-- Logo Image -->
                        <div class="header__logo__img">
                            <a href="../../pages/dashboard/home.php"><img src="../assets/logo/logo.png" alt=""></a>
                        </div>
                        <!-- Search bar -->
                        <div class="header__search__bar">
                            <div class="header__search__bar__icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="header__search__bar__input">
                                <input type="text" id="search-box" placeholder="Bạn cần tìm gì?">
                                <div id="suggestion-box"></div>
                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
                        <script>
                            $(document).ready(function() {
                                // Lắng nghe sự kiện khi người dùng gõ vào #search-box
                                $("#search-box").keyup(function() {
                                    // Thực hiện AJAX để tìm kiếm và hiển thị kết quả trong #suggestion-box
                                    $.ajax({
                                        type: "GET",
                                        url: "../../action/readProduct.php",
                                        data: 'keyword=' + $(this).val(),
                                        beforeSend: function() {
                                            $("#search-box").css("background", "#FFF url(../assets/icon/loadicon.png) no-repeat 165px");
                                        },
                                        success: function(data) {
                                            $("#suggestion-box").show();
                                            $("#suggestion-box").html(data);
                                            $("#search-box").css("background", "#FFF");
                                        }
                                    });
                                });
                                // Lắng nghe sự kiện click trên toàn bộ document
                                $(document).click(function(event) {
                                    // Kiểm tra xem sự kiện click có xảy ra trên #search-box hay không
                                    if (!$(event.target).closest('#search-box').length) {
                                        // Nếu không phải là #search-box hoặc bất kỳ phần tử con của nó
                                        $("#suggestion-box").hide();
                                    }
                                });
                                // Hàm để chọn một mục từ #suggestion-box
                                function selectCountry(val) {
                                    $("#search-box").val(val);
                                    $("#suggestion-box").hide();
                                }
                            });
                        </script>
                        <div class="header__search__bar__modal" style="display: none;"></div>
                        <script>
                            var search__input = document.querySelector('.header__search__bar__input input');
                            var search__modal = document.querySelector('.header__search__bar__modal');
                            var list_cate = document.querySelector('.list_cate');
                            search__input.addEventListener('click', function(event) {
                                search__modal.style.display = 'block';
                                event.stopPropagation();
                            });

                            search__modal.addEventListener('click', function() {
                                search__modal.style.display = 'none';
                            });
                        </script>
                        <!-- Navbar list -->
                        <div class="header__navbar">
                            <ul class="header__navbar__list">
                                <li class="header__navbar__item">
                                    <div class="header__navbar__item__wrapper">
                                        <a href="history.php" class="header__navbar__item__link">
                                            <i class="fas fa-shipping-fast"></i>
                                            <div class="header__navbar__item__link__desc__wrapper">
                                                <p>Lịch sử</p>
                                                <p>đơn hàng</p>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li class="header__navbar__item">
                                    <div class="header__navbar__item__wrapper">
                                        <a href="cart.php" class="header__navbar__item__link">
                                            <i class="ti-bag"></i>
                                            <div class="header__navbar__item__link__desc__wrapper">
                                                <p>Giỏ</p>
                                                <p>hàng</p>
                                            </div>
                                        </a>
                                    </div>
                                </li>
                                <li class="header__navbar__item">
                                    <div class="header__navbar__item__wrapper">
                                        <div class="header__navbar__item__link" onclick="toggleDropdown()">
                                            <div class="header__navbar__item__link__icon__wrapper__last">
                                                <i class="far fa-user-circle"></i>
                                            </div>
                                            <div class="header__navbar__item__link__desc__wrapper_last">
                                                <p id="username">
                                                    <?php
                                                    if (isset($_SESSION['TenDangNhap1'])) {
                                                        echo $_SESSION['TenDangNhap1']; // Hiển thị tên người dùng từ session
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="dropdown" id="dropdown-smem">
                                            <div class="dropdown-content">
                                                <a href="../member/member.php"><i class="fa-regular fa-user"></i>Trang cá nhân</a>
                                                <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>Đăng xuất</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <style>
                                    .dropdown-content {
                                    display: none;
                                    position: absolute;
                                    background-color: #fff;
                                    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.5);
                                    width: 100px;
                                    border-radius: 10px;
                                    z-index: 1;
                                    color: #000; /* Màu chữ đen */
                                    font-weight: bold; /* In đậm */
                                }
                                .dropdown-content i{
                                    font-weight: bold;
                                    margin: 0 3px 0 5px;
                                }
                                /* Hiển thị dropdown khi có class 'show' */
                                .dropdown-content.show {
                                    display: block;
                                    border-radius: 10px;
                                    width: 180px;
                                }
                                .dropdown-content a {
                                    display: block;
                                    width: 100%;
                                    white-space: normal;
                                    text-align: left;
                                    padding: 8px 16px;
                                    text-decoration: none;
                                    color: #000; /* Màu chữ đen */
                                    font-weight: bold; /* In đậm */
                                    transition: background-color 0.3s ease; /* Hiệu ứng hover */
                                    border-radius: 10px;
                                }

                                .dropdown-content a:hover {
                                    background-color: #ff7e7e; 
                                    cursor: pointer;
                                }
                                </style>

                                <script>
                                    function toggleDropdown() {
                                        var dropdown = document.querySelector("#dropdown-smem .dropdown-content");
                                        dropdown.classList.toggle("show");
                                    }
                                    // Đóng dropdown nếu click ra ngoài dropdown
                                    window.onclick = function(event) {
                                        if (!event.target.closest('.header__navbar__item__wrapper')) {
                                            var dropdowns = document.querySelectorAll(".dropdown-content");
                                            dropdowns.forEach(function(dropdown) {
                                                if (dropdown.classList.contains('show')) {
                                                    dropdown.classList.remove('show');
                                                }
                                            });
                                        }
                                    }
                                </script>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="real_orders">
    <h2>Các đơn hàng đã đặt</h2>
    <?php
        include '../connect.php';
        $sql = "SELECT orders.quantity ,orders.oid, orders.odate, orders.ototal, orders.ostatus, product.pname, product.pimage
        FROM orders
        JOIN product ON orders.pid = product.pid
        WHERE orders.mid = $userID
        AND (orders.ostatus = 'chờ xác nhận')";

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
                // Display product details
                
            ?>
                <a href="../detail/product_detail.php?pname=<?php echo $productName; ?>">
                    <div class='real_order'>
                        <img src='../assets/images1/<?php echo $productImage; ?>' alt='Product: <?php echo $productName; ?>'>
                        <div class='real_order_info'>
                            <div class='real_order_name'>ID Đơn hàng: <?php echo $oid; ?></div>
                            <div class='real_order_date'>Ngày đặt hàng: <?php echo $odate; ?></div>
                            <div class='real_order_product_name'>Tên sản phẩm: <?php echo $productName; ?></div>
                            <div class='real_order_product_quantity'>Số lượng: <?php echo $quantity; ?></div>
                            <div class='real_order_total_money'>Tổng tiền: <?php echo number_format($ototal, 0, ',', '.') ?> đ</div>
                            <div class='real_order_status'>Trạng thái: <span class="status" data-status="<?php echo $ostatus; ?>"><?php echo $ostatus; ?></span></div>
                            <div class='real_order_button'>
                                <a class="button_huy"  href='../../action/cancel_order_action.php?oid=<?php echo $oid; ?>' class='cancel_button'>Hủy</a>
                            </div>
                        </div>
                    </div>
                </a>
                
                <?php
                // Sum up total amount for all orders
                $total += $ototal;
            }
            // Display the total amount for all orders
            echo "<div class='real_order_total'><p>Tổng tiền của tất cả đơn hàng: " . number_format($total, 0, ',', '.') . " đ</p></div>";
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

            $confirmedOrdersQuery = "SELECT  orders.quantity ,orders.oid, orders.odate, orders.ototal, orders.ostatus, product.pname, product.pimage
                            FROM orders
                            JOIN product ON orders.pid = product.pid
                            WHERE orders.ostatus = 'đã xác nhận' 
                            AND orders.mid = $userID";


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
                    // Display confirmed order details
                    ?>
                    <a href="../detail/product_detail.php?pname=<?php echo $productName; ?>">
                    <div class='confirmed_order'>
                        <img src='../assets/images1/<?php echo $productImage; ?>' alt='Product: <?php echo $productName; ?>'>
                        <div class='confirmed_order_info'>
                            <div class='confirmed_order_name'>ID Đơn hàng: <?php echo $oid; ?></div>
                            <div class='confirmed_order_date'>Ngày đặt hàng: <?php echo $odate; ?></div>
                            <div class='confirmed_order_product_name'>Tên sản phẩm: <?php echo $productName; ?></div>
                            <div class='confirmed_order_product_quantity'>Số lượng: <?php echo $quantity; ?></div>
                            <div class='confirmed_order_total_money'>Tổng tiền: <?php echo number_format($ototal, 0, ',', '.') ?> đ</div>
                            <div class='confirmed_order_status'>Trạng thái: <?php echo $ostatus; ?></div>
                        </div>
                    </div>
                    </a>
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

        $canceledOrdersQuery = "SELECT  orders.quantity ,orders.oid, orders.odate, orders.ototal, orders.ostatus, product.pname, product.pimage
                                FROM orders
                                JOIN product ON orders.pid = product.pid
                                WHERE orders.mid = $userID
                                AND orders.ostatus = 'đã hủy'";

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
                // Display canceled order details
                ?>
                <a href="../detail/product_detail.php?pname=<?php echo $productName; ?>">
                <div class='cancel_order'>
                <img src='../assets/images1/<?php echo $productImage; ?>' alt='Product: <?php echo $productName; ?>'>
                    <div class='cancel_order_info'>
                        <div class='cancel_order_name'>ID Đơn hàng: <?php echo $oid; ?></div>
                        <div class='cancel_order_date'>Ngày đặt hàng: <?php echo $odate; ?></div>
                            <div class='cancel_order_product_name'>Tên sản phẩm: <?php echo $productName; ?></div>
                            <div class='cancel_order_product_quantity'>Số lượng: <?php echo $quantity; ?></div>
                            <div class='cancel_order_total_money'>Tổng tiền: <?php echo number_format($ototal, 0, ',', '.') ?> đ</div>
                            <div class='cancel_order_status'>Trạng thái: <?php echo $ostatus; ?></div>
                    </div>
                </div>
                </a>
                <?php
            }
        } else {
            // Display a message if there are no canceled orders
            echo "Không có đơn hàng đã hủy";
        }

        mysqli_close($conn);
        ?>
</div>

</body>
</html>