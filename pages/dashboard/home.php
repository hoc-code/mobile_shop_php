<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width" initial-scale="1.00" maximum-scale="1.0" />
    <link rel="shortcut icon" href="../assets/img/zalo suopprt/cellphones.png">
    <link rel="stylesheet" href="../assets/font/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="../assets/font/fontawesome-free-5.15.4/fontawesome-free-5.15.4-web/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../css/find.css">
    <link rel="stylesheet" href="../../css/home.css">   
    <title>Nhóm 13 - Home</title>
</head>
<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    $_SESSION["error_message"] = "Thông tin đăng nhập bị sai. Vui lòng kiểm tra lại!";
    header("Location: ../dashboard/login.php");
    exit();
}
include '../connect.php'; // Đảm bảo đường dẫn đến file connect.php là chính xác
$username = $_SESSION['TenDangNhap1'];
// Thực hiện truy vấn để lấy ID của người dùng dựa trên tên đăng nhập
$sql = "SELECT * FROM member WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    // Lấy kết quả và hiển thị ID của người dùng
    $row = mysqli_fetch_assoc($result);
    $userID = $row['mid'];
    echo "ID của người dùng đăng nhập là: " . $userID;
} else {
    echo "Không tìm thấy người dùng.";
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">



<body>
    <div id="main">
        <!-- Header -->
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
        <!-- Slide -->
        <div class="slide grid wide">
            <div class="row">
                <div class="c-2">
                    <div class="slidebar">
                        <ul class="slidebar__list">
                            <?php
                            include '../connect.php';
                            $categoriesQuery = "SELECT cid, cname FROM categories";
                            $categoriesResult = $conn->query($categoriesQuery);
                            if ($categoriesResult->num_rows > 0) {
                                while ($category = $categoriesResult->fetch_assoc()) {
                                    echo '<li class="slidebar__item">';
                                    echo '<a href="../detail/categories_detail.php?cname=' . $category['cname'] . '" class="slidebar__item__link">';
                                    echo '<div class="slidebar__item__link__text__wrapper">';
                                    echo '<div class="slidebar__item__link__text__wrapper__icon__box">';
                                    echo '<i class="fas fa-cube"></i>';
                                    echo '</div>';
                                    echo '<p>' . $category['cname'] . '</p>';
                                    echo '</div>';
                                    echo '<div class="slidebar__item__link__icon__last__wrapper">';
                                    echo '<i class="ti-angle-right"></i>';
                                    echo '</div>';
                                    echo '</a>';
                                    $cid = $category['cid'];
                                    $productsQuery = "SELECT pid, pname FROM product WHERE cid = $cid";
                                    $productsResult = $conn->query($productsQuery);
                                    echo '<div class="slidebar__item__submenu">';
                                    echo '<ul class="slidebar__item__submenu__list">';
                                    while ($product = $productsResult->fetch_assoc()) {
                                        echo '<li class="slidebar__item__submenu__item">';
                                        echo '<a href="../detail/product_detail.php?pname=' . $product['pname'] . '" class="slidebar__item__submenu__item__link">';
                                        echo '<p>' . $product['pname'] . '</p>';
                                        echo '</a>';
                                        echo '</li>';
                                    }
                                    echo '</ul>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                            } else {
                                echo "Không có danh mục.";
                            }
                            $conn->close();
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="c-7">
                    <div class="slider">
                        <div class="slider__top">
                            <div class="slider__top__next__btn">
                                <i class="fas fa-angle-right"></i>
                            </div>
                            <div class="slider__top__prev__btn">
                                <i class="fas fa-angle-left"></i>
                            </div>
                            <!-- PC -->
                            <div class="slider__top__wrapper" style="transform: translateX(-1369.96px);">
                                <img src="../assets/img/Slide/Slider/1.webp" alt="" class="slider__top__item">
                                <img src="../assets/img/Slide/Slider/2.webp" alt="" class="slider__top__item">
                                <img src="../assets/img/Slide/Slider/3.webp" alt="" class="slider__top__item">
                                <img src="../assets/img/Slide/Slider/4.webp" alt="" class="slider__top__item">
                                <img src="../assets/img/Slide/Slider/5.webp" alt="" class="slider__top__item">
                                <img src="../assets/img/Slide/Slider/6.webp" alt="" class="slider__top__item">
                            </div>
                            <!-- End PC -->
                        </div>
                        <div class="slider__bottom">
                            <div class="slider__bottom__list">
                                <!-- 1st -->
                                <div class="slider__bottom__item">
                                    <a href="" class="slider__bottom__item__link">
                                        <p class="slider__bottom__item__link__text__1st">Tháng thành viên</p>
                                        <p class="slider__bottom__item__link__text__2nd">Ưu đãi liên miên</p>
                                    </a>
                                    <div class="slider__bottom__item__underline"></div>
                                </div>
                                <!-- 2nd -->
                                <div class="slider__bottom__item">
                                    <a href="" class="slider__bottom__item__link">
                                        <p class="slider__bottom__item__link__text__1st">Z FOLD3 | Z FLIP3 5G</p>
                                        <p class="slider__bottom__item__link__text__2nd">Ưu đãi cực lớn</p>
                                    </a>
                                    <div class="slider__bottom__item__underline"></div>
                                </div>
                                <!-- 3rd -->
                                <div class="slider__bottom__item">
                                    <a href="" class="slider__bottom__item__link">
                                        <p class="slider__bottom__item__link__text__1st">XIAOMI 11T SERIES</p>
                                        <p class="slider__bottom__item__link__text__2nd">Đặt trước ưu đãi khủng</p>
                                    </a>
                                    <div class="slider__bottom__item__underline"></div>
                                </div>
                                <!-- 4th -->
                                <div class="slider__bottom__item">
                                    <a href="" class="slider__bottom__item__link">
                                        <p class="slider__bottom__item__link__text__1st">ZENBOOK 12 OLED</p>
                                        <p class="slider__bottom__item__link__text__2nd">Giá tốt mua ngay</p>
                                    </a>
                                    <div class="slider__bottom__item__underline"></div>
                                </div>
                                <!-- 5th -->
                                <div class="slider__bottom__item">
                                    <a href="" class="slider__bottom__item__link">
                                        <p class="slider__bottom__item__link__text__1st">Loa JBL CHARGE 5</p>
                                        <p class="slider__bottom__item__link__text__2nd">Mở bán giá tốt</p>
                                    </a>
                                    <div class="slider__bottom__item__underline"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="c-3">
                    <div class="slide__ads__wrapper">
                        <a href=""><img src="../assets/img/Slide/Ads/1.webp" alt=""></a>
                    </div>
                    <div class="slide__ads__wrapper">
                        <a href=""><img src="../assets/img/Slide/Ads/2.webp" alt=""></a>
                    </div>
                    <div class="slide__ads__wrapper">
                        <a href=""><img src="../assets/img/Slide/Ads/3.webp" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <script src="../../action/slide.js"></script>
        <!-- ADS -->
        <div class="web__ads grid wide">
            <div class="row">
                <div class="web__ads__box">
                    <a href="">
                        <img src="../assets/img/Web ads/1.webp" alt="" class="web__ads__box__pc__img">
                    </a>
                    <a href="">
                        <img src="../assets/Tablet img/slide ads.webp" alt="" class="web__ads__box__tablet__img">
                    </a>
                </div>
            </div>
        </div>
        <!-- flash__sale -->
        <div class="flash__sale grid wide" >
            <?php
            include '../connect.php';

            $sql = "SELECT seasonstart, seasonend FROM season where seasonid = 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $start_date = $row["seasonstart"];
                    $end_date = $row["seasonend"];
                    // Tính toán thời gian còn lại từ ngày hiện tại đến ngày kết thúc
                    $current_date = date('Y-m-d H:i:s');
                    $diff = strtotime($end_date) - strtotime($current_date);
                    $days = floor($diff / (60 * 60 * 24));
                    $hours = floor(($diff - ($days * 60 * 60 * 24)) / (60 * 60));
                    $minutes = floor(($diff - ($days * 60 * 60 * 24) - ($hours * 60 * 60)) / 60);
                    $seconds = floor($diff - ($days * 60 * 60 * 24) - ($hours * 60 * 60) - ($minutes * 60));
                }
            }
            $conn->close();
            ?>
            <div class="row">
                <div class="c-6">
                    <div class="flash__hot__sale">
                        <img src="../../pages/assets/bg/hot-sale-giang-sinh-title_1_4_.png">
                    </div>
                </div>
                <div class="c-6 flash__sale__box__tablet">
                    <div class="coutdown">
                        <h1 class="coutdown__title">
                            Kết thúc sau
                        </h1>
                        <div class="time">
                            <h1 id="day"><?php echo $days; ?></h1>
                        </div>
                        <span>:</span>
                        <div class="time">
                            <h1 id="hour"><?php echo $hours; ?></h1>
                        </div>
                        <span>:</span>
                        <div class="time">
                            <h1 id="minutes"><?php echo $minutes; ?></h1>
                        </div>
                        <span>:</span>
                        <div class="time">
                            <h1 id="sec"><?php echo $seconds; ?></h1>
                        </div>
                    </div>
                </div>
            </div>
            
            <script>
                var hours = <?php echo $hours; ?>;
                var minutes = <?php echo $minutes; ?>;
                var seconds = <?php echo $seconds; ?>;
                function updateCountdown() {
                    document.getElementById("hour").innerText = hours < 10 ? "0" + hours : hours;
                    document.getElementById("minutes").innerText = minutes < 10 ? "0" + minutes : minutes;
                    document.getElementById("sec").innerText = seconds < 10 ? "0" + seconds : seconds;

                    if (hours === 0 && minutes === 0 && seconds === 0) {
                        clearInterval(countdown);
                        // Thực hiện hành động sau khi đếm ngược kết thúc
                    } else {
                        if (seconds > 0) {
                            seconds--;
                        } else {
                            if (minutes > 0) {
                                minutes--;
                                seconds = 59;
                            } else {
                                if (hours > 0) {
                                    hours--;
                                    minutes = 59;
                                    seconds = 59;
                                }
                            }
                        }
                    }
                }
                // Cập nhật đếm ngược mỗi giây
                var countdown = setInterval(updateCountdown, 1000);
            </script>
                <div class="flash__sale__next__btn">
                    <i class="fas fa-angle-right"></i>
                </div>
                <div class="flash__sale__prev__btn">
                    <i class="fas fa-angle-left"></i>
                </div>
            <div class="row flash__sale__product__list__wrapper" >
                <div class="flash__sale__product__list">
                <?php
                include '../connect.php';

                // Truy vấn để lấy thông tin sản phẩm và phần trăm giảm giá từ bảng season
                $sql = "SELECT p.*, s.*, se.discount_percentage 
                        FROM product p
                        INNER JOIN sale s ON p.pid = s.pid
                        INNER JOIN season se ON s.seasonid = se.seasonid
                        WHERE s.seasonid = '1'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Lấy giá cũ và phần trăm giảm giá từ kết quả truy vấn
                        $oldPrice = $row["pprice"];
                        $discountPercentage = $row["discount_percentage"];

                        // Tính toán giá mới (pnewprice)
                        $newPrice = $oldPrice * (1 - ($discountPercentage / 100));

                        // Hiển thị thông tin sản phẩm với giá mới tính được
                        echo '<a href="../detail/product_detail.php?pname=' . $row["pname"] . '">';
                        echo '<div class="flash__sale__product">';
                        echo '<div class="flash__sale__discount">';
                        echo '<p>' . $discountPercentage . '%' . '</p>';
                        echo '</div>';
                        echo '<div class="flash__sale__product__img__wrapper">';
                        echo '<img src="../assets/images1/' . $row["pimage"] . '" alt="điện thoại ' . $row["pname"] . '">';
                        echo '</div>';
                        echo '<div class="flash__sale__product__desc">';
                        echo '<p class="flash__sale__product__desc__title">' . $row["pname"] . '</p>';
                        echo '<div class="flash__sale__product__desc__price">';
                        echo '<div class="flash__sale__product__desc__price__new">';
                        echo '<p>' . number_format($newPrice, 0, ',', '.') . ' <span class="flash__sale__product__desc__price__unit__new">đ</span></p>';
                        echo '</div>';
                        echo '<div class="flash__sale__product__desc__price__old">';
                        echo '<p>' .number_format($oldPrice, 0, ',', '.') . ' <span class="flash__sale__product__desc__price__unit__old">đ</span></p>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                        echo '</a>'; // Đóng thẻ a
                    }
                } else {
                    echo "Không có sản phẩm.";
                }
                $conn->close();
                ?>

                </div>
            </div>
        </div>
        <script src="../../action/flash_sale_slide.js"></script>

        <!-- hot__phone -->
        <div class="featured__phone grid wide">
            <div class="row featured__phone__gutter">
                <div class="c-3">
                    <div class="featured__phone__title">
                        <a href="" class="featured__phone__title__text">Điện thoại nổi bật nhất</a>
                    </div>
                </div>
                <div class="c-7">
                    <div class="featured__phone__related__tag">
                        <?php
                        include '../connect.php';

                        $sql = "SELECT * FROM categories";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo '<div class="featured__phone__related__tag">';
                                echo '<a href="?category=' . $row["cid"] . '" class="futured__phone__item">' . $row["cname"] . '</a>';
                                echo '</div>';
                            }
                        } else {
                            echo "Không có dữ liệu";
                        }
                        $conn->close();
                        ?>
                    </div>
                </div>
                <!-- Product List -->
                <?php
                include '../connect.php';
                $productsPerPage = 5; // Số lượng sản phẩm trên mỗi trang
                $category_id = isset($_GET['category']) ? $_GET['category'] : 1; // 1 là ID của danh mục mặc định
                $page = isset($_GET['page']) && $_GET['page'] > 0 ? $_GET['page'] : 1;
                // Tính tổng số sản phẩm theo từng danh mục
                $countSql = "SELECT COUNT(*) AS total FROM product";
                if ($category_id !== null) {
                    $countSql .= " WHERE cid = $category_id";
                }
                $countResult = $conn->query($countSql);
                $countRow = $countResult->fetch_assoc();
                $totalProducts = $countRow['total'];
                $totalPages = ceil($totalProducts / $productsPerPage); // Tính tổng số trang
                // Xây dựng câu truy vấn lấy dữ liệu sản phẩm theo từng trang và danh mục
                $start = ($page - 1) * $productsPerPage;
                $sql = "SELECT * FROM product";
                if ($category_id !== null) {
                    $sql .= " WHERE cid = $category_id";
                }
                $sql .= " ORDER BY phot ASC LIMIT $start, $productsPerPage";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo '<div class="featured__phone__product__list">';
                    while ($row = $result->fetch_assoc()) {
                        echo '<a href="../detail/product_detail.php?pname=' . $row["pname"] . '">';
                        echo '<div class="featured__phone__product__item">';
                        // Hiển thị thông tin sản phẩm
                        echo '<div class="featured__phone__product__img__wrapper">';
                        echo '<img src="../assets/images1/' . $row["pimage"] . '" alt="điện thoại ' . $row["pname"] . '">';
                        echo '</div>';
                        echo '<div class="featured__phone__product__desc">';
                        echo '<div class="featured__phone__product__desc__title">';
                        echo '<div class="featured__phone__product">';
                        echo $row['pname'];
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="featured__phone__product__desc__price">';
                        echo '<div class="featured__phone__product__desc__price__new">';
                        echo '<p>';
                        echo number_format($row['pprice'], 0, '', '.');
                        echo '<span class="featured__phone__product__desc__price__unit__new">đ</span>';
                        echo '</p>';
                        echo '</div>';
                        echo '</div>';
                        // Các phần khác của sản phẩm
                        // ...
                        echo '</div>'; // Kết thúc featured__phone__product__desc
                        echo '</div>'; // Kết thúc featured__phone__product__item
                        echo '</a>';
                    }
                    echo '</div>'; // Kết thúc featured__phone__product__list
                } else {
                    echo "Không có sản phẩm.";
                }
                $conn->close();
                ?>
            </div>
            <?php
            echo '<div class="pagination">';
            for ($i = 1; $i <= $totalPages; $i++) {
                echo '<a href="home.php?page=' . $i . '&category=' . $category_id . '">' . $i . '</a> '; // Hiển thị các liên kết đến các trang
            }
            echo '</div>';
            ?>
            <style>
                .pagination {
                    display: flex;
                    justify-content: center;
                    background-color: #c40016;
                }

                .pagination a {
                    color: white;
                    font-weight: bold;
                    text-decoration: none;
                    /* Loại bỏ gạch chân */
                    padding: 5px 10px;
                    /* Khoảng cách giữa các trang */
                    margin: 0 3px;
                    /* Khoảng cách giữa các trang */
                }

                .pagination a:hover {
                    background-color: #c40016;
                }
            </style>
        </div>
    </div>
    <div class="footer__information__background grid wide">
        <div class="footer__information">
            <div class="row footer__information__row">
                <!-- 1st -->
                <div class="c-4">
                    <div class="footer__information__text__1st">
                        <a href="" class="footer__information__text__1st__a">Điện thoại</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__1st__a">Black Friday 2021</a>
                    </div>
                    <div class="footer__information__text__2nd">
                        <a href="" class="footer__information__text__2nd__a">Điện thoại iPhone 11</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__2nd__a">Điện thoại iPhone 12</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__2nd__a">Điện thoại iPhone 13</a>
                    </div>
                    <div class="footer__information__text__3rd">
                        <a href="" class="footer__information__text__3rd__a">Điện thoại Samsung Galaxy Z Fold 3</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__3rd__a">Đồng hồ Apple Watch Series 7</a>
                    </div>
                </div>
                <!-- 2nd -->
                <div class="c-4">
                    <div class="footer__information__text__1st">
                        <br>
                    </div>
                    <div class="footer__information__text__2nd">
                        <a href="" class="footer__information__text__2nd__a">Điện thoại iPhone</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__2nd__a">Điện thoại Samsung</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__2nd__a">Điện thoại Oppo</a>
                    </div>
                    <div class="footer__information__text__3rd">
                        <a href="" class="footer__information__text__2nd__a">Điện thoại Xiaomi</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__2nd__a">Điện thoại Vivo</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__2nd__a">Điện thoại OnePlus</a>
                    </div>
                </div>
                <!-- 3rd -->
                <div class="c-4">
                    <div class="footer__information__text__1st">
                        <a href="" class="footer__information__text__1st__a">Máy tính laptop</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__1st__a">Smart home</a>
                    </div>
                    <div class="footer__information__text__2nd">
                        <a href="" class="footer__information__text__2nd__a">Laptop HP</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__2nd__a">Máy tính để bàn PC</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__2nd__a">Màn hình máy tính</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__2nd__a">Sim số đẹp</a>
                    </div>
                    <div class="footer__information__text__3rd">
                        <a href="" class="footer__information__text__3rd__a">Robot hút bụi</a>
                        <span>-</span>
                        <a href="" class="footer__information__text__3rd__a">Camera</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__3rd__a">Camera hành trình</a>
                        <span>|</span>
                        <a href="" class="footer__information__text__3rd__a">Camera hành trình Vietmap</a>
                    </div>
                </div>
            </div>
            <div class="row footer__information__row__last">
                <p>Công ty TNHH Thương mại và dịch vụ kỹ thuật DIỆU PHÚC - GPĐKKD: 0316172372 do sở KH &amp; ĐT TP. HCM cấp ngày 02/03/2020. Địa chỉ: 350-352 Võ Văn Kiệt, Phường Cô Giang, Quận 1, Thành phố Hồ Chí Minh, Việt Nam. Điện thoại: 028.7108.9666.</p>
            </div>
            <div class="row footer__certification">
                <div class="footer__certification__img__wrapper">
                    <img src="../assets/img/footer information/1.png" alt="">
                </div>
                <div class="footer__certification__img__wrapper">
                    <img src="../assets/img/footer information/2.png" alt="">
                </div>
            </div>
        </div>
    </div>
</body>
</html>